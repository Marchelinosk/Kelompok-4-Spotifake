<?php
session_start();
require_once '../config/database.php';

$pageTitle = "Lagu yang Disukai - Spotifake";
$userName = isset($_SESSION['username']) ? $_SESSION['username'] : "Alya Aurelia";

// Data Lagu yang Disukai (Mockup data terstruktur sesuai UI-004 SDD)
$likedSongsList = [
    [
        "id" => 1,
        "title" => "Midnight Echoes",
        "artist" => "Arctic Mirage",
        "album" => "Northern Lights Odyssey",
        "date_added" => "2 hari yang lalu",
        "duration" => "03:52",
        "cover" => "https://images.unsplash.com/photo-1509198397868-475647b2a1e5?q=80&w=300&auto=format&fit=crop"
    ],
    [
        "id" => 2,
        "title" => "Frost Horizon",
        "artist" => "Nora Valkyrie",
        "album" => "Subzero Reflections",
        "date_added" => "4 hari yang lalu",
        "duration" => "04:18",
        "cover" => "https://images.unsplash.com/photo-1517411032315-54ef2cb783bb?q=80&w=300&auto=format&fit=crop"
    ],
    [
        "id" => 3,
        "title" => "Neon Tundra",
        "artist" => "Kaelen Vex",
        "album" => "Glacial Drift EP",
        "date_added" => "1 minggu yang lalu",
        "duration" => "03:15",
        "cover" => "https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=300&auto=format&fit=crop"
    ],
    [
        "id" => 4,
        "title" => "Sub-Zero Symphony",
        "artist" => "Aura Ensemble",
        "album" => "Crystalline Suite",
        "date_added" => "2 minggu yang lalu",
        "duration" => "05:44",
        "cover" => "https://images.unsplash.com/photo-1470225620780-dba8ba36b745?q=80&w=300&auto=format&fit=crop"
    ],
    [
        "id" => 5,
        "title" => "Crystal Frequency",
        "artist" => "Sova & The Tribe",
        "album" => "Resonance",
        "date_added" => "3 minggu yang lalu",
        "duration" => "04:02",
        "cover" => "https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=300&auto=format&fit=crop"
    ],
    [
        "id" => 6,
        "title" => "Kala Hujan Turun",
        "artist" => "Alya & Kalandra",
        "album" => "Suara Teduh Vol. 1",
        "date_added" => "1 bulan yang lalu",
        "duration" => "04:48",
        "cover" => "https://images.unsplash.com/photo-1518609878373-06d740f60d8b?q=80&w=300&auto=format&fit=crop"
    ],
    [
        "id" => 7,
        "title" => "Senja di Balik Layar",
        "artist" => "Calvin H.",
        "album" => "Monolog Digital",
        "date_added" => "1 bulan yang lalu",
        "duration" => "03:26",
        "cover" => "https://images.unsplash.com/photo-1508700115892-45ecd05ae2ad?q=80&w=300&auto=format&fit=crop"
    ],
    [
        "id" => 8,
        "title" => "Gelombang Fajar",
        "artist" => "Elsya Handayani",
        "album" => "Cahaya Pertama",
        "date_added" => "2 bulan yang lalu",
        "duration" => "04:45",
        "cover" => "https://images.unsplash.com/photo-1465847899084-d164df4dedc6?q=80&w=300&auto=format&fit=crop"
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
                    <a href="pencarian.php" class="nav-link-custom">
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
                    <a href="lagu-disukai.php" class="nav-link-custom active">
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

            <!-- Topbar -->
            <header class="topbar">
                <div class="topbar-left">
                    <div class="nav-arrows">
                        <button class="nav-arrow-btn" onclick="history.back()" title="Kembali"><i class="bi bi-chevron-left"></i></button>
                        <button class="nav-arrow-btn" onclick="history.forward()" title="Maju"><i class="bi bi-chevron-right"></i></button>
                    </div>

                    <div class="topbar-search">
                        <i class="bi bi-search search-icon"></i>
                        <input type="text" id="searchInput" placeholder="Cari di Lagu yang Disukai...">
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
                            <li><a class="dropdown-item text-white active" href="lagu-disukai.php"><i class="bi bi-heart me-2"></i>Lagu yang Disukai</a></li>
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

                <!-- 1. Header Banner Lagu Disukai (UI-004) -->
                <div class="playlist-header-banner liked-songs-gradient">
                    <div class="playlist-cover-liked">
                        <i class="bi bi-heart-fill"></i>
                    </div>

                    <div class="playlist-header-info">
                        <span class="playlist-type-tag">KOLEKSI TERVERIFIKASI &bull; SKPL-F-004</span>
                        <h1 class="playlist-title-big">Lagu yang Disukai</h1>
                        <p class="playlist-desc-text">
                            Kumpulan kurasi lagu favorit yang tersimpan otomatis di database preferensi pengguna. Diperbarui secara real-time.
                        </p>
                        <div class="playlist-meta-row">
                            <span class="fw-bold text-white"><?= htmlspecialchars($userName); ?></span>
                            <span>&bull;</span>
                            <span>128 Lagu</span>
                            <span>&bull;</span>
                            <span class="text-secondary">Sekitar 7 jam 42 mnt</span>
                        </div>
                    </div>
                </div>

                <!-- 2. Action Bar Controls -->
                <div class="playlist-action-bar">
                    <div class="action-bar-left">
                        <button class="btn-play-all play-trigger" data-track="Midnight Echoes" data-artist="Arctic Mirage" data-duration="03:52" data-img="https://images.unsplash.com/photo-1509198397868-475647b2a1e5?q=80&w=300&auto=format&fit=crop" title="Putar Semua Lagu">
                            <i class="bi bi-play-fill"></i>
                        </button>
                        <button class="btn-action-round" data-bs-toggle="modal" data-bs-target="#shareModal" title="Bagikan Koleksi Ini">
                            <i class="bi bi-share"></i>
                        </button>
                        <button class="btn-action-round" title="Opsi Lainnya">
                            <i class="bi bi-three-dots"></i>
                        </button>
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <span class="text-muted small">Urutan:</span>
                        <div class="dropdown">
                            <button class="btn-sort-dropdown dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Kustom Terbaru
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item" href="#">Tanggal Ditambahkan</a></li>
                                <li><a class="dropdown-item" href="#">Judul Lagu (A-Z)</a></li>
                                <li><a class="dropdown-item" href="#">Nama Artis</a></li>
                                <li><a class="dropdown-item" href="#">Durasi</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- 3. Tabel Daftar Lagu Favorit -->
                <div class="song-table-container">
                    <table class="song-table">
                        <thead>
                            <tr>
                                <th style="width: 50px; text-align: center;">#</th>
                                <th>JUDUL</th>
                                <th>ALBUM</th>
                                <th>TANGGAL DITAMBAHKAN</th>
                                <th style="text-align: right; padding-right: 1.5rem;">DURASI</th>
                                <th style="width: 60px; text-align: center;">SUKA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($likedSongsList as $index => $song): ?>
                                <tr class="play-trigger" data-track="<?= htmlspecialchars($song['title']); ?>" data-artist="<?= htmlspecialchars($song['artist']); ?>" data-duration="<?= htmlspecialchars($song['duration']); ?>" data-img="<?= htmlspecialchars($song['cover']); ?>">
                                    <td style="text-align: center; color: var(--text-muted); font-weight: 700;">
                                        <?= str_pad($index + 1, 2, '0', STR_PAD_LEFT); ?>
                                    </td>
                                    <td>
                                        <div class="song-title-cell">
                                            <img src="<?= htmlspecialchars($song['cover']); ?>" alt="Cover" class="song-thumb-small">
                                            <div>
                                                <div class="fw-bold text-white"><?= htmlspecialchars($song['title']); ?></div>
                                                <div class="text-secondary small"><?= htmlspecialchars($song['artist']); ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-secondary"><?= htmlspecialchars($song['album']); ?></td>
                                    <td class="text-muted small"><?= htmlspecialchars($song['date_added']); ?></td>
                                    <td class="text-end text-muted small pe-4"><?= htmlspecialchars($song['duration']); ?></td>
                                    <td style="text-align: center;">
                                        <button class="btn btn-sm text-danger p-0 border-0 bg-transparent btn-toggle-like" onclick="event.stopPropagation(); toggleLikeRow(this, '<?= htmlspecialchars($song['title']); ?>')">
                                            <i class="bi bi-heart-fill fs-5"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Status Sinkronisasi Footer -->
                <div class="system-status-bar mt-4">
                    <div>
                        <span class="status-dot"></span>
                        <strong class="text-white">Sinkronisasi Database Relasional (Kamus Data: Tabel 'likes')</strong>
                    </div>
                    <div>
                        Menyimpan relasi: <span class="text-info font-monospace">id_user=10241008 &bull; id_song</span> dengan atribut <span class="text-white">liked_at otomatis</span>
                    </div>
                    <div class="text-success fw-bold">
                        STATUS: 200 OK &bull; Terkoneksi
                    </div>
                </div>

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
                <button class="btn-player-like liked" id="btnLike" title="Sukai Lagu">
                    <i class="bi bi-heart-fill text-danger"></i>
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
                            <h5 class="fw-bold mb-0 text-white">Bagikan Koleksi / Lagu</h5>
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <p class="text-secondary small mb-3">Bagikan tautan langsung atau bagikan ke media sosial favoritmu:</p>

                    <div class="share-url-box">
                        <input type="text" id="shareUrlInput" class="share-url-input" value="https://spotifake.app/collection/liked-songs" readonly>
                        <button type="button" class="btn-copy-url" onclick="copyShareLink()">
                            <i class="bi bi-clipboard me-1"></i> Salin
                        </button>
                    </div>

                    <div class="share-social-grid">
                        <a href="https://wa.me/?text=Dengarkan%20koleksi%20lagu%20favorit%20di%20Spotifake:%20https://spotifake.app" target="_blank" class="share-social-btn wa">
                            <i class="bi bi-whatsapp"></i>
                            <span>WhatsApp</span>
                        </a>
                        <a href="https://t.me/share/url?url=https://spotifake.app" target="_blank" class="share-social-btn tg">
                            <i class="bi bi-telegram"></i>
                            <span>Telegram</span>
                        </a>
                        <a href="https://twitter.com/intent/tweet?text=Dengarkan%20koleksi%20lagu%20di%20Spotifake" target="_blank" class="share-social-btn tw">
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
    <script src="../assets/js/pengguna/lagu-disukai.js"></script>
    <script src="../assets/js/pengguna/share-modal.js"></script>
</body>

</html>
