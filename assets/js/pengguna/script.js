/**
 * Spotifake - Interactive User Player Script
 * Handcrafted for seamless audio player experience
 */

document.addEventListener('DOMContentLoaded', () => {
    // Player State
    let isPlaying = false;
    let isMuted = false;
    let currentVolume = 0.7;
    let currentSeconds = 105; // 01:45
    let totalSeconds = 232;   // 03:52
    let playTimer = null;

    // DOM Elements
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
    const btnHeroFav = document.getElementById('btnHeroFav');
    const searchInput = document.getElementById('searchInput');
    const btnShuffle = document.getElementById('btnShuffle');
    const btnRepeat = document.getElementById('btnRepeat');
    const navSearchTrigger = document.getElementById('navSearchTrigger');
    const navCreatePlaylist = document.getElementById('navCreatePlaylist');

    // Helper: Format seconds into MM:SS
    function formatTime(seconds) {
        const mins = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
    }

    // Helper: Parse MM:SS or "42 Menit" to seconds
    function parseTimeString(timeStr) {
        if (!timeStr) return 210;
        if (timeStr.includes(':')) {
            const parts = timeStr.split(':');
            return parseInt(parts[0], 10) * 60 + parseInt(parts[1], 10);
        }
        if (timeStr.includes('Menit')) {
            const mins = parseInt(timeStr, 10);
            return isNaN(mins) ? 240 : mins * 60;
        }
        return 200;
    }

    // Update Player UI
    function updatePlayerProgress() {
        if (totalSeconds <= 0) totalSeconds = 1;
        const percent = Math.min(100, Math.max(0, (currentSeconds / totalSeconds) * 100));
        if (seekProgress) seekProgress.style.width = `${percent}%`;
        if (currentTimeText) currentTimeText.textContent = formatTime(currentSeconds);
        if (durationTimeText) durationTimeText.textContent = formatTime(totalSeconds);
    }

    // Toggle Play / Pause
    function togglePlay(state = null) {
        isPlaying = state !== null ? state : !isPlaying;

        if (isPlaying && playIcon) {
            playIcon.classList.remove('bi-play-fill');
            playIcon.classList.add('bi-pause-fill');
            if (btnMainPlay) btnMainPlay.style.transform = 'scale(1.05)';
            
            clearInterval(playTimer);
            playTimer = setInterval(() => {
                if (currentSeconds < totalSeconds) {
                    currentSeconds++;
                    updatePlayerProgress();
                } else {
                    currentSeconds = 0;
                    togglePlay(false);
                }
            }, 1000);
        } else if (playIcon) {
            playIcon.classList.remove('bi-pause-fill');
            playIcon.classList.add('bi-play-fill');
            if (btnMainPlay) btnMainPlay.style.transform = 'scale(1)';
            clearInterval(playTimer);
        }
    }

    // Play specific track
    function playTrack(title, artist, durationStr, imgUrl) {
        if (currentTitle) currentTitle.textContent = title || 'Lagu Pilihan';
        if (currentArtist) currentArtist.textContent = artist || 'Artis Spotifake';
        if (imgUrl && currentCover) currentCover.src = imgUrl;

        totalSeconds = parseTimeString(durationStr);
        currentSeconds = 0;
        updatePlayerProgress();
        togglePlay(true);

        showToast(`Memutar: ${title}`);
    }

    // Event Listeners for Play triggers across the entire page
    document.querySelectorAll('.play-trigger, .btn-hero-play').forEach(trigger => {
        trigger.addEventListener('click', (e) => {
            e.preventDefault();
            const track = trigger.getAttribute('data-track');
            const artist = trigger.getAttribute('data-artist');
            const duration = trigger.getAttribute('data-duration');
            const img = trigger.getAttribute('data-img');
            playTrack(track, artist, duration, img);
        });
    });

    // Main Play/Pause Button
    if (btnMainPlay) {
        btnMainPlay.addEventListener('click', () => {
            togglePlay();
            showToast(isPlaying ? `Melanjutkan: ${currentTitle.textContent}` : 'Audio dijeda');
        });
    }

    // Seekbar Click / Drag
    if (seekBar) {
        seekBar.addEventListener('click', (e) => {
            const rect = seekBar.getBoundingClientRect();
            const clickX = e.clientX - rect.left;
            const percent = Math.min(1, Math.max(0, clickX / rect.width));
            currentSeconds = Math.floor(percent * totalSeconds);
            updatePlayerProgress();
        });
    }

    // Volume Bar Click
    if (volumeBar) {
        volumeBar.addEventListener('click', (e) => {
            const rect = volumeBar.getBoundingClientRect();
            const clickX = e.clientX - rect.left;
            currentVolume = Math.min(1, Math.max(0, clickX / rect.width));
            if (volumeProgress) volumeProgress.style.width = `${currentVolume * 100}%`;
            isMuted = false;
            updateVolumeIcon();
        });
    }

    // Volume Mute Toggle
    function updateVolumeIcon() {
        if (!volumeIcon) return;
        if (isMuted || currentVolume === 0) {
            volumeIcon.className = 'bi bi-volume-mute text-danger';
        } else if (currentVolume < 0.5) {
            volumeIcon.className = 'bi bi-volume-down';
        } else {
            volumeIcon.className = 'bi bi-volume-up';
        }
    }

    if (btnVolume) {
        btnVolume.addEventListener('click', () => {
            isMuted = !isMuted;
            if (isMuted && volumeProgress) {
                volumeProgress.style.width = '0%';
            } else if (volumeProgress) {
                volumeProgress.style.width = `${currentVolume * 100}%`;
            }
            updateVolumeIcon();
        });
    }

    // Like Button Toggle
    if (btnLike) {
        btnLike.addEventListener('click', () => {
            btnLike.classList.toggle('liked');
            const heartIcon = btnLike.querySelector('i');
            if (btnLike.classList.contains('liked')) {
                heartIcon.className = 'bi bi-heart-fill text-danger';
                showToast(`Menambahkan "${currentTitle.textContent}" ke Lagu Disukai ❤️`);
            } else {
                heartIcon.className = 'bi bi-heart';
                showToast(`Menghapus dari Lagu Disukai`);
            }
        });
    }

    // Hero Favorite Button
    if (btnHeroFav) {
        btnHeroFav.addEventListener('click', () => {
            const heartIcon = btnHeroFav.querySelector('i');
            if (heartIcon.classList.contains('bi-heart-fill')) {
                heartIcon.className = 'bi bi-heart';
                btnHeroFav.innerHTML = '<i class="bi bi-heart"></i> Tambahkan ke Favorit';
                showToast('Dihapus dari album favorit');
            } else {
                heartIcon.className = 'bi bi-heart-fill text-danger';
                btnHeroFav.innerHTML = '<i class="bi bi-heart-fill text-danger"></i> Tersimpan di Favorit';
                showToast('Frostwave Vol. 1 ditambahkan ke Album Favorit ✨');
            }
        });
    }

    // Shuffle & Repeat buttons
    if (btnShuffle) {
        btnShuffle.addEventListener('click', () => {
            btnShuffle.classList.toggle('active');
            showToast(btnShuffle.classList.contains('active') ? 'Mode Acak: Aktif' : 'Mode Acak: Nonaktif');
        });
    }

    if (btnRepeat) {
        btnRepeat.addEventListener('click', () => {
            btnRepeat.classList.toggle('active');
            showToast(btnRepeat.classList.contains('active') ? 'Ulangi Lagu: Aktif' : 'Ulangi Lagu: Nonaktif');
        });
    }

    // Next / Prev simulation
    const btnNext = document.getElementById('btnNext');
    const btnPrev = document.getElementById('btnPrev');
    if (btnNext) {
        btnNext.addEventListener('click', () => {
            showToast('Memutar lagu berikutnya di antrean ⏭️');
            currentSeconds = 0;
            updatePlayerProgress();
            togglePlay(true);
        });
    }
    if (btnPrev) {
        btnPrev.addEventListener('click', () => {
            showToast('Mengulang lagu sebelumnya ⏮️');
            currentSeconds = 0;
            updatePlayerProgress();
            togglePlay(true);
        });
    }

    // Shortcut Ctrl+K / Cmd+K to Search
    document.addEventListener('keydown', (e) => {
        if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'k') {
            e.preventDefault();
            if (searchInput) searchInput.focus();
        }
    });

    if (navSearchTrigger && searchInput) {
        navSearchTrigger.addEventListener('click', (e) => {
            e.preventDefault();
            searchInput.focus();
            showToast('Ketik judul lagu atau artis pada pencarian');
        });
    }

    if (navCreatePlaylist) {
        navCreatePlaylist.addEventListener('click', (e) => {
            e.preventDefault();
            const playlistName = prompt('Beri nama playlist baru Anda:', 'Playlist Santai Saya #1');
            if (playlistName) {
                showToast(`Playlist "${playlistName}" berhasil dibuat! 🎵`);
            }
        });
    }

    // Realtime Search Filter on Cards
    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            const query = e.target.value.toLowerCase().trim();
            const cards = document.querySelectorAll('.track-card, .quick-card, .podcast-card');
            
            cards.forEach(card => {
                const text = card.textContent.toLowerCase();
                if (text.includes(query) || query === '') {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }

    // ==========================================
    // FITUR INTERAKTIF UNTUK LOGIN & REGISTER
    // ==========================================

    // 1. Toggle Show/Hide Password
    const togglePasswordIcons = document.querySelectorAll('.toggle-password');
    togglePasswordIcons.forEach(icon => {
        icon.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            
            if (input.type === 'password') {
                input.type = 'text';
                this.classList.remove('bi-eye');
                this.classList.add('bi-eye-slash');
                showToast('Password ditampilkan');
            } else {
                input.type = 'password';
                this.classList.remove('bi-eye-slash');
                this.classList.add('bi-eye');
            }
        });
    });

    // 2. Animasi Loading Saat Form Disubmit
    const authForms = document.querySelectorAll('.auth-form');
    authForms.forEach(form => {
        form.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Memproses...';
                submitBtn.style.opacity = '0.8';
                submitBtn.style.pointerEvents = 'none';
            }
        });
    });

    // Initial setup
    updatePlayerProgress();
});

// Global Toast Notification Helper
function showToast(message) {
    const toast = document.getElementById('toastNotification');
    const toastMsg = document.getElementById('toastMessage');
    if (!toast || !toastMsg) return;

    toastMsg.textContent = message;
    toast.classList.add('show');

    clearTimeout(window.toastTimer);
    window.toastTimer = setTimeout(() => {
        toast.classList.remove('show');
    }, 2800);
}