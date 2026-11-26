/**
 * Spotifake - Fitur Pencarian Script (UI-003)
 */

document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('searchInput');

    // Realtime search filter pada hasil lagu
    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            const query = e.target.value.toLowerCase().trim();
            const songRows = document.querySelectorAll('.song-table tbody tr');

            songRows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(query) || query === '') {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Shortcut keyboard ⌘K / Ctrl+K
        document.addEventListener('keydown', (e) => {
            if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'k') {
                e.preventDefault();
                searchInput.focus();
            }
        });
    }
});

// Filter Kategori Chips
function filterGenre(btn, genreName) {
    if (btn) {
        document.querySelectorAll('.chip-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
    }
    showToast('Menampilkan kategori: ' + genreName);
}
