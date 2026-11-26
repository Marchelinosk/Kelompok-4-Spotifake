/**
 * Spotifake - Fitur Detail & Manajemen Playlist Script (UI-005 & UI-005B)
 */

function toggleAddSongSection() {
    const box = document.getElementById('addSongBox');
    if (box) {
        box.style.display = box.style.display === 'none' ? 'block' : 'none';
    }
}

function addSongMock(title) {
    showToast('Lagu "' + title + '" berhasil ditambahkan ke playlist! 🎵');
    toggleAddSongSection();
}

function removeSongRow(btn, songTitle) {
    if (confirm('Hapus lagu "' + songTitle + '" dari playlist ini?')) {
        const tr = btn.closest('tr');
        if (tr) {
            tr.style.opacity = '0';
            tr.style.transform = 'translateX(20px)';
            tr.style.transition = 'all 0.25s ease';
            setTimeout(() => tr.remove(), 250);
            showToast('Lagu "' + songTitle + '" dihapus dari playlist');
        }
    }
}

function toggleFollowPlaylist(btn) {
    const icon = btn.querySelector('i');
    if (icon.classList.contains('bi-bookmark-plus')) {
        icon.className = 'bi bi-bookmark-check-fill text-info';
        showToast('Playlist disimpan ke Koleksi Saya! ✨');
    } else {
        icon.className = 'bi bi-bookmark-plus';
        showToast('Playlist dihapus dari Koleksi Saya');
    }
}
