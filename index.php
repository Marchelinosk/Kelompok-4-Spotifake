
<?php
$appName = "Spotifake";

$description = "Nikmati musik dan podcast favoritmu kapan saja. Temukan lagu baru, buat playlist sesuai seleramu, dan bagikan musik favorit bersama teman. Semua bisa dinikmati secara gratis!";

$features = [
    [
        "icon" => "bi-search",
        "title" => "Pencarian Musik",
        "description" => "Cari dan temukan berbagai lagu serta podcast favorit dengan mudah."
    ],
    [
        "icon" => "bi-play-circle",
        "title" => "Pemutaran Musik",
        "description" => "Putar dan nikmati musik favoritmu langsung melalui website."
    ],
    [
        "icon" => "bi-music-note-list",
        "title" => "Playlist Pribadi",
        "description" => "Buat, simpan, dan kelola playlist sesuai selera musikmu."
    ],
    [
        "icon" => "bi-share",
        "title" => "Berbagi Musik",
        "description" => "Bagikan lagu dan playlist favorit kepada pengguna lain maupun media sosial."
    ]
];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $appName; ?> - Free Music Streaming</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">

            <a class="navbar-brand" href="index.php">
                <i class="bi bi-music-note-beamed"></i>
                <?= $appName; ?>
            </a>

            <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav ms-auto align-items-lg-center">

                    <li class="nav-item">
                        <a class="nav-link" href="#beranda">Beranda</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#fitur">Fitur</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Masuk</a>
                    </li>

                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                        <a href="register.php" class="btn btn-register">
                            Daftar Gratis
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>


    <!-- Hero Section -->
    <section class="hero-section" id="beranda">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-7">
                    <h1>
                        Musik Favoritmu,
                        <span>Tanpa Batas!</span>
                    </h1>

                    <p class="hero-description">
                        <?= htmlspecialchars($description); ?>
                    </p>

                    <div class="hero-buttons">
                        <a href="register.php" class="btn btn-primary-custom">
                            Mulai Sekarang
                            <i class="bi bi-arrow-right"></i>
                        </a>

                        <a href="#fitur" class="btn btn-outline-custom">
                            Jelajahi Fitur
                        </a>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="hero-image">
                        <i class="bi bi-disc-fill"></i>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- Feature Section -->
    <section class="feature-section" id="fitur">
        <div class="container">

            <div class="section-heading text-center">
                <h2>Fitur Unggulan Spotifake</h2>

                <p>
                    Nikmati berbagai fitur untuk pengalaman mendengarkan
                    musik yang lebih menyenangkan.
                </p>
            </div>

            <div class="row g-4">

                <?php foreach ($features as $feature): ?>

                    <div class="col-md-6 col-lg-3">
                        <div class="feature-card">

                            <div class="feature-icon">
                                <i class="bi <?= $feature['icon']; ?>"></i>
                            </div>

                            <h5>
                                <?= htmlspecialchars($feature['title']); ?>
                            </h5>

                            <p>
                                <?= htmlspecialchars($feature['description']); ?>
                            </p>

                        </div>
                    </div>

                <?php endforeach; ?>

            </div>
        </div>
    </section>


    <!-- About Section -->
    <section class="about-section">
        <div class="container">

            <div class="about-content text-center">

                <i class="bi bi-headphones about-icon"></i>

                <h2>Musik Lebih Dekat, Tanpa Biaya!</h2>

                <p>
                    Spotifake hadir sebagai platform streaming musik
                    berbasis website yang memberikan kebebasan kepada
                    pengguna untuk menikmati lagu dan podcast,
                    mengelola playlist, serta berbagi musik favorit
                    tanpa biaya langganan.
                </p>

                <a href="register.php" class="btn btn-primary-custom">
                    Gabung Sekarang
                </a>

            </div>

        </div>
    </section>


    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>
                &copy; <?= date("Y"); ?> Spotifake.
                All Rights Reserved.
            </p>
        </div>
    </footer>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
