<?php
session_start();
require_once '../config/database.php';

$pageTitle = "Koleksi Saya - Spotifake";
$userName = isset($_SESSION['username']) ? $_SESSION['username'] : "Alya Aurelia";

// Data Playlist Koleksi (Mockup sesuai SDD UI-005B)
$myPlaylists = [
    [
        "name" => "Chill Vibes 2026",
        "desc" => "Santai dengan beat lo-fi dan ambient malam",
        "songs" => 24,
        "cover" => "https://images.unsplash.com/photo-1518709268805-4e9042af9f23?q=80&w=400&auto=format&fit=crop",
        "slug" => "chill-vibes"
    ],
    [
        "name" => "Weekly Top 50",
        "desc" => "Lagu terpopuler minggu ini di Indonesia",
        "songs" => 50,
        "cover" => "https://images.unsplash.com/photo-1470225620780-dba8ba36b745?q=80&w=400&auto=format&fit=crop",
        "slug" => "weekly-top-50"
    ],
    [
        "name" => "Coding Session",
        "desc" => "Fokus ngoding tanpa distraksi",
        "songs" => 32,
        "cover" => "https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=400&auto=format&fit=crop",
        "slug" => "coding-session"
    ],
    [
        "name" => "Night Drive Synth",
        "desc" => "Synthwave untuk perjalanan malam",
        "songs" => 18,
        "cover" => "https://images.unsplash.com/photo-1517411032315-54ef2cb783bb?q=80&w=400&auto=format&fit=crop",
        "slug" => "night-drive"
    ],
    [
        "name" => "Akustik Senja",
        "desc" => "Petikan gitar dan melodi hangat",
        "songs" => 15,
        "cover" => "https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?q=80&w=400&auto=format&fit=crop",
        "slug" => "akustik-senja"
    ],
    [
        "name" => "Deep Focus Alpha",
        "desc" => "Gelombang alpha untuk konsentrasi maksimal",
        "songs" => 40,
        "cover" => "https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=400&auto=format&fit=crop",
        "slug" => "deep-focus"
    ]
];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Base & Modular CSS -->
    <link rel="stylesheet" href="../assets/css/pengguna/dashboard-pengguna.css">
    <link rel="stylesheet" href="../assets/css/pengguna/koleksi.css">
</head>

<body>

    <div class="app-container">

        <!-- ==================== SIDEBAR ==================== -->
        <aside class="sidebar">
            <a href="dashboard-pengguna.php" class="brand-wrapper">
                <div class="brand-icon"><i class="bi bi-soundwave"></i></div>
                <span class="brand-name">Spotifake</span>
            </a>

            <ul class="sidebar-nav">
                <li><a href="dashboard-pengguna.php" class="nav-link-custom"><i class="bi bi-house-door-fill"></i><span>Beranda</span></a></li>
                <li><a href="pencarian.php" class="nav-link-custom"><i class="bi bi-search"></i><span>Cari</span></a></li>
                <li><a href="koleksi.php" class="nav-link-custom active"><i class="bi bi-collection-play"></i><span>Koleksi Saya</span></a></li>
                <li><a href="lagu-disukai.php" class="nav-link-custom"><i class="bi bi-heart-fill text-danger"></i><span>Lagu Disukai</span></a></li>
                <li><a href="#" class="nav-link-custom" id="navCreatePlaylist"><i class="bi bi-plus-square"></i><span>Buat Playlist</span></a></li>
            </ul>

            <div class="sidebar-heading">PLAYLISTS</div>
            <ul class="playlist-list">
                <li><a href="detail-playlist.php?playlist=chill-vibes" class="playlist-link">Chill Vibes 2026</a></li>
                <li><a href="detail-playlist.php?playlist=weekly-top-50" class="playlist-link">Weekly Top 50</a></li>
                <li><a href="detail-playlist.php?playlist=coding-session" class="playlist-link">Coding Session</a></li>
                <li><a href="detail-playlist.php?playlist=night-drive" class="playlist-link">Night Drive Synth</a></li>
            </ul>
        </aside>

        <!-- ==================== MAIN CONTENT ==================== -->
        <div class="main-wrapper">

            <header class="topbar">
                <div class="topbar-left">
                    <div class="nav-arrows">
                        <button class="nav-arrow-btn" onclick="history.back()" title="Kembali"><i class="bi bi-chevron-left"></i></button>
                        <button class="nav-arrow-btn" onclick="history.forward()" title="Maju"><i class="bi bi-chevron-right"></i></button>
                    </div>
                    <div class="topbar-search">
                        <i class="bi bi-search search-icon"></i>
                        <input type="text" id="searchInput" placeholder="Cari playlist di koleksi...">
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
                            <li><a class="dropdown-item text-white active" href="koleksi.php"><i class="bi bi-collection-play me-2"></i>Koleksi Saya</a></li>
                            <li><a class="dropdown-item text-white" href="lagu-disukai.php"><i class="bi bi-heart me-2"></i>Lagu yang Disukai</a></li>
                            <li><hr class="dropdown-divider border-secondary"></li>
                            <li><a class="dropdown-item text-danger fw-bold" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i>Keluar</a></li>
                        </ul>
                    </div>
                </div>
            </header>

            <main class="content-body">

                <!-- Header Section -->
                <section class="dashboard-section">
                    <div class="section-header-row">
                        <div>
                            <span class="section-pretitle">PERPUSTAKAAN MUSIK DIGITAL</span>
                            <h2 class="section-main-title">Koleksi Saya</h2>
                            <div class="section-subtitle">Semua playlist yang kamu buat dan simpan ada di sini</div>
                        </div>
                        <button class="btn-hero-play" id="btnBuatPlaylistBaru" style="font-size: 0.85rem; padding: 0.6rem 1.25rem;">
                            <i class="bi bi-plus-lg"></i> Buat Playlist Baru
                        </button>
                    </div>
                </section>

                <!-- Genre Chips Filter -->
                <div class="genre-chips-wrapper">
                    <a href="javascript:void(0)" class="chip-btn active" onclick="filterGenre(this, 'Semua')">Semua</a>
                    <a href="javascript:void(0)" class="chip-btn" onclick="filterGenre(this, 'Playlist Saya')">Playlist Saya</a>
                    <a href="javascript:void(0)" class="chip-btn" onclick="filterGenre(this, 'Artis Diikuti')">Artis Diikuti</a>
                    <a href="javascript:void(0)" class="chip-btn" onclick="filterGenre(this, 'Album Tersimpan')">Album Tersimpan</a>
                </div>

                <!-- Quick Links -->
                <div class="quick-grid mb-4">
                    <a href="lagu-disukai.php" class="quick-card" style="text-decoration: none;">
                        <div class="quick-card-icon" style="background: linear-gradient(135deg, #4f46e5, #9333ea);">
                            <i class="bi bi-heart-fill"></i>
                        </div>
                        <div class="quick-card-info">
                            <div class="quick-card-title">Lagu yang Disukai</div>
                            <div class="quick-card-desc">128 Lagu Tersimpan</div>
                        </div>
                    </a>
                </div>

                <!-- Playlist Grid -->
                <section class="dashboard-section">
                    <div class="section-header-row">
                        <h3 class="section-main-title" style="font-size: 1.3rem;">Playlist Buatanmu</h3>
                        <span class="text-muted small"><?= count($myPlaylists); ?> playlist</span>
                    </div>

                    <div class="collection-grid">
                        <?php foreach ($myPlaylists as $pl): ?>
                            <a href="detail-playlist.php?playlist=<?= urlencode($pl['slug']); ?>" class="collection-card">
                                <div class="collection-img-wrapper">
                                    <img src="<?= htmlspecialchars($pl['cover']); ?>" alt="<?= htmlspecialchars($pl['name']); ?>" class="collection-img">
                                    <div class="track-play-btn">
                                        <i class="bi bi-play-fill"></i>
                                    </div>
                                </div>
                                <div class="collection-title"><?= htmlspecialchars($pl['name']); ?></div>
                                <div class="collection-desc"><?= htmlspecialchars($pl['desc']); ?> &bull; <?= $pl['songs']; ?> lagu</div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </section>

            </main>
        </div>

        <!-- ==================== FIXED BOTTOM PLAYER ==================== -->
        <footer class="bottom-player-bar">
            <div class="player-left">
                <img src="https://images.unsplash.com/photo-1509198397868-475647b2a1e5?q=80&w=400&auto=format&fit=crop" alt="Track Cover" class="player-cover" id="currentCover">
                <div class="player-track-info">
                    <div class="player-title" id="currentTitle">Midnight Echoes</div>
                    <div class="player-artist" id="currentArtist">Arctic Mirage</div>
                </div>
                <button class="btn-player-like" id="btnLike" title="Sukai Lagu"><i class="bi bi-heart"></i></button>
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
                    <span class="seek-time" id="currentTimeText">01:45</span>
                    <div class="seek-bar-track" id="seekBar">
                        <div class="seek-progress" id="seekProgress"><div class="seek-thumb"></div></div>
                    </div>
                    <span class="seek-time" id="durationTimeText">03:52</span>
                </div>
            </div>
            <div class="player-right">
                <button class="control-btn" id="btnQueue" title="Antrean Putar"><i class="bi bi-view-list"></i></button>
                <div class="volume-wrapper">
                    <button class="control-btn" id="btnVolume"><i class="bi bi-volume-up" id="volumeIcon"></i></button>
                    <div class="volume-bar-track" id="volumeBar">
                        <div class="volume-progress" id="volumeProgress"></div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Toast Notification -->
        <div class="spotifake-toast" id="toastNotification">
            <i class="bi bi-info-circle-fill text-info"></i>
            <span id="toastMessage">Pemberitahuan</span>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Modular JS -->
    <script src="../assets/js/pengguna/player.js"></script>
    <script src="../assets/js/pengguna/playlist.js"></script>

    <script>
        function filterGenre(btn, name) {
            if (btn) {
                document.querySelectorAll('.chip-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
            }
            showToast('Menampilkan: ' + name);
        }

        const btnBuat = document.getElementById('btnBuatPlaylistBaru');
        if (btnBuat) {
            btnBuat.addEventListener('click', function() {
                const playlistName = prompt('Beri nama playlist baru Anda:', 'Playlist Baru #1');
                if (playlistName) {
                    showToast('Playlist "' + playlistName + '" berhasil dibuat! 🎵');
                }
            });
        }
    </script>
</body>

</html>
