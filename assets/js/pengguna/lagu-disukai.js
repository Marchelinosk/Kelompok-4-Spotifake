/**
 * Spotifake - Fitur Lagu yang Disukai Script (UI-004)
 */

function toggleLikeRow(btn, songTitle) {
    const icon = btn.querySelector('i');
    if (icon.classList.contains('bi-heart-fill')) {
        icon.className = 'bi bi-heart text-secondary fs-5';
        showToast(`Menghapus "${songTitle}" dari Lagu Disukai`);
    } else {
        icon.className = 'bi bi-heart-fill text-danger fs-5';
        showToast(`Menambahkan "${songTitle}" ke Lagu Disukai ❤️`);
    }
}
