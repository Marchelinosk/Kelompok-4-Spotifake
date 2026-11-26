/**
 * Spotifake - Fitur Autentikasi Script (UI-001)
 */

document.addEventListener('DOMContentLoaded', () => {
    // Toggle Show/Hide Password
    const toggleBtns = document.querySelectorAll('.toggle-password');
    toggleBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const targetId = btn.getAttribute('data-target');
            const targetInput = document.getElementById(targetId);
            if (targetInput) {
                if (targetInput.type === 'password') {
                    targetInput.type = 'text';
                    btn.classList.remove('bi-eye');
                    btn.classList.add('bi-eye-slash');
                } else {
                    targetInput.type = 'password';
                    btn.classList.remove('bi-eye-slash');
                    btn.classList.add('bi-eye');
                }
            }
        });
    });
});
