/**
 * Spotifake - Core Audio Player Script
 * Menangani pemutaran audio, seekbar, volume slider, dan status playback
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
    const btnShuffle = document.getElementById('btnShuffle');
    const btnRepeat = document.getElementById('btnRepeat');
    const btnNext = document.getElementById('btnNext');
    const btnPrev = document.getElementById('btnPrev');

    // Helper: Format detik ke MM:SS
    function formatTime(seconds) {
        const mins = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
    }

    // Helper: Parse MM:SS ke detik
    function parseTimeString(timeStr) {
        if (!timeStr) return 210;
        if (timeStr.includes(':')) {
            const parts = timeStr.split(':');
            return parseInt(parts[0], 10) * 60 + parseInt(parts[1], 10);
        }
        return 200;
    }

    // Update Progress Bar
    function updatePlayerProgress() {
        if (!seekProgress || !currentTimeText || !durationTimeText) return;
        if (totalSeconds <= 0) totalSeconds = 1;
        const percent = Math.min(100, Math.max(0, (currentSeconds / totalSeconds) * 100));
        seekProgress.style.width = `${percent}%`;
        currentTimeText.textContent = formatTime(currentSeconds);
        durationTimeText.textContent = formatTime(totalSeconds);
    }

    // Toggle Play / Pause
    function togglePlay(state = null) {
        if (!playIcon || !btnMainPlay) return;
        isPlaying = state !== null ? state : !isPlaying;

        if (isPlaying) {
            playIcon.classList.remove('bi-play-fill');
            playIcon.classList.add('bi-pause-fill');
            btnMainPlay.style.transform = 'scale(1.05)';
            
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
        } else {
            playIcon.classList.remove('bi-pause-fill');
            playIcon.classList.add('bi-play-fill');
            btnMainPlay.style.transform = 'scale(1)';
            clearInterval(playTimer);
        }
    }

    // Putar Lagu Tertentu
    function playTrack(title, artist, durationStr, imgUrl) {
        if (currentTitle) currentTitle.textContent = title || 'Lagu Pilihan';
        if (currentArtist) currentArtist.textContent = artist || 'Artis Spotifake';
        if (currentCover && imgUrl) currentCover.src = imgUrl;

        totalSeconds = parseTimeString(durationStr);
        currentSeconds = 0;
        updatePlayerProgress();
        togglePlay(true);

        showToast(`Memutar: ${title}`);
    }

    // Bind klik pada semua card & baris lagu (.play-trigger)
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

    // Tombol Play/Pause Utama
    if (btnMainPlay) {
        btnMainPlay.addEventListener('click', () => {
            togglePlay();
            showToast(isPlaying ? `Melanjutkan: ${currentTitle ? currentTitle.textContent : 'Musik'}` : 'Audio dijeda');
        });
    }

    // Interaksi Seekbar
    if (seekBar) {
        seekBar.addEventListener('click', (e) => {
            const rect = seekBar.getBoundingClientRect();
            const clickX = e.clientX - rect.left;
            const percent = Math.min(1, Math.max(0, clickX / rect.width));
            currentSeconds = Math.floor(percent * totalSeconds);
            updatePlayerProgress();
        });
    }

    // Interaksi Volume Bar
    if (volumeBar) {
        volumeBar.addEventListener('click', (e) => {
            const rect = volumeBar.getBoundingClientRect();
            const clickX = e.clientX - rect.left;
            currentVolume = Math.min(1, Math.max(0, clickX / rect.width));
            volumeProgress.style.width = `${currentVolume * 100}%`;
            isMuted = false;
            updateVolumeIcon();
        });
    }

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
            if (volumeProgress) {
                volumeProgress.style.width = isMuted ? '0%' : `${currentVolume * 100}%`;
            }
            updateVolumeIcon();
        });
    }

    // Like Button di Player Bar
    if (btnLike) {
        btnLike.addEventListener('click', () => {
            btnLike.classList.toggle('liked');
            const heartIcon = btnLike.querySelector('i');
            if (btnLike.classList.contains('liked')) {
                heartIcon.className = 'bi bi-heart-fill text-danger';
                showToast(`Menambahkan ke Lagu Disukai ❤️`);
            } else {
                heartIcon.className = 'bi bi-heart';
                showToast(`Menghapus dari Lagu Disukai`);
            }
        });
    }

    // Shuffle & Repeat
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

    // Next / Prev
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

    // Inisialisasi awal
    updatePlayerProgress();
});

// Toast Notifikasi Global
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
