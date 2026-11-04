<?php
$pageTitle = "Spotifake - Web Audio Player";
$userName = "Alya Auralia";

// Data Rangkuman Aktivitas (2x3 Grid)
$quickPicks = [
    [
        "title" => "Chill Lofi Beats",
        "desc" => "48 Lagu • Mix Santai",
        "img" => "https://images.unsplash.com/photo-1518709268805-4e9042af9f23?q=80&w=300&auto=format&fit=crop",
        "track" => "Chill Lofi Beats",
        "artist" => "Lo-Fi Dreamer",
        "duration" => "02:45"
    ],
    [
        "title" => "Top Indonesian Hits 2026",
        "desc" => "Tangga Lagu Mingguan",
        "img" => "https://images.unsplash.com/photo-1470225620780-dba8ba36b745?q=80&w=300&auto=format&fit=crop",
        "track" => "Top Indonesian Hits 2026",
        "artist" => "Indo Chart Radio",
        "duration" => "03:22"
    ],
    [
        "title" => "Deep Focus Synth",
        "desc" => "Karya & Coding Mode",
        "img" => "https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=300&auto=format&fit=crop",
        "track" => "Deep Focus Synth",
        "artist" => "Cyber Pulse",
        "duration" => "04:10"
    ],
    [
        "title" => "Daily Mix 1",
        "desc" => "Hindia, Feast, Pamungkas",
        "img" => "https://images.unsplash.com/photo-1508700115892-45ecd05ae2ad?q=80&w=300&auto=format&fit=crop",
        "track" => "Evaluasi Hati",
        "artist" => "Hindia & Feast",
        "duration" => "03:40"
    ],
    [
        "title" => "Koleksi Lagu Disukai",
        "desc" => "128 Lagu Tersimpan",
        "icon" => "bi-heart-fill",
        "track" => "Midnight Romance",
        "artist" => "The Night Owls",
        "duration" => "03:15"
    ],
    [
        "title" => "Weekly Discovery",
        "desc" => "Diperbarui tiap Senin",
        "img" => "https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=300&auto=format&fit=crop",
        "track" => "Discovery Beats #42",
        "artist" => "Spotifake Curators",
        "duration" => "02:58"
    ]
];

// Data Baru Saja Diputar
$recentlyPlayed = [
    [
        "title" => "Midnight Echoes",
        "artist" => "Arctic Mirage",
        "time" => "03:52",
        "genre" => "Synth",
        "img" => "https://images.unsplash.com/photo-1509198397868-475647b2a1e5?q=80&w=400&auto=format&fit=crop"
    ],
    [
        "title" => "Lembah Baku",
        "artist" => "Kalandra",
        "time" => "04:15",
        "genre" => "Indie Pop",
        "img" => "https://images.unsplash.com/photo-1459749411175-04bf5292ceea?q=80&w=400&auto=format&fit=crop"
    ],
    [
        "title" => "Resonansi Senja",
        "artist" => "Jakarta Sunset Club",
        "time" => "03:10",
        "genre" => "Lo-fi",
        "img" => "https://images.unsplash.com/photo-1501386761578-eac5c94b800a?q=80&w=400&auto=format&fit=crop"
    ],
    [
        "title" => "Pendar Renjana",
        "artist" => "Luna Maya Synth",
        "time" => "02:45",
        "genre" => "Acoustic",
        "img" => "https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?q=80&w=400&auto=format&fit=crop"
    ],
    [
        "title" => "Hujan di Sudut Kota",
        "artist" => "Niskala Nada",
        "time" => "04:02",
        "genre" => "Chillout",
        "img" => "https://images.unsplash.com/photo-1518609878373-06d740f60d8b?q=80&w=400&auto=format&fit=crop"
    ],
    [
        "title" => "Arus Frekuensi 2.0",
        "artist" => "Subzero Lab",
        "time" => "05:20",
        "genre" => "Electronic",
        "img" => "https://images.unsplash.com/photo-1518709268805-4e9042af9f23?q=80&w=400&auto=format&fit=crop"
    ]
];

// Data Rekomendasi Teratas
$topRecommendations = [
    [
        "tag" => "SOROTAN ARTIS",
        "badge_class" => "badge-blue",
        "sub" => "Top #1 Minggu Ini",
        "name" => "Arctic Echoes",
        "info" => "1.4M Pendengar Bulanan",
        "stat" => "10 Album Dirilis",
        "stat_icon" => "bi-disc",
        "action" => "Ikuti Artis",
        "img" => "https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=300&auto=format&fit=crop"
    ],
    [
        "tag" => "KURASI KHUSUS",
        "badge_class" => "badge-purple",
        "sub" => "32 Lagu • 2 Jam",
        "name" => "Melodi Senja",
        "info" => "Kurator: Algoritma Spotifake",
        "stat" => "Cocok 98% Preferensi",
        "stat_icon" => "bi-stars",
        "action" => "Diperbarui Kemarin",
        "img" => "https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=300&auto=format&fit=crop"
    ],
    [
        "tag" => "VIRAL LOKAL",
        "badge_class" => "badge-emerald",
        "sub" => "Trending #1 ID",
        "name" => "Indie Folk Nusantara",
        "info" => "Kalandra, Sore, Nadin",
        "stat" => "425K Pemutaran",
        "stat_icon" => "bi-graph-up-arrow",
        "action" => "Simpan Playlist",
        "img" => "https://images.unsplash.com/photo-1465847899084-d164df4dedc6?q=80&w=300&auto=format&fit=crop"
    ],
    [
        "tag" => "PILIHAN EDITOR",
        "badge_class" => "badge-amber",
        "sub" => "Tidur & Relaksasi",
        "name" => "Polar Night Ambient",
        "info" => "Gelombang Delta 0.5 - 4Hz",
        "stat" => "Tenang & Hening",
        "stat_icon" => "bi-moon-stars",
        "action" => "Bebas Gangguan",
        "img" => "https://images.unsplash.com/photo-1517411032315-54ef2cb783bb?q=80&w=300&auto=format&fit=crop"
    ]
];

// Data Podcast
$podcasts = [
    [
        "category" => "TEKNOLOGI WEB",
        "duration" => "42 Menit",
        "title" => "Eps. 84 • Arsitektur Web Audio API & Modern Streaming",
        "speaker" => "Hadir bersama Calvin H. Winata",
        "desc" => "Membahas arsitektur 3-tier sistem streaming modern, latensi transmisi berkas audio, dan integrasi HLS stream secure.",
        "date" => "14 Okt 2026",
        "img" => "https://images.unsplash.com/photo-1478737270239-2f02b77fc618?q=80&w=300&auto=format&fit=crop"
    ],
    [
        "category" => "DESAIN PRODUK",
        "duration" => "38 Menit",
        "title" => "Eps. 52 • Interface Design: Filosofi Glassmorphism & Micro-Interactions",
        "speaker" => "Diskusi bersama Elsya N. & Mario",
        "desc" => "Eksplorasi mendalam perancangan antarmuka pengguna berbasis 'Frozen Light', kontras warna icy cyan, dan ergonomi navigasi.",
        "date" => "12 Okt 2026",
        "img" => "https://images.unsplash.com/photo-1590602847861-f357a9332bbc?q=80&w=300&auto=format&fit=crop"
    ],
    [
        "category" => "INDUSTRI MUSIK",
        "duration" => "51 Menit",
        "title" => "Eps. 110 • Produksi Audio: Di Balik Layar Musik Indie Digital",
        "speaker" => "Eksklusif bersama Tim Audio Studio",
        "desc" => "Bagaimana produser independen menciptakan lanskap suara baru, teknik mastering synthwave modern, dan royalti digital 2026.",
        "date" => "09 Okt 2026",
        "img" => "https://images.unsplash.com/photo-1598488035139-bdbb2231ce04?q=80&w=300&auto=format&fit=crop"
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

    <!-- Custom User Dashboard CSS -->
    <link rel="stylesheet" href="../assets/css/pengguna/style.css">
</head>

<body>

    <div class="app-container">

        <!-- ==================== SIDEBAR (KIRI) ==================== -->
        <aside class="sidebar">
            <!-- Brand Logo -->
            <a href="index.php" class="brand-wrapper">
                <div class="brand-icon">
                    <i class="bi bi-soundwave"></i>
                </div>
                <span class="brand-name">Spotifake</span>
            </a>

            <!-- Menu Utama -->
            <ul class="sidebar-nav">
                <li>
                    <a href="index.php" class="nav-link-custom active">
                        <i class="bi bi-house-door-fill"></i>
                        <span>Beranda</span>
                    </a>
                </li>
                <li>
                    <a href="#cari" class="nav-link-custom" id="navSearchTrigger">
                        <i class="bi bi-search"></i>
                        <span>Cari</span>
                    </a>
                </li>
                <li>
                    <a href="#koleksi" class="nav-link-custom">
                        <i class="bi bi-collection-play"></i>
                        <span>Koleksi Saya</span>
                    </a>
                </li>
                <li>
                    <a href="#buat-playlist" class="nav-link-custom" id="navCreatePlaylist">
                        <i class="bi bi-plus-square"></i>
                        <span>Buat Playlist</span>
                    </a>
                </li>
            </ul>

            <!-- Playlist Section -->
            <div class="sidebar-heading">PLAYLISTS</div>
            <ul class="playlist-list">
                <li><a href="#chill" class="playlist-link">Chill Vibes</a></li>
                <li><a href="#top50" class="playlist-link">Weekly Top 50</a></li>
                <li><a href="#coding" class="playlist-link">Coding Session</a></li>
                <li><a href="#lofi" class="playlist-link">Night Drive Synth</a></li>
                <li><a href="#focus" class="playlist-link">Deep Focus Alpha</a></li>
            </ul>
        </aside>

        <!-- ==================== MAIN CONTENT WRAPPER ==================== -->
        <div class="main-wrapper">

            <!-- Topbar (Sticky Atas) -->
            <header class="topbar">
                <div class="topbar-left">
                    <div class="nav-arrows">
                        <button class="nav-arrow-btn" title="Kembali"><i class="bi bi-chevron-left"></i></button>
                        <button class="nav-arrow-btn" title="Maju"><i class="bi bi-chevron-right"></i></button>
                    </div>

                    <div class="topbar-search">
                        <i class="bi bi-search search-icon"></i>
                        <input type="text" id="searchInput" placeholder="Lagu, artis, atau podcast...">
                        <span class="shortcut-badge">⌘K</span>
                    </div>
                </div>

                <div class="topbar-right">
                    <a href="#premium" class="premium-badge">
                        <i class="bi bi-gem"></i> PREMIUM
                    </a>

                    <div class="user-profile">
                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=150&auto=format&fit=crop" alt="User Profile" class="user-avatar">
                        <span class="user-name"><?= htmlspecialchars($userName); ?></span>
                    </div>
                </div>
            </header>

            <!-- Scrollable Content Body -->
            <main class="content-body">

                <!-- 1. Hero Banner: Frostwave Vol. 1 -->
                <section class="hero-banner">
                    <div class="hero-banner-bg"></div>

                    <div class="hero-content">
                        <div class="hero-tagline">
                            <i class="bi bi-record-circle-fill text-info"></i>
                            RILIS EKSKLUSIF &bull; VOL. 01 &bull; 2026 EDITION
                        </div>
                        <div class="hero-category">GLACIER SOUNDSCAPE</div>
                        <h1 class="hero-title">Frostwave Vol. 1</h1>
                        <p class="hero-desc">
                            Koleksi audio imersif dengan sentuhan synthwave kutub, beat ambient terkalibrasi, dan harmoni frekuensi 432Hz untuk fokus mendalam.
                        </p>

                        <div class="hero-actions">
                            <button class="btn-hero-play" data-track="Frostwave Vol. 1" data-artist="Arctic Mirage" data-duration="04:20" data-img="https://images.unsplash.com/photo-1517411032315-54ef2cb783bb?q=80&w=300&auto=format&fit=crop">
                                <i class="bi bi-play-fill fs-5"></i> Dengarkan Sekarang
                            </button>
                            <button class="btn-hero-fav" id="btnHeroFav">
                                <i class="bi bi-heart"></i> Tambahkan ke Favorit
                            </button>
                            <button class="btn-hero-more" title="Opsi Lainnya">
                                <i class="bi bi-three-dots"></i>
                            </button>
                        </div>
                    </div>

                    <div class="hero-badge-right">
                        <div class="waveform-bars">
                            <div class="waveform-bar"></div>
                            <div class="waveform-bar"></div>
                            <div class="waveform-bar"></div>
                            <div class="waveform-bar"></div>
                        </div>
                        <span>Lossless 24-bit / 96kHz</span>
                    </div>
                </section>

                <!-- 2. Section: Selamat Malam, Alya (Rangkuman Aktivitas 2x3 Grid) -->
                <section class="dashboard-section">
                    <div class="section-header-row">
                        <div>
                            <span class="section-pretitle">RANGKUMAN AKTIVITAS</span>
                            <h2 class="section-main-title">Selamat Malam, <?= htmlspecialchars($userName); ?></h2>
                        </div>
                        <div class="sync-status">
                            Sinkronisasi Audio: <span class="text-info fw-bold">Aktif (2026.1C)</span>
                        </div>
                    </div>

                    <div class="quick-grid">
                        <?php foreach ($quickPicks as $pick): ?>
                            <div class="quick-card play-trigger" data-track="<?= htmlspecialchars($pick['track']); ?>" data-artist="<?= htmlspecialchars($pick['artist']); ?>" data-duration="<?= htmlspecialchars($pick['duration']); ?>" data-img="<?= isset($pick['img']) ? htmlspecialchars($pick['img']) : 'https://images.unsplash.com/photo-1509198397868-475647b2a1e5?q=80&w=300&auto=format&fit=crop'; ?>">
                                <?php if (isset($pick['img'])): ?>
                                    <img src="<?= htmlspecialchars($pick['img']); ?>" alt="<?= htmlspecialchars($pick['title']); ?>" class="quick-card-img">
                                <?php else: ?>
                                    <div class="quick-card-icon">
                                        <i class="bi <?= htmlspecialchars($pick['icon']); ?>"></i>
                                    </div>
                                <?php endif; ?>

                                <div class="quick-card-info">
                                    <div class="quick-card-title"><?= htmlspecialchars($pick['title']); ?></div>
                                    <div class="quick-card-desc"><?= htmlspecialchars($pick['desc']); ?></div>
                                </div>

                                <div class="quick-card-play">
                                    <i class="bi bi-play-fill fs-5"></i>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>

                <!-- 3. Section: Baru Saja Diputar -->
                <section class="dashboard-section">
                    <div class="section-header-row">
                        <div>
                            <h2 class="section-main-title">Baru Saja Diputar</h2>
                            <div class="section-subtitle">Lanjutkan lagu terakhir dari riwayat pemutaranmu</div>
                        </div>
                        <a href="#semua-riwayat" class="section-link">Lihat Semua</a>
                    </div>

                    <div class="track-cards-grid">
                        <?php foreach ($recentlyPlayed as $track): ?>
                            <div class="track-card play-trigger" data-track="<?= htmlspecialchars($track['title']); ?>" data-artist="<?= htmlspecialchars($track['artist']); ?>" data-duration="<?= htmlspecialchars($track['time']); ?>" data-img="<?= htmlspecialchars($track['img']); ?>">
                                <div class="track-img-wrapper">
                                    <img src="<?= htmlspecialchars($track['img']); ?>" alt="<?= htmlspecialchars($track['title']); ?>" class="track-img">
                                    <div class="track-play-btn">
                                        <i class="bi bi-play-fill"></i>
                                    </div>
                                </div>
                                <div class="track-card-title"><?= htmlspecialchars($track['title']); ?></div>
                                <div class="track-card-artist"><?= htmlspecialchars($track['artist']); ?></div>
                                <div class="track-card-meta">
                                    <span><?= htmlspecialchars($track['time']); ?></span>
                                    <span>&bull;</span>
                                    <span><?= htmlspecialchars($track['genre']); ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>

                <!-- 4. Section: Rekomendasi Teratas Untukmu -->
                <section class="dashboard-section">
                    <div class="section-header-row">
                        <div>
                            <h2 class="section-main-title">Rekomendasi Teratas Untukmu</h2>
                            <div class="section-subtitle">Kurasi khusus berdasarkan riwayat musik dan playlist favorit Anda</div>
                        </div>
                        <div class="nav-arrows">
                            <button class="nav-arrow-btn"><i class="bi bi-chevron-left"></i></button>
                            <button class="nav-arrow-btn"><i class="bi bi-chevron-right"></i></button>
                        </div>
                    </div>

                    <div class="rec-grid">
                        <?php foreach ($topRecommendations as $rec): ?>
                            <div class="rec-card">
                                <div class="rec-badge-row">
                                    <span class="rec-badge-tag <?= $rec['badge_class']; ?>"><?= htmlspecialchars($rec['tag']); ?></span>
                                    <span class="rec-subinfo"><?= htmlspecialchars($rec['sub']); ?></span>
                                </div>

                                <div class="rec-body">
                                    <img src="<?= htmlspecialchars($rec['img']); ?>" alt="<?= htmlspecialchars($rec['name']); ?>" class="rec-avatar">
                                    <div class="rec-body-info">
                                        <h5><?= htmlspecialchars($rec['name']); ?></h5>
                                        <p><?= htmlspecialchars($rec['info']); ?></p>
                                        <div class="rec-stat">
                                            <i class="bi <?= htmlspecialchars($rec['stat_icon']); ?>"></i>
                                            <?= htmlspecialchars($rec['stat']); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="rec-footer">
                                    <button class="btn-rec-action" onclick="showToast('<?= htmlspecialchars($rec['name']); ?>: <?= htmlspecialchars($rec['action']); ?> berhasil!')">
                                        <?= htmlspecialchars($rec['action']); ?>
                                    </button>
                                    <div class="rec-play-btn play-trigger" data-track="<?= htmlspecialchars($rec['name']); ?>" data-artist="Kurasi Rekomendasi" data-duration="03:45" data-img="<?= htmlspecialchars($rec['img']); ?>" title="Putar">
                                        <i class="bi bi-play-fill fs-5"></i>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>

                <!-- 5. Section: Podcast & Obrolan Trending -->
                <section class="dashboard-section">
                    <div class="section-header-row">
                        <div>
                            <h2 class="section-main-title">Podcast & Obrolan Trending</h2>
                            <div class="section-subtitle">Wawasan teknologi, obrolan kreatif musik digital, dan cerita terkini</div>
                        </div>
                        <a href="#eksplor-podcast" class="section-link">Eksplor Podcast</a>
                    </div>

                    <div class="podcast-grid">
                        <?php foreach ($podcasts as $podcast): ?>
                            <div class="podcast-card">
                                <div class="podcast-top-meta">
                                    <span class="podcast-tag"><?= htmlspecialchars($podcast['category']); ?></span>
                                    <span class="podcast-duration"><?= htmlspecialchars($podcast['duration']); ?></span>
                                </div>

                                <div class="podcast-main">
                                    <img src="<?= htmlspecialchars($podcast['img']); ?>" alt="<?= htmlspecialchars($podcast['title']); ?>" class="podcast-img">
                                    <div>
                                        <h4 class="podcast-title"><?= htmlspecialchars($podcast['title']); ?></h4>
                                        <p class="podcast-author"><?= htmlspecialchars($podcast['speaker']); ?></p>
                                    </div>
                                </div>

                                <p class="podcast-desc">
                                    <?= htmlspecialchars($podcast['desc']); ?>
                                </p>

                                <div class="podcast-footer">
                                    <span class="podcast-date"><?= htmlspecialchars($podcast['date']); ?></span>
                                    <button class="btn-podcast-play play-trigger" data-track="<?= htmlspecialchars($podcast['title']); ?>" data-artist="<?= htmlspecialchars($podcast['speaker']); ?>" data-duration="<?= htmlspecialchars($podcast['duration']); ?>" data-img="<?= htmlspecialchars($podcast['img']); ?>">
                                        <i class="bi bi-play-fill"></i> Putar Episode
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>

                <!-- System Status Bar -->
                <div class="system-status-bar">
                    <div>
                        <span class="status-dot"></span>
                        <strong class="text-white">Server Audio: Aktif</strong>
                        <span class="text-muted ms-1">[200 OK &bull; MySQL v8.0]</span>
                    </div>
                    <div>
                        Buffer: <span class="text-white fw-bold">100% Caching</span>
                    </div>
                    <div>
                        Protokol: <span class="text-info fw-bold">HLS Stream Secure</span>
                    </div>
                    <div class="text-muted">
                        Spotifake Engine v1.0
                    </div>
                </div>

            </main>
        </div>

        <!-- ==================== FIXED BOTTOM PLAYER BAR ==================== -->
        <footer class="bottom-player-bar">
            <!-- Left: Current Track Info -->
            <div class="player-left">
                <img src="https://images.unsplash.com/photo-1509198397868-475647b2a1e5?q=80&w=400&auto=format&fit=crop" alt="Track Cover" class="player-cover" id="currentCover">
                <div class="player-track-info">
                    <div class="player-title" id="currentTitle">Midnight Echoes</div>
                    <div class="player-artist" id="currentArtist">Arctic Mirage</div>
                </div>
                <button class="btn-player-like" id="btnLike" title="Sukai Lagu">
                    <i class="bi bi-heart"></i>
                </button>
            </div>

            <!-- Center: Player Controls & Seekbar -->
            <div class="player-center">
                <div class="player-controls">
                    <button class="control-btn" id="btnShuffle" title="Acak"><i class="bi bi-shuffle"></i></button>
                    <button class="control-btn" id="btnPrev" title="Sebelumnya"><i class="bi bi-skip-start-fill"></i></button>
                    <button class="control-btn btn-main-play" id="btnMainPlay" title="Putar / Jeda"><i class="bi bi-play-fill" id="playIcon"></i></button>
                    <button class="control-btn" id="btnNext" title="Selanjutnya"><i class="bi bi-skip-end-fill"></i></button>
                    <button class="control-btn" id="btnRepeat" title="Ulangi"><i class="bi bi-repeat"></i></button>
                </div>

                <div class="player-seekbar">
                    <span class="seek-time" id="currentTimeText">01:45</span>
                    <div class="seek-bar-track" id="seekBar">
                        <div class="seek-progress" id="seekProgress">
                            <div class="seek-thumb"></div>
                        </div>
                    </div>
                    <span class="seek-time" id="durationTimeText">03:52</span>
                </div>
            </div>

            <!-- Right: Secondary Controls & Volume -->
            <div class="player-right">
                <button class="control-btn" id="btnQueue" title="Antrean Putar"><i class="bi bi-view-list"></i></button>
                <button class="control-btn" id="btnDevice" title="Hubungkan Perangkat"><i class="bi bi-speaker"></i></button>
                <div class="volume-wrapper">
                    <button class="control-btn" id="btnVolume"><i class="bi bi-volume-up" id="volumeIcon"></i></button>
                    <div class="volume-bar-track" id="volumeBar">
                        <div class="volume-progress" id="volumeProgress"></div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Toast Notification Widget -->
        <div class="spotifake-toast" id="toastNotification">
            <i class="bi bi-info-circle-fill text-info"></i>
            <span id="toastMessage">Pemberitahuan</span>
        </div>

    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom User JS -->
    <script src="../assets/js/pengguna/script.js"></script>
</body>

</html>
