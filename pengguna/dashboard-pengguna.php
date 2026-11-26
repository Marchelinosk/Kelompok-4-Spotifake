<?php
session_start();
require_once '../config/database.php';

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$idUser   = (int) $_SESSION['user_id'];
$userName = $_SESSION['username'] ?? "Pengguna Spotifake";

// Logika sapaan waktu otomatis
date_default_timezone_set('Asia/Jakarta');
$jam = date('H');
if ($jam >= 5 && $jam < 11) {
    $sapaan = "Selamat Pagi";
} elseif ($jam >= 11 && $jam < 15) {
    $sapaan = "Selamat Siang";
} elseif ($jam >= 15 && $jam < 18) {
    $sapaan = "Selamat Sore";
} else {
    $sapaan = "Selamat Malam";
}

$pageTitle = "Spotifake - Web Audio Player";

// Cover default bernuansa synthwave (karena tabel songs SDD tidak menyimpan kolom cover)[cite: 1]
$defaultCovers = [
    "https://images.unsplash.com/photo-1509198397868-475647b2a1e5?q=80&w=400&auto=format&fit=crop",
    "https://images.unsplash.com/photo-1459749411175-04bf5292ceea?q=80&w=400&auto=format&fit=crop",
    "https://images.unsplash.com/photo-1501386761578-eac5c94b800a?q=80&w=400&auto=format&fit=crop",
    "https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?q=80&w=400&auto=format&fit=crop",
    "https://images.unsplash.com/photo-1518609878373-06d740f60d8b?q=80&w=400&auto=format&fit=crop",
    "https://images.unsplash.com/photo-1518709268805-4e9042af9f23?q=80&w=400&auto=format&fit=crop",
    "https://images.unsplash.com/photo-1470225620780-dba8ba36b745?q=80&w=400&auto=format&fit=crop",
    "https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=400&auto=format&fit=crop",
    "https://images.unsplash.com/photo-1508700115892-45ecd05ae2ad?q=80&w=400&auto=format&fit=crop",
    "https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=400&auto=format&fit=crop"
];

// 1. Ambil SELURUH 41 lagu dari tabel songs[cite: 1]
$stmtAllSongs = $pdo->query("SELECT * FROM songs ORDER BY title ASC");
$dbAllSongs = $stmtAllSongs->fetchAll(PDO::FETCH_ASSOC);
$totalSongsCount = count($dbAllSongs);

// 2. Ambil 6 lagu pilihan untuk Rangkuman Aktivitas
$stmtQuick = $pdo->query("SELECT * FROM songs ORDER BY id_song ASC LIMIT 6");
$dbQuickPicks = $stmtQuick->fetchAll(PDO::FETCH_ASSOC);

// 3. Ambil Lagu Disukai oleh user yang sedang login (Tabel likes)
$stmtLiked = $pdo->prepare("
    SELECT s.*, l.liked_at 
    FROM songs s 
    INNER JOIN likes l ON s.id_song = l.id_song 
    WHERE l.id_user = ? 
    ORDER BY l.liked_at DESC
");
$stmtLiked->execute([$idUser]);
$dbLikedSongs = $stmtLiked->fetchAll(PDO::FETCH_ASSOC);
$likedSongIds = array_column($dbLikedSongs, 'id_song');

// 4. Ambil Daftar Koleksi / Playlist milik user (Tabel playlists)
$stmtPlaylists = $pdo->prepare("SELECT * FROM playlists WHERE id_user = ? ORDER BY id_playlist DESC");
$stmtPlaylists->execute([$idUser]);
$userPlaylists = $stmtPlaylists->fetchAll(PDO::FETCH_ASSOC);

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
    <link rel="stylesheet" href="../assets/css/pengguna/dashboard-pengguna.css">

    <style>
        /* Tombol aksi kecil di kartu lagu untuk Simpan ke Koleksi */
        .track-card { position: relative; }
        .btn-add-playlist-card {
            position: absolute;
            top: 14px;
            right: 14px;
            z-index: 5;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,0.2);
            background: rgba(15, 23, 42, 0.8);
            color: #38bdf8;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }
        .btn-add-playlist-card:hover {
            background: #0ea5e9;
            color: #fff;
            transform: scale(1.1);
        }
        .playlist-link.active-playlist {
            color: #38bdf8 !important;
            font-weight: 700;
        }
    </style>
</head>

<body>

    <div class="app-container">

        <!-- ==================== SIDEBAR (KIRI) ==================== -->
        <aside class="sidebar">
            <a href="dashboard-pengguna.php" class="brand-wrapper">
                <div class="brand-icon">
                    <i class="bi bi-soundwave"></i>
                </div>
                <span class="brand-name">Spotifake</span>
            </a>

            <!-- Menu Utama -->
            <ul class="sidebar-nav">
                <li>
                    <a href="dashboard-pengguna.php" class="nav-link-custom active">
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
                    <a href="#koleksi-disukai" class="nav-link-custom">
                        <i class="bi bi-heart-fill text-danger"></i>
                        <span>Lagu Disukai (<?= count($dbLikedSongs); ?>)</span>
                    </a>
                </li>
                <li>
                    <a href="koleksi.php?action=create" class="nav-link-custom" id="navCreatePlaylist">
                        <i class="bi bi-plus-square"></i>
                        <span>Buat Playlist</span>
                    </a>
                </li>
            </ul>

            <!-- Playlist / Koleksi Pengguna dari Database -->
            <div class="sidebar-heading d-flex justify-content-between align-items-center pe-3">
                <span>KOLEKSI SAYA</span>
                <button class="btn btn-sm text-info p-0 border-0" data-bs-toggle="modal" data-bs-target="#modalCreatePlaylist" title="Tambah Koleksi Baru">
                    <i class="bi bi-plus-lg"></i>
                </button>
            </div>
            <ul class="playlist-list" id="sidebarPlaylistList">
                <?php if (!empty($userPlaylists)): ?>
                    <?php foreach ($userPlaylists as $pl): ?>
                        <li>
                            <a href="#detail-koleksi" class="playlist-link view-playlist-btn" 
                               data-id="<?= $pl['id_playlist']; ?>" 
                               data-name="<?= htmlspecialchars($pl['playlist_name']); ?>"
                               data-desc="<?= htmlspecialchars($pl['description'] ?? ''); ?>">
                                <i class="bi bi-music-note-list me-2 text-info"></i><?= htmlspecialchars($pl['playlist_name']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li class="text-muted small px-2" id="emptyPlaylistHint">Belum ada koleksi</li>
                <?php endif; ?>
            </ul>
        </aside>

        <!-- ==================== MAIN CONTENT WRAPPER ==================== -->
        <div class="main-wrapper">

            <!-- Topbar -->
            <header class="topbar">
                <div class="topbar-left">
                    <div class="nav-arrows">
                        <button class="nav-arrow-btn" onclick="history.back()" title="Kembali"><i class="bi bi-chevron-left"></i></button>
                        <button class="nav-arrow-btn" onclick="history.forward()" title="Maju"><i class="bi bi-chevron-right"></i></button>
                    </div>

                    <div class="topbar-search">
                        <i class="bi bi-search search-icon"></i>
                        <input type="text" id="searchInput" placeholder="Cari dari <?= $totalSongsCount; ?> lagu, artis, atau genre...">
                        <span class="shortcut-badge">⌘K</span>
                    </div>
                </div>

                <div class="topbar-right">
                    <div class="user-profile dropdown">
                        <div data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer; display: flex; align-items: center; gap: 0.5rem;">
                            <img src="https://ui-avatars.com/api/?name=<?= urlencode($userName); ?>&background=0D8ABC&color=fff" alt="User Profile" class="user-avatar" style="border-radius: 50%;">
                            <span class="user-name"><?= htmlspecialchars($userName); ?> <i class="bi bi-caret-down-fill" style="font-size: 0.8em; margin-left:3px;"></i></span>
                        </div>
                        <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end shadow" style="background-color: #1a1a1a; border: 1px solid #333;">
                            <li><a class="dropdown-item text-white" href="profil.php"><i class="bi bi-person me-2"></i>Profil Saya</a></li>
                            <li><a class="dropdown-item text-white" href="pengaturan.php"><i class="bi bi-gear me-2"></i>Pengaturan</a></li>
                            <li>
                                <hr class="dropdown-divider border-secondary">
                            </li>
                            <li><a class="dropdown-item text-danger fw-bold" href="../logout.php"><i class="bi bi-box-arrow-right me-2"></i>Keluar</a></li>
                        </ul>
                    </div>
                </div>
            </header>

            <!-- Scrollable Content Body -->
            <main class="content-body">

                <!-- 1. Hero Banner -->
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
                            <?php $heroSong = $dbQuickPicks[0] ?? null; ?>
                            <button class="btn-hero-play play-trigger" 
                                    data-id="<?= $heroSong['id_song'] ?? 0; ?>"
                                    data-track="<?= htmlspecialchars($heroSong['title'] ?? 'Frostwave Vol. 1'); ?>" 
                                    data-artist="<?= htmlspecialchars($heroSong['artist'] ?? 'Arctic Mirage'); ?>" 
                                    data-duration="<?= isset($heroSong['duration']) ? gmdate('i:s', (int)$heroSong['duration']) : '00:30'; ?>" 
                                    data-img="https://images.unsplash.com/photo-1517411032315-54ef2cb783bb?q=80&w=300&auto=format&fit=crop"
                                    data-audio="<?= htmlspecialchars($heroSong['file_path'] ?? ''); ?>">
                                <i class="bi bi-play-fill fs-5"></i> Dengarkan Sekarang
                            </button>
                            <button class="btn-hero-fav" data-bs-toggle="modal" data-bs-target="#modalCreatePlaylist">
                                <i class="bi bi-folder-plus"></i> Buat Koleksi Baru
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
                        <span><?= $totalSongsCount; ?> Lagu Tersedia</span>
                    </div>
                </section>

                <!-- SECTION DINAMIS: Isi Koleksi / Playlist Terpilih (Muncul saat playlist di sidebar diklik) -->
                <section class="dashboard-section d-none" id="detail-koleksi">
                    <div class="section-header-row">
                        <div>
                            <span class="section-pretitle text-info">KOLEKSI PILIHANMU</span>
                            <h2 class="section-main-title" id="activePlaylistTitle">Nama Koleksi</h2>
                            <div class="section-subtitle" id="activePlaylistDesc">Daftar lagu yang tersimpan di koleksi ini</div>
                        </div>
                        <button class="btn btn-sm btn-outline-light" id="btnClosePlaylistView">
                            <i class="bi bi-x-lg me-1"></i> Tutup Tampilan Koleksi
                        </button>
                    </div>
                    <div class="track-cards-grid" id="activePlaylistGrid"></div>
                </section>

                <!-- 2. Section: Rangkuman Aktivitas / Sering Diputar (2x3 Grid) -->
                <section class="dashboard-section">
                    <div class="section-header-row">
                        <div>
                            <span class="section-pretitle">SERING DIPUTAR & PILIHAN CEPAT</span>
                            <h2 class="section-main-title"><?= $sapaan; ?>, <?= htmlspecialchars($userName); ?></h2>
                        </div>
                        <div class="sync-status">
                            Sinkronisasi Audio: <span class="text-info fw-bold">Aktif (<?= $totalSongsCount; ?> Lagu)</span>
                        </div>
                    </div>

                    <div class="quick-grid">
                        <?php foreach ($dbQuickPicks as $index => $pick): 
                            $formattedDuration = gmdate("i:s", (int)$pick['duration']);
                            $coverImg = $defaultCovers[$index % count($defaultCovers)];
                        ?>
                            <div class="quick-card play-trigger" 
                                 data-id="<?= $pick['id_song']; ?>"
                                 data-track="<?= htmlspecialchars($pick['title']); ?>" 
                                 data-artist="<?= htmlspecialchars($pick['artist']); ?>" 
                                 data-duration="<?= $formattedDuration; ?>" 
                                 data-img="<?= $coverImg; ?>"
                                 data-audio="<?= htmlspecialchars($pick['file_path']); ?>">
                                <img src="<?= $coverImg; ?>" alt="<?= htmlspecialchars($pick['title']); ?>" class="quick-card-img">

                                <div class="quick-card-info">
                                    <div class="quick-card-title"><?= htmlspecialchars($pick['title']); ?></div>
                                    <div class="quick-card-desc"><?= htmlspecialchars($pick['artist']); ?> &bull; <?= htmlspecialchars($pick['genre'] ?? 'Music'); ?></div>
                                </div>

                                <div class="quick-card-play">
                                    <i class="bi bi-play-fill fs-5"></i>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>

                <!-- 3. Section: Koleksi Lagu Disukai (Dari Tabel likes)[cite: 4] -->
                <section class="dashboard-section" id="koleksi-disukai">
                    <div class="section-header-row">
                        <div>
                            <span class="section-pretitle text-danger">FAVORIT PRIBADI</span>
                            <h2 class="section-main-title">Lagu Disukai (<span id="likedCountBadge"><?= count($dbLikedSongs); ?></span>)</h2>
                            <div class="section-subtitle">Klik ikon hati di pemutar bawah untuk menambah atau menghapus lagu favorit</div>
                        </div>
                    </div>

                    <div class="track-cards-grid" id="likedSongsGrid">
                        <?php if (!empty($dbLikedSongs)): ?>
                            <?php foreach ($dbLikedSongs as $index => $liked): 
                                $formattedDuration = gmdate("i:s", (int)$liked['duration']);
                                $coverImg = $defaultCovers[$index % count($defaultCovers)];
                            ?>
                                <div class="track-card play-trigger" 
                                     data-id="<?= $liked['id_song']; ?>"
                                     data-track="<?= htmlspecialchars($liked['title']); ?>" 
                                     data-artist="<?= htmlspecialchars($liked['artist']); ?>" 
                                     data-duration="<?= $formattedDuration; ?>" 
                                     data-img="<?= $coverImg; ?>"
                                     data-audio="<?= htmlspecialchars($liked['file_path']); ?>">
                                    <button type="button" class="btn-add-playlist-card open-add-playlist" 
                                            data-song-id="<?= $liked['id_song']; ?>" 
                                            data-song-title="<?= htmlspecialchars($liked['title']); ?>"
                                            title="Simpan ke Koleksi">
                                        <i class="bi bi-plus-lg"></i>
                                    </button>
                                    <div class="track-img-wrapper">
                                        <img src="<?= $coverImg; ?>" alt="<?= htmlspecialchars($liked['title']); ?>" class="track-img">
                                        <div class="track-play-btn">
                                            <i class="bi bi-play-fill"></i>
                                        </div>
                                    </div>
                                    <div class="track-card-title"><?= htmlspecialchars($liked['title']); ?></div>
                                    <div class="track-card-artist"><?= htmlspecialchars($liked['artist']); ?></div>
                                    <div class="track-card-meta">
                                        <span class="text-danger"><i class="bi bi-heart-fill"></i> Disukai</span>
                                        <span>&bull;</span>
                                        <span><?= htmlspecialchars($liked['genre'] ?? 'Music'); ?></span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-secondary small" id="emptyLikedMsg">
                                Belum ada lagu yang disukai. Putar lagu apa saja lalu klik ikon <i class="bi bi-heart text-danger"></i> di pemutar bawah.
                            </div>
                        <?php endif; ?>
                    </div>
                </section>

                <!-- 4. Section: Semua Katalog Lagu (Seluruh 41 Lagu dari Database)[cite: 1] -->
                <section class="dashboard-section" id="semua-katalog">
                    <div class="section-header-row">
                        <div>
                            <span class="section-pretitle">KATALOG LENGKAP DATABASE</span>
                            <h2 class="section-main-title">Semua Lagu (<?= $totalSongsCount; ?> Trek)</h2>
                            <div class="section-subtitle">Klik kartu untuk memutar audio, atau tekan tombol <strong>+</strong> di pojok kartu untuk memasukkan ke koleksi</div>
                        </div>
                    </div>

                    <div class="track-cards-grid">
                        <?php foreach ($dbAllSongs as $index => $song): 
                            $formattedDuration = gmdate("i:s", (int)$song['duration']);
                            $coverImg = $defaultCovers[$index % count($defaultCovers)];
                        ?>
                            <div class="track-card play-trigger" 
                                 data-id="<?= $song['id_song']; ?>"
                                 data-track="<?= htmlspecialchars($song['title']); ?>" 
                                 data-artist="<?= htmlspecialchars($song['artist']); ?>" 
                                 data-duration="<?= $formattedDuration; ?>" 
                                 data-img="<?= $coverImg; ?>"
                                 data-audio="<?= htmlspecialchars($song['file_path']); ?>">
                                
                                <!-- Tombol Tambah ke Koleksi -->
                                <button type="button" class="btn-add-playlist-card open-add-playlist" 
                                        data-song-id="<?= $song['id_song']; ?>" 
                                        data-song-title="<?= htmlspecialchars($song['title']); ?>"
                                        title="Tambahkan ke Koleksi">
                                    <i class="bi bi-plus-lg"></i>
                                </button>

                                <div class="track-img-wrapper">
                                    <img src="<?= $coverImg; ?>" alt="<?= htmlspecialchars($song['title']); ?>" class="track-img">
                                    <div class="track-play-btn">
                                        <i class="bi bi-play-fill"></i>
                                    </div>
                                </div>
                                <div class="track-card-title"><?= htmlspecialchars($song['title']); ?></div>
                                <div class="track-card-artist"><?= htmlspecialchars($song['artist']); ?></div>
                                <div class="track-card-meta">
                                    <span><?= $formattedDuration; ?></span>
                                    <span>&bull;</span>
                                    <span><?= htmlspecialchars($song['genre'] ?? 'Music'); ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>

                <!-- 5. Section: Rekomendasi Teratas Untukmu -->
                <section class="dashboard-section">
                    <div class="section-header-row">
                        <div>
                            <h2 class="section-main-title">Rekomendasi Teratas Untukmu</h2>
                            <div class="section-subtitle">Kurasi khusus berdasarkan riwayat musik dan playlist favorit Anda</div>
                        </div>
                    </div>

                    <div class="rec-grid">
                        <?php foreach ($topRecommendations as $index => $rec): 
                            $sampleSong = $dbAllSongs[($index * 5) % max(1, $totalSongsCount)] ?? [];
                        ?>
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
                                    <div class="rec-play-btn play-trigger" 
                                         data-id="<?= $sampleSong['id_song'] ?? 0; ?>"
                                         data-track="<?= htmlspecialchars($rec['name']); ?>" 
                                         data-artist="Kurasi Rekomendasi" 
                                         data-duration="00:30" 
                                         data-img="<?= htmlspecialchars($rec['img']); ?>" 
                                         data-audio="<?= htmlspecialchars($sampleSong['file_path'] ?? ''); ?>"
                                         title="Putar">
                                        <i class="bi bi-play-fill fs-5"></i>
                                    </div>
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
                        <span class="text-muted ms-1">[200 OK &bull; <?= $totalSongsCount; ?> Lagu Terindeks]</span>
                    </div>
                    <div>
                        Koleksi: <span class="text-white fw-bold"><?= count($userPlaylists); ?> Playlist</span>
                    </div>
                    <div>
                        Disukai: <span class="text-info fw-bold"><?= count($dbLikedSongs); ?> Lagu</span>
                    </div>
                    <div class="text-muted">
                        Spotifake Engine v1.0
                    </div>
                </div>

            </main>
        </div>

        <!-- ==================== FIXED BOTTOM PLAYER BAR ==================== -->
        <footer class="bottom-player-bar">
            <div class="player-left">
                <img src="https://images.unsplash.com/photo-1509198397868-475647b2a1e5?q=80&w=400&auto=format&fit=crop" alt="Track Cover" class="player-cover" id="currentCover">
                <div class="player-track-info">
                    <div class="player-title" id="currentTitle">Pilih lagu untuk diputar</div>
                    <div class="player-artist" id="currentArtist">Spotifake Audio Engine</div>
                </div>
                <button class="btn-player-like" id="btnLike" data-song-id="0" title="Sukai Lagu">
                    <i class="bi bi-heart"></i>
                </button>
            </div>

            <div class="player-center">
                <div class="player-controls">
                    <button class="control-btn" id="btnShuffle" title="Acak"><i class="bi bi-shuffle"></i></button>
                    <button class="control-btn" id="btnPrev" title="Sebelumnya"><i class="bi bi-skip-start-fill"></i></button>
                    <button class="control-btn btn-main-play" id="btnMainPlay" title="Putar / Jeda"><i class="bi bi-play-fill" id="playIcon"></i></button>
                    <button class="control-btn" id="btnNext" title="Selanjutnya"><i class="bi bi-skip-end-fill"></i></button>
                    <button class="control-btn" id="btnRepeat" title="Ulangi"><i class="bi bi-repeat"></i></button>
                </div>

                <div class="player-seekbar">
                    <span class="seek-time" id="currentTimeText">00:00</span>
                    <div class="seek-bar-track" id="seekBar">
                        <div class="seek-progress" id="seekProgress" style="width: 0%;">
                            <div class="seek-thumb"></div>
                        </div>
                    </div>
                    <span class="seek-time" id="durationTimeText">00:30</span>
                </div>
            </div>

            <div class="player-right">
                <button class="control-btn" id="btnAddCurrentToPlaylist" title="Simpan Lagu Ini ke Koleksi"><i class="bi bi-folder-plus"></i></button>
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

    <!-- ==================== MODAL 1: BUAT KOLEKSI BARU ==================== -->
    <div class="modal fade" id="modalCreatePlaylist" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-white" style="background: #131c2e; border: 1px solid rgba(56, 189, 248, 0.3);">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title"><i class="bi bi-music-note-list text-info me-2"></i>Buat Koleksi Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form id="formCreatePlaylist">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold text-white">Nama Koleksi</label>
                            <input type="text" name="playlist_name" class="form-control bg-dark text-white fw-bold border-secondary" placeholder="Contoh: Fokus Ngoding Malam" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label fw-bold text-white">Deskripsi (Opsional)</label>
                            <textarea name="description" class="form-control bg-dark text-white fw-bold border-secondary" rows="2" placeholder="Catatan singkat tentang koleksi ini..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-info text-dark fw-bold">Simpan Koleksi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ==================== MODAL 2: TAMBAH LAGU KE KOLEKSI ==================== -->
    <div class="modal fade" id="modalAddToPlaylist" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-white" style="background: #131c2e; border: 1px solid rgba(56, 189, 248, 0.3);">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title"><i class="bi bi-folder-plus text-info me-2"></i>Simpan ke Koleksi</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="small text-secondary mb-3">Pilih koleksi tujuan untuk lagu: <strong class="text-info" id="selectedSongForPlaylist">-</strong></p>
                    <input type="hidden" id="targetSongIdInput" value="0">
                    
                    <div id="playlistSelectionList" class="d-grid gap-2">
                        <?php if (!empty($userPlaylists)): ?>
                            <?php foreach ($userPlaylists as $pl): ?>
                                <button type="button" class="btn btn-outline-info text-start d-flex justify-content-between align-items-center confirm-add-to-playlist" data-playlist-id="<?= $pl['id_playlist']; ?>">
                                    <span><i class="bi bi-music-note-beamed me-2"></i><?= htmlspecialchars($pl['playlist_name']); ?></span>
                                    <span class="badge bg-info text-dark">+ Tambah</span>
                                </button>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="alert alert-dark border-secondary text-center mb-0">
                                Kamu belum memiliki koleksi. Buat koleksi baru terlebih dahulu!
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-sm btn-info text-dark fw-bold" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalCreatePlaylist">
                        <i class="bi bi-plus-lg me-1"></i> Buat Koleksi Baru
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Simpan daftar ID lagu yang sudah disukai untuk sinkronisasi ikon hati -->
    <script>
        window.LIKED_SONG_IDS = <?= json_encode(array_map('intval', $likedSongIds)); ?>;
    </script>

    <!-- Elemen Audio HTML5 Utama -->
    <audio id="audioPlayer" preload="metadata"></audio>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom User JS (Anti-Cache) -->
    <script src="../assets/js/pengguna/script.js?v=<?= time(); ?>"></script>
</body>

</html>