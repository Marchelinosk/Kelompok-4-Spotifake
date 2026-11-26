/**
 * Spotifake - Interactive User Player & Collection Script
 */

document.addEventListener('DOMContentLoaded', () => {
    // Player State
    let isPlaying = false;
    let isMuted = false;
    let isRepeat = false;
    let isShuffle = false;
    let currentVolume = 0.7;
    let currentTrackIndex = -1;
    let currentSongId = 0;

    const likedSet = new Set(window.LIKED_SONG_IDS || []);

    // DOM Elements
    const audioPlayer = document.getElementById('audioPlayer');
    const btnMainPlay = document.getElementById('btnMainPlay');
    const playIcon = document.getElementById('playIcon');
    const currentTitle = document.getElementById('currentTitle');
    const currentArtist = document.getElementById('currentArtist');
    const currentCover = document.getElementById('currentCover');
    const currentTimeText = document.getElementById('currentTimeText');
    const durationTimeText = document.getElementById('durationTimeText');
    const seekBar = document.getElementById('seekBar');
    const seekProgress = document.getElementById('seekProgress');
    const volumeBar = document.getElementById('volumeBar');
    const volumeProgress = document.getElementById('volumeProgress');
    const btnVolume = document.getElementById('btnVolume');
    const volumeIcon = document.getElementById('volumeIcon');
    const btnLike = document.getElementById('btnLike');
    const searchInput = document.getElementById('searchInput');
    const btnShuffle = document.getElementById('btnShuffle');
    const btnRepeat = document.getElementById('btnRepeat');
    const navSearchTrigger = document.getElementById('navSearchTrigger');

    // Set volume awal
    if (audioPlayer) {
        audioPlayer.volume = currentVolume;
        if (volumeProgress) volumeProgress.style.width = `${currentVolume * 100}%`;
    }

    function formatTime(seconds) {
        if (isNaN(seconds) || !isFinite(seconds)) return '00:00';
        const mins = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
    }

    function setPlayButtonState(playing) {
        isPlaying = playing;
        if (!playIcon) return;
        playIcon.className = isPlaying ? 'bi bi-pause-fill' : 'bi bi-play-fill';
    }

    function syncLikeButtonUI(songId) {
        if (!btnLike) return;
        const heartIcon = btnLike.querySelector('i');
        if (likedSet.has(Number(songId))) {
            btnLike.classList.add('liked');
            heartIcon.className = 'bi bi-heart-fill text-danger';
        } else {
            btnLike.classList.remove('liked');
            heartIcon.className = 'bi bi-heart';
        }
    }

    // Play specific track
    function playTrack(songId, title, artist, imgUrl, audioUrl, index = -1) {
        if (!audioPlayer || !audioUrl) {
            showToast('Tautan audio tidak tersedia untuk lagu ini.');
            return;
        }

        currentSongId = Number(songId) || 0;
        if (index !== -1) currentTrackIndex = index;

        if (currentTitle) currentTitle.textContent = title || 'Lagu Pilihan';
        if (currentArtist) currentArtist.textContent = artist || 'Artis Spotifake';
        if (imgUrl && currentCover) currentCover.src = imgUrl;
        if (btnLike) btnLike.setAttribute('data-song-id', currentSongId);

        syncLikeButtonUI(currentSongId);

        if (seekProgress) seekProgress.style.width = '0%';
        if (currentTimeText) currentTimeText.textContent = '00:00';

        audioPlayer.src = audioUrl;
        audioPlayer.play()
            .then(() => {
                setPlayButtonState(true);
                showToast(`Memutar: ${title} - ${artist}`);
            })
            .catch(err => {
                console.error('Playback error:', err);
                setPlayButtonState(false);
                showToast('Gagal memutar stream audio. Cek koneksi internet.');
            });
    }

    // Delegasi Klik untuk Semua Kartu Lagu (termasuk yang baru dimuat dinamis)
    document.addEventListener('click', (e) => {
        // 1. Jika klik tombol '+' Tambah ke Koleksi di pojok kartu
        const addPlaylistBtn = e.target.closest('.open-add-playlist');
        if (addPlaylistBtn) {
            e.preventDefault();
            e.stopPropagation();
            const sId = addPlaylistBtn.getAttribute('data-song-id');
            const sTitle = addPlaylistBtn.getAttribute('data-song-title');
            document.getElementById('targetSongIdInput').value = sId;
            document.getElementById('selectedSongForPlaylist').textContent = sTitle;
            const modal = new bootstrap.Modal(document.getElementById('modalAddToPlaylist'));
            modal.show();
            return;
        }

        // 2. Jika klik Kartu Lagu / Tombol Play
        const trigger = e.target.closest('.play-trigger');
        if (trigger) {
            e.preventDefault();
            const allTriggers = Array.from(document.querySelectorAll('.play-trigger[data-audio]'));
            const idx = allTriggers.indexOf(trigger);
            playTrack(
                trigger.getAttribute('data-id'),
                trigger.getAttribute('data-track'),
                trigger.getAttribute('data-artist'),
                trigger.getAttribute('data-img'),
                trigger.getAttribute('data-audio'),
                idx
            );
        }
    });

    // Tombol Simpan Lagu yang Sedang Diputar di Bottom Player ke Koleksi
    document.getElementById('btnAddCurrentToPlaylist')?.addEventListener('click', () => {
        if (!currentSongId) {
            showToast('Putar lagu terlebih dahulu untuk menyimpannya ke koleksi.');
            return;
        }
        document.getElementById('targetSongIdInput').value = currentSongId;
        document.getElementById('selectedSongForPlaylist').textContent = currentTitle.textContent;
        const modal = new bootstrap.Modal(document.getElementById('modalAddToPlaylist'));
        modal.show();
    });

    // ==================== FITUR LIKE REAL-TIME KE DATABASE ====================
    if (btnLike) {
        btnLike.addEventListener('click', async () => {
            if (!currentSongId) {
                showToast('Putar lagu terlebih dahulu sebelum menyukai.');
                return;
            }

            const formData = new FormData();
            formData.append('action', 'toggle_like');
            formData.append('id_song', currentSongId);

            try {
                const res = await fetch('api_koleksi.php', { method: 'POST', body: formData });
                const data = await res.json();

                if (data.status === 'success') {
                    if (data.liked) {
                        likedSet.add(currentSongId);
                    } else {
                        likedSet.delete(currentSongId);
                    }
                    syncLikeButtonUI(currentSongId);
                    const badge = document.getElementById('likedCountBadge');
                    if (badge) badge.textContent = likedSet.size;
                    showToast(data.message);
                } else {
                    showToast(data.message || 'Gagal memproses suka.');
                }
            } catch (err) {
                showToast('Gagal terhubung ke server.');
            }
        });
    }

    // ==================== FITUR BUAT KOLEKSI BARU ====================
    const formCreatePlaylist = document.getElementById('formCreatePlaylist');
    if (formCreatePlaylist) {
        formCreatePlaylist.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(formCreatePlaylist);
            formData.append('action', 'create_playlist');

            try {
                const res = await fetch('api_koleksi.php', { method: 'POST', body: formData });
                const data = await res.json();

                if (data.status === 'success') {
                    showToast(data.message);
                    // Muat ulang halaman agar sidebar & pilihan koleksi langsung terbarui
                    setTimeout(() => location.reload(), 700);
                } else {
                    showToast(data.message);
                }
            } catch (err) {
                showToast('Gagal membuat koleksi.');
            }
        });
    }

    // ==================== FITUR TAMBAH LAGU KE KOLEKSI ====================
    document.querySelectorAll('.confirm-add-to-playlist').forEach(btn => {
        btn.addEventListener('click', async () => {
            const playlistId = btn.getAttribute('data-playlist-id');
            const songId = document.getElementById('targetSongIdInput').value;

            const formData = new FormData();
            formData.append('action', 'add_to_playlist');
            formData.append('id_playlist', playlistId);
            formData.append('id_song', songId);

            try {
                const res = await fetch('api_koleksi.php', { method: 'POST', body: formData });
                const data = await res.json();
                showToast(data.message);

                const modalEl = document.getElementById('modalAddToPlaylist');
                bootstrap.Modal.getInstance(modalEl)?.hide();
            } catch (err) {
                showToast('Gagal menambahkan lagu ke koleksi.');
            }
        });
    });

    // ==================== LIHAT ISI KOLEKSI DI SIDEBAR ====================
    document.querySelectorAll('.view-playlist-btn').forEach(link => {
        link.addEventListener('click', async (e) => {
            e.preventDefault();
            document.querySelectorAll('.view-playlist-btn').forEach(l => l.classList.remove('active-playlist'));
            link.classList.add('active-playlist');

            const plId = link.getAttribute('data-id');
            const plName = link.getAttribute('data-name');
            const plDesc = link.getAttribute('data-desc');

            const section = document.getElementById('detail-koleksi');
            const grid = document.getElementById('activePlaylistGrid');
            document.getElementById('activePlaylistTitle').textContent = `Koleksi: ${plName}`;
            document.getElementById('activePlaylistDesc').textContent = plDesc || 'Daftar lagu tersimpan dalam koleksi ini';

            section.classList.remove('d-none');
            grid.innerHTML = '<p class="text-info">Memuat lagu...</p>';
            section.scrollIntoView({ behavior: 'smooth' });

            try {
                const res = await fetch(`api_koleksi.php?action=get_playlist_songs&id_playlist=${plId}`);
                const data = await res.json();

                if (data.status === 'success' && data.songs.length > 0) {
                    const defaultCover = "https://images.unsplash.com/photo-1518709268805-4e9042af9f23?q=80&w=400&auto=format&fit=crop";
                    grid.innerHTML = data.songs.map(song => `
                        <div class="track-card play-trigger" 
                             data-id="${song.id_song}"
                             data-track="${song.title}" 
                             data-artist="${song.artist}" 
                             data-img="${defaultCover}"
                             data-audio="${song.file_path}">
                            <div class="track-img-wrapper">
                                <img src="${defaultCover}" alt="${song.title}" class="track-img">
                                <div class="track-play-btn"><i class="bi bi-play-fill"></i></div>
                            </div>
                            <div class="track-card-title">${song.title}</div>
                            <div class="track-card-artist">${song.artist}</div>
                            <div class="track-card-meta"><span>${song.genre || 'Music'}</span></div>
                        </div>
                    `).join('');
                } else {
                    grid.innerHTML = '<p class="text-secondary">Koleksi ini masih kosong. Klik tombol <strong>+</strong> pada kartu lagu di bawah untuk menambahkannya.</p>';
                }
            } catch (err) {
                grid.innerHTML = '<p class="text-danger">Gagal memuat isi koleksi.</p>';
            }
        });
    });

    document.getElementById('btnClosePlaylistView')?.addEventListener('click', () => {
        document.getElementById('detail-koleksi').classList.add('d-none');
        document.querySelectorAll('.view-playlist-btn').forEach(l => l.classList.remove('active-playlist'));
    });

    // ==================== KONTROL AUDIO PLAYER ====================
    if (audioPlayer) {
        audioPlayer.addEventListener('loadedmetadata', () => {
            if (durationTimeText) durationTimeText.textContent = formatTime(audioPlayer.duration);
        });

        audioPlayer.addEventListener('timeupdate', () => {
            if (currentTimeText) currentTimeText.textContent = formatTime(audioPlayer.currentTime);
            if (audioPlayer.duration > 0 && seekProgress) {
                seekProgress.style.width = `${(audioPlayer.currentTime / audioPlayer.duration) * 100}%`;
            }
        });

        audioPlayer.addEventListener('ended', () => {
            if (isRepeat) {
                audioPlayer.currentTime = 0;
                audioPlayer.play();
            } else {
                document.getElementById('btnNext')?.click();
            }
        });
    }

    btnMainPlay?.addEventListener('click', () => {
        if (!audioPlayer.src) {
            const first = document.querySelector('.play-trigger[data-audio]');
            if (first) first.click();
            return;
        }
        if (audioPlayer.paused) {
            audioPlayer.play();
            setPlayButtonState(true);
        } else {
            audioPlayer.pause();
            setPlayButtonState(false);
        }
    });

    seekBar?.addEventListener('click', (e) => {
        if (!audioPlayer.duration) return;
        const rect = seekBar.getBoundingClientRect();
        audioPlayer.currentTime = ((e.clientX - rect.left) / rect.width) * audioPlayer.duration;
    });

    volumeBar?.addEventListener('click', (e) => {
        const rect = volumeBar.getBoundingClientRect();
        currentVolume = Math.min(1, Math.max(0, (e.clientX - rect.left) / rect.width));
        audioPlayer.volume = currentVolume;
        audioPlayer.muted = false;
        isMuted = false;
        if (volumeProgress) volumeProgress.style.width = `${currentVolume * 100}%`;
        if (volumeIcon) volumeIcon.className = currentVolume === 0 ? 'bi bi-volume-mute text-danger' : 'bi bi-volume-up';
    });

    btnVolume?.addEventListener('click', () => {
        isMuted = !isMuted;
        audioPlayer.muted = isMuted;
        if (volumeProgress) volumeProgress.style.width = isMuted ? '0%' : `${currentVolume * 100}%`;
        if (volumeIcon) volumeIcon.className = isMuted ? 'bi bi-volume-mute text-danger' : 'bi bi-volume-up';
    });

    btnShuffle?.addEventListener('click', () => {
        isShuffle = !isShuffle;
        btnShuffle.classList.toggle('active', isShuffle);
        showToast(isShuffle ? 'Mode Acak: Aktif' : 'Mode Acak: Nonaktif');
    });

    btnRepeat?.addEventListener('click', () => {
        isRepeat = !isRepeat;
        btnRepeat.classList.toggle('active', isRepeat);
        showToast(isRepeat ? 'Ulangi Lagu: Aktif' : 'Ulangi Lagu: Nonaktif');
    });

    document.getElementById('btnNext')?.addEventListener('click', () => {
        const triggers = Array.from(document.querySelectorAll('.play-trigger[data-audio]'));
        if (triggers.length === 0) return;
        currentTrackIndex = isShuffle
            ? Math.floor(Math.random() * triggers.length)
            : (currentTrackIndex + 1) % triggers.length;
        triggers[currentTrackIndex].click();
    });

    document.getElementById('btnPrev')?.addEventListener('click', () => {
        const triggers = Array.from(document.querySelectorAll('.play-trigger[data-audio]'));
        if (triggers.length === 0) return;
        currentTrackIndex = (currentTrackIndex - 1 + triggers.length) % triggers.length;
        triggers[currentTrackIndex].click();
    });

    // Pencarian Real-time
    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            const query = e.target.value.toLowerCase().trim();
            document.querySelectorAll('.track-card, .quick-card').forEach(card => {
                card.style.display = card.textContent.toLowerCase().includes(query) ? '' : 'none';
            });
        });

        document.addEventListener('keydown', (e) => {
            if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'k') {
                e.preventDefault();
                searchInput.focus();
            }
        });
    }

    navSearchTrigger?.addEventListener('click', (e) => {
        e.preventDefault();
        searchInput?.focus();
    });
});

function showToast(message) {
    const toast = document.getElementById('toastNotification');
    const toastMsg = document.getElementById('toastMessage');
    if (!toast || !toastMsg) return;
    toastMsg.textContent = message;
    toast.classList.add('show');
    clearTimeout(window.toastTimer);
    window.toastTimer = setTimeout(() => toast.classList.remove('show'), 2800);
}