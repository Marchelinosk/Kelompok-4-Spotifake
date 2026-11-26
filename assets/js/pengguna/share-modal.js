/**
 * Spotifake - Fitur Modal Bagikan (UI-005C)
 */

function copyShareLink() {
    const copyInput = document.getElementById('shareUrlInput');
    if (copyInput) {
        copyInput.select();
        navigator.clipboard.writeText(copyInput.value);
        showToast('Tautan berhasil disalin ke clipboard! 📋');
    }
}
