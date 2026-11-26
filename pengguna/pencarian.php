<?php
session_start();
require_once '../config/database.php';

$pageTitle = "Cari Musik & Podcast - Spotifake";
$userName = isset($_SESSION['username']) ? $_SESSION['username'] : "Alya Aurelia";

// Data Kategori Chips
$genres = ["Semua", "Pop Indonesia", "Electronic / Synthwave", "Akustik", "Hip-Hop", "Podcast", "Lo-Fi Chill"];

// Data Kategori Grid (Jelajahi Semua)
$exploreCategories = [
    ["title" => "Pop Indonesia", "gradient" => "linear-gradient(135deg, #ec4899, #8b5cf6)", "icon" => "bi-music-note-beamed"],
    ["title" => "Viral 50", "gradient" => "linear-gradient(135deg, #3b82f6, #06b6d4)", "icon" => "bi-graph-up-arrow"],
    ["title" => "Fokus Belajar", "gradient" => "linear-gradient(135deg, #10b981, #059669)", "icon" => "bi-mortarboard-fill"],
    ["title" => "Musik Tidur", "gradient" => "linear-gradient(135deg, #6366f1, #4338ca)", "icon" => "bi-moon-stars-fill"],
    ["title" => "Rock Nostalgia", "gradient" => "linear-gradient(135deg, #f97316, #dc2626)", "icon" => "bi-lightning-charge-fill"],
    ["title" => "Podcast Edukasi", "gradient" => "linear-gradient(135deg, #8b5cf6, #d946ef)", "icon" => "bi-mic-fill"]
];

// Data Lagu Terkait
$relatedSongs = [
    [
        "title" => "Midnight Echoes",
        "artist" => "Arctic Mirage",
        "duration" => "03:52",
        "cover" => "https://images.unsplash.com/photo-1509198397868-475647b2a1e5?q=80&w=300&auto=format&fit=crop"
    ],
    [
        "title" => "Frost Horizon",
        "artist" => "Glacier Soundscape",
        "duration" => "04:15",
        "cover" => "https://images.unsplash.com/photo-1517411032315-54ef2cb783bb?q=80&w=300&auto=format&fit=crop"
    ],
    [
        "title" => "Neon Tundra",
        "artist" => "Subzero Lab",
        "duration" => "03:38",
        "cover" => "https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=300&auto=format&fit=crop"
    ],
    [
        "title" => "Sub-Zero Symphony",
        "artist" => "Cyber Pulse",
        "duration" => "05:12",
        "cover" => "https://images.unsplash.com/photo-1470225620780-dba8ba36b745?q=80&w=300&auto=format&fit=crop"
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
    <!-- Base & Modular CSS -->
    <link rel="stylesheet" href="../assets/css/pengguna/dashboard-pengguna.css">
    <link rel="stylesheet" href="../assets/css/pengguna/pencarian.css">
    <link rel="stylesheet" href="../assets/css/pengguna/lagu-disukai.css">
    <link rel="stylesheet" href="../assets/css/pengguna/share-modal.css">
</head>

<body>

    <div class="app-container">

        <!-- ==================== SIDEBAR ==================== -->
        <aside class="sidebar">
            <a href="dashboard-pengguna.php" class="brand-wrapper">
                <div class="brand-icon">
                    <i class="bi bi-soundwave"></i>
                </div>
                <span class="brand-name">Spotifake</span>
            </a>

            <ul class="sidebar-nav">
                <li>
                    <a href="dashboard-pengguna.php" class="nav-link-custom">
                        <i class="bi bi-house-door-fill"></i>
                        <span>Beranda</span>
                    </a>
                </li>
                <li>
                    <a href="pencarian.php" class="nav-link-custom active">
                        <i class="bi bi-search"></i>
                        <span>Cari</span>
                    </a>
                </li>
                <li>
                    <a href="koleksi.php" class="nav-link-custom">
                        <i class="bi bi-collection-play"></i>
                        <span>Koleksi Saya</span>
                    </a>
                </li>
                <li>
                    <a href="lagu-disukai.php" class="nav-link-custom">
                        <i class="bi bi-heart-fill text-danger"></i>
                        <span>Lagu Disukai</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link-custom" id="navCreatePlaylist">
                        <i class="bi bi-plus-square"></i>
                        <span>Buat Playlist</span>
                    </a>
                </li>
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

            <!-- Topbar with Search Active -->
            <header class="topbar">
                <div class="topbar-left">
                    <div class="nav-arrows">
                        <button class="nav-arrow-btn" onclick="history.back()" title="Kembali"><i class="bi bi-chevron-left"></i></button>
                        <button class="nav-arrow-btn" onclick="history.forward()" title="Maju"><i class="bi bi-chevron-right"></i></button>
                    </div>

                    <div class="topbar-search" style="width: 380px;">
                        <i class="bi bi-search search-icon text-info"></i>
                        <input type="text" id="searchInput" placeholder="Cari lagu, artis, atau album..." autofocus>
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
                            <li><a class="dropdown-item text-white" href="koleksi.php"><i class="bi bi-collection-play me-2"></i>Koleksi Saya</a></li>
                            <li><a class="dropdown-item text-white" href="lagu-disukai.php"><i class="bi bi-heart me-2"></i>Lagu yang Disukai</a></li>
                            <li>
                                <hr class="dropdown-divider border-secondary">
                            </li>
                            <li><a class="dropdown-item text-danger fw-bold" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i>Keluar</a></li>
                        </ul>
                    </div>
                </div>
            </header>

            <!-- Content Body -->
            <main class="content-body">

                <!-- 1. Category Chips Filter -->
                <div class="genre-chips-wrapper">
                    <?php foreach ($genres as $idx => $genre): ?>
                        <a href="javascript:void(0)" class="chip-btn <?= $idx === 0 ? 'active' : ''; ?>" onclick="filterGenre(this, '<?= htmlspecialchars($genre); ?>')">
                            <?= htmlspecialchars($genre); ?>
                        </a>
                    <?php endforeach; ?>
                </div>

                <!-- 2. Search Results Section -->
                <div class="row g-4 mb-5" id="searchResultsRow">
                    <!-- Hasil Teratas (Top Result) -->
                    <div class="col-lg-5 top-result-col">
                        <h4 class="fw-bold text-white mb-3" style="font-size: 1.35rem;">Hasil Teratas</h4>
                        <div class="top-result-card play-trigger" data-track="Glacier Wave" data-artist="Arctic Soundscape" data-duration="04:20" data-img="https://images.unsplash.com/photo-1517411032315-54ef2cb783bb?q=80&w=400&auto=format&fit=crop">
                            <img src="https://images.unsplash.com/photo-1517411032315-54ef2cb783bb?q=80&w=400&auto=format&fit=crop" alt="Top Result" class="top-result-img">
                            <h2 class="top-result-title">Glacier Wave</h2>
                            <div class="top-result-subtitle">
                                <span class="badge-artist">Artis Unggulan</span>
                                <span>&bull; 1.482.304 Pendengar Bulanan</span>
                            </div>
                            <p class="text-secondary small mt-2 mb-0">Eksplorasi audio kutub imersif dengan sentuhan synthwave 432Hz.</p>

                            <div class="top-result-play">
                                <i class="bi bi-play-fill"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Lagu Terkait -->
                    <div class="col-lg-7">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h4 class="fw-bold text-white mb-0" style="font-size: 1.35rem;">Lagu Terkait</h4>
                            <span class="text-muted small">Katalog Terverifikasi</span>
                        </div>

                        <div class="song-table-container">
                            <table class="song-table">
                                <tbody>
                                    <?php foreach ($relatedSongs as $i => $song): ?>
                                        <tr class="play-trigger" data-track="<?= htmlspecialchars($song['title']); ?>" data-artist="<?= htmlspecialchars($song['artist']); ?>" data-duration="<?= htmlspecialchars($song['duration']); ?>" data-img="<?= htmlspecialchars($song['cover']); ?>">
                                            <td style="width: 40px; text-align: center; color: var(--text-muted); font-weight: 700;"><?= $i + 1; ?></td>
                                            <td>
                                                <div class="song-title-cell">
                                                    <img src="<?= htmlspecialchars($song['cover']); ?>" alt="Cover" class="song-thumb-small">
                                                    <div>
                                                        <div class="fw-bold text-white"><?= htmlspecialchars($song['title']); ?></div>
                                                        <div class="text-secondary small"><?= htmlspecialchars($song['artist']); ?></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end text-muted small pe-4"><?= htmlspecialchars($song['duration']); ?></td>
                                            <td style="width: 50px;">
                                                <button class="btn btn-sm btn-link text-info p-0" title="Putar Lagu"><i class="bi bi-play-circle-fill fs-5"></i></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- 3. Jelajahi Semua Kategori -->
                <section class="dashboard-section">
                    <div class="section-header-row">
                        <div>
                            <h2 class="section-main-title">Jelajahi Semua Kategori</h2>
                            <div class="section-subtitle">Temukan musik berdasarkan suasana hati, aktivitas, dan genre</div>
                        </div>
                    </div>

                    <div class="category-grid">
                        <?php foreach ($exploreCategories as $cat): ?>
                            <a href="javascript:void(0)" class="category-card" style="background: <?= $cat['gradient']; ?>;" onclick="filterGenre(null, '<?= htmlspecialchars($cat['title']); ?>')">
                                <h4><?= htmlspecialchars($cat['title']); ?></h4>
                                <i class="bi <?= $cat['icon']; ?> category-icon"></i>
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
                <button class="btn-player-like" id="btnLike" title="Sukai Lagu">
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
                    <span class="seek-time" id="currentTimeText">01:45</span>
                    <div class="seek-bar-track" id="seekBar">
                        <div class="seek-progress" id="seekProgress">
                            <div class="seek-thumb"></div>
                        </div>
                    </div>
                    <span class="seek-time" id="durationTimeText">03:52</span>
                </div>
            </div>

            <div class="player-right">
                <button class="control-btn" data-bs-toggle="modal" data-bs-target="#shareModal" title="Bagikan Lagu Ini"><i class="bi bi-share"></i></button>
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

        <!-- ==================== MODAL BAGIKAN (UI-005C) ==================== -->
        <div class="modal fade" id="shareModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered share-modal-dialog">
                <div class="modal-content share-modal-content">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-share-fill text-info fs-5"></i>
                            <h5 class="fw-bold mb-0 text-white">Bagikan Musik</h5>
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <p class="text-secondary small mb-3">Bagikan tautan langsung atau bagikan ke media sosial favoritmu:</p>

                    <div class="share-url-box">
                        <input type="text" id="shareUrlInput" class="share-url-input" value="https://spotifake.app/track/midnight-echoes" readonly>
                        <button type="button" class="btn-copy-url" onclick="copyShareLink()">
                            <i class="bi bi-clipboard me-1"></i> Salin
                        </button>
                    </div>

                    <div class="share-social-grid">
                        <a href="https://wa.me/?text=Dengarkan%20lagu%20ini%20di%20Spotifake:%20https://spotifake.app" target="_blank" class="share-social-btn wa">
                            <i class="bi bi-whatsapp"></i>
                            <span>WhatsApp</span>
                        </a>
                        <a href="https://t.me/share/url?url=https://spotifake.app" target="_blank" class="share-social-btn tg">
                            <i class="bi bi-telegram"></i>
                            <span>Telegram</span>
                        </a>
                        <a href="https://twitter.com/intent/tweet?text=Dengarkan%20lagu%20di%20Spotifake" target="_blank" class="share-social-btn tw">
                            <i class="bi bi-twitter-x"></i>
                            <span>Twitter / X</span>
                        </a>
                        <a href="javascript:void(0)" onclick="showToast('Tautan disalin untuk Instagram Stories!')" class="share-social-btn ig">
                            <i class="bi bi-instagram"></i>
                            <span>Instagram</span>
                        </a>
                    </div>

                    <div class="qr-preview-box">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=https://spotifake.app" alt="QR Code" class="qr-code-img">
                        <div>
                            <div class="fw-bold text-white small">Scan & Play Instan</div>
                            <div class="text-secondary small">Arahkan kamera smartphone untuk langsung memutar di perangkat lain.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Modular JS -->
    <script src="../assets/js/pengguna/player.js"></script>
    <script src="../assets/js/pengguna/pencarian.js"></script>
    <script src="../assets/js/pengguna/share-modal.js"></script>
</body>

</html>
