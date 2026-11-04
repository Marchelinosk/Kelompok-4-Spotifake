<?php
$appName = "Spotifake";
$pageTitle = "Spotifake - Musik Favoritmu, Tanpa Batas!";

$description = "Nikmati jutaan lagu dan podcast favoritmu kapan saja tanpa biaya langganan. Didesain dengan antarmuka modern bernuansa synthwave, rasakan pengalaman streaming audio beresolusi tinggi di setiap dentumannya.";

$features = [
    [
        "icon" => "bi-search-heart",
        "title" => "Pencarian Musik",
        "description" => "Temukan berbagai lagu, artis, album, dan podcast favoritmu secara instan dengan pencarian pintar."
    ],
    [
        "icon" => "bi-play-circle-fill",
        "title" => "Pemutaran Musik",
        "description" => "Streaming lossless audio dengan latensi rendah langsung melalui browser tanpa instalasi aplikasi tambahan."
    ],
    [
        "icon" => "bi-music-note-list",
        "title" => "Playlist Pribadi",
        "description" => "Buat, atur, dan personalisasikan daftar putar untuk setiap mood, fokus belajar, hingga santai malam."
    ],
    [
        "icon" => "bi-share-fill",
        "title" => "Berbagi Musik",
        "description" => "Bagikan lagu dan kurasi playlist terbaikmu dengan mudah kepada teman maupun media sosial."
    ]
];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle); ?></title>

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Custom Landing CSS -->
    <link rel="stylesheet" href="assets/css/pengguna/landing.css">
</head>

<body>

    <!-- Header Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <span class="brand-icon">
                    <i class="bi bi-soundwave"></i>
                </span>
                <?= htmlspecialchars($appName); ?>
            </a>

            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list fs-2 text-white"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="#beranda">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#fitur">Fitur Unggulan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tentang">Tentang</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-2 mt-3 mt-lg-0">
                    <a href="pengguna/index.php" class="btn-dashboard-nav">
                        <i class="bi bi-grid-fill"></i> Masuk / Dashboard
                    </a>
                    <a href="pengguna/index.php" class="btn-register-nav">
                        <i class="bi bi-sparkles"></i> Daftar Gratis
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section" id="beranda">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="hero-badge">
                        <i class="bi bi-disc"></i> Spotifake Web Experience 2026
                    </div>
                    <h1 class="hero-title">
                        Musik Favoritmu,<br>
                        <span>Tanpa Batas!</span>
                    </h1>
                    <p class="hero-description">
                        <?= htmlspecialchars($description); ?>
                    </p>
                    <div class="hero-buttons">
                        <a href="pengguna/index.php" class="btn-primary-custom">
                            <i class="bi bi-play-fill fs-5"></i> Mulai Sekarang
                        </a>
                        <a href="#fitur" class="btn-outline-custom">
                            <i class="bi bi-compass"></i> Jelajahi Fitur
                        </a>
                    </div>
                </div>

                <div class="col-lg-5 hero-visual-col">
                    <div class="hero-visual-card">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="preview-badge text-info">
                                <i class="bi bi-broadcast"></i> SEDANG DIPUTAR
                            </span>
                            <span class="text-white-50 small">Lossless Audio • 432Hz</span>
                        </div>

                        <div class="mini-player-preview">
                            <div class="vinyl-disc">
                                <div class="vinyl-center"></div>
                            </div>
                            <div class="preview-info flex-grow-1">
                                <h4>Frostwave Vol. 1</h4>
                                <p>Arctic Mirage • Synthwave Kutub</p>
                                <div class="preview-bar">
                                    <div class="preview-progress"></div>
                                </div>
                            </div>
                        </div>

                        <div class="preview-tags">
                            <span class="preview-badge"><i class="bi bi-check-circle-fill text-success"></i> 24-bit / 96kHz</span>
                            <span class="preview-badge"><i class="bi bi-shield-lock-fill text-info"></i> HLS Secure</span>
                            <span class="preview-badge"><i class="bi bi-lightning-charge-fill text-warning"></i> 0 Latency</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Feature Section (4 Kolom Grid) -->
    <section class="feature-section" id="fitur">
        <div class="container">
            <div class="section-heading text-center">
                <span class="section-tag">FITUR UNGGULAN SPOTIFAKE</span>
                <h2 class="section-title text-white">Streaming Musik Lebih Maksimal</h2>
                <p class="section-desc">Nikmati berbagai kemudahan dan fitur cerdas yang dirancang untuk pengalaman mendengarkan musik masa kini.</p>
            </div>

            <div class="row g-4">
                <?php foreach ($features as $feature): ?>
                    <div class="col-md-6 col-lg-3">
                        <div class="feature-card">
                            <div class="feature-icon-wrapper">
                                <i class="bi <?= htmlspecialchars($feature['icon']); ?>"></i>
                            </div>
                            <h5><?= htmlspecialchars($feature['title']); ?></h5>
                            <p><?= htmlspecialchars($feature['description']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- About / Call-to-Action Section -->
    <section class="about-section" id="tentang">
        <div class="container">
            <div class="cta-box">
                <div class="cta-glow"></div>
                <div class="position-relative">
                    <div class="cta-icon-circle">
                        <i class="bi bi-headphones"></i>
                    </div>
                    <h2 class="cta-title text-white">Musik Lebih Dekat, Tanpa Biaya!</h2>
                    <p class="cta-desc">
                        Spotifake hadir sebagai platform streaming musik berbasis web yang memberikan kebebasan penuh kepada pengguna untuk menikmati lagu dan podcast, mengelola playlist impian, serta merasakan audio berkelas tanpa biaya langganan apapun.
                    </p>
                    <a href="pengguna/index.php" class="btn-primary-custom">
                        <i class="bi bi-stars"></i> Gabung Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="landing-footer">
        <div class="container">
            <div class="footer-content">
                <div class="d-flex align-items-center gap-2">
                    <span class="brand-icon" style="width: 28px; height: 28px; font-size: 0.85rem;">
                        <i class="bi bi-soundwave"></i>
                    </span>
                    <span class="fw-bold text-white"><?= htmlspecialchars($appName); ?></span>
                </div>
                <p class="footer-copy">
                    &copy; 2026 <?= htmlspecialchars($appName); ?>. All Rights Reserved.
                </p>
                <div class="footer-links">
                    <a href="#beranda">Beranda</a>
                    <a href="#fitur">Fitur Unggulan</a>
                    <a href="pengguna/index.php">Mulai Dengarkan</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
