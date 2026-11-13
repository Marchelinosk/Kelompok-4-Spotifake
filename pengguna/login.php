<?php
session_start();
require_once 'config/database.php';

// Jika sudah login, langsung arahkan ke dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: pengguna/dashboard-pengguna.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Set session menggunakan kolom id_user dari database barumu
        $_SESSION['user_id'] = $user['id_user'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role']; // Disimpan untuk pengecekan akses admin/user nanti

        header("Location: pengguna/dashboard-pengguna.php");
        exit;
    } else {
        $error = "Email atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Spotifake</title>
    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Custom CSS Landing Page -->
    <link href="assets/css/landing.css" rel="stylesheet">
    <style>
        .form-control-custom {
            background-color: var(--bg-surface);
            border: 1px solid var(--border-glass);
            color: var(--text-primary);
            padding: 0.75rem 1rem;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .form-control-custom:focus {
            background-color: var(--bg-surface-hover);
            border-color: var(--accent-cyan);
            box-shadow: 0 0 0 0.25rem var(--accent-cyan-glow);
            color: #fff;
        }

        .form-label {
            color: var(--text-secondary);
            font-weight: 500;
            font-size: 0.95rem;
        }

        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        #toastNotification.show {
            display: block !important;
            opacity: 1 !important;
            animation: slideUp 0.3s ease forwards;
        }

        @keyframes slideUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Mengubah warna dan ketebalan teks placeholder di dalam input */
        .form-control-custom::placeholder {
            color: #ffffff !important;
            font-weight: bold !important;
            opacity: 0.8;
            /* Sengaja dibuat 0.8 agar sedikit lebih redup dari teks yang diketik user. Ubah ke 1 jika ingin putih pekat. */
        }
    </style>
</head>

<body>
    <div class="auth-wrapper">
        <div class="hero-visual-card w-100" style="max-width: 420px; padding: 2.5rem;">

            <div class="text-center mb-4">
                <div class="brand-icon mx-auto mb-3">S</div>
                <h3 class="hero-title" style="font-size: 2rem; margin-bottom: 0.5rem;">Masuk</h3>
                <p style="color: var(--text-secondary);">Lanjutkan ke akun Spotifake-mu</p>
            </div>

            <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
                <div class="alert alert-success bg-transparent border-success text-success" style="backdrop-filter: blur(10px);">
                    Pendaftaran berhasil! Silakan login.
                </div>
            <?php endif; ?>

            <?php if (isset($error)): ?>
                <div class="alert alert-danger bg-transparent border-danger text-danger" style="backdrop-filter: blur(10px);">
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="" class="auth-form">
                <div class="mb-3">
                    <label for="email" class="form-label text-white fw-bold">Email Address</label>
                    <input type="email" class="form-control form-control-custom" name="email" placeholder="example@email.com" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label text-white fw-bold">Password</label>
                    <div class="input-group">
                        <input type="password" id="loginPassword" class="form-control form-control-custom border-end-0" name="password" placeholder="••••••••" required>
                        <span class="input-group-text bg-transparent border-start-0" style="border-color: var(--border-glass); cursor: pointer;">
                            <i class="bi bi-eye text-secondary toggle-password" data-target="loginPassword"></i>
                        </span>
                    </div>
                </div>
                <button type="submit" class="btn-primary-custom w-100 justify-content-center border-0">
                    Masuk ke Spotifake
                </button>

                <div class="text-center mt-4 pt-2 border-top" style="border-color: var(--border-glass) !important;">
                    <p style="color: var(--text-secondary); font-size: 0.9rem;">
                        Belum punya akun? <a href="register.php" style="color: var(--accent-cyan); text-decoration: none; font-weight: 600;">Daftar sekarang</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <!-- Toast Notification UI -->
    <div id="toastNotification" class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080; display: none; transition: opacity 0.3s ease; opacity: 0;">
        <div class="toast show align-items-center text-white bg-dark border-0 shadow-lg" style="border-radius: 12px; border: 1px solid var(--border-cyan) !important;">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi bi-info-circle text-info me-2"></i>
                    <span id="toastMessage">Pesan notifikasi</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Script JS -->
    <script src="assets/js/pengguna/script.js"></script>
</body>

</html>