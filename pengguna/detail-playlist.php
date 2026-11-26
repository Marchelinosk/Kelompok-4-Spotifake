<?php
session_start();
require_once '../config/database.php';

$userName = isset($_SESSION['username']) ? $_SESSION['username'] : "Alya Aurelia";

// Tangkap parameter slug atau ID playlist
$playlistSlug = isset($_GET['playlist']) ? $_GET['playlist'] : 'chill-vibes';

// Pilihan Data Playlist
$playlistsData = [
    'chill-vibes' => [
        'title' => 'Chill Vibes 2026',
        'desc' => 'Kompilasi beat santai synthwave & lo-fi untuk menemani coding, santai sore, dan istirahat malam yang tenang.',
        'cover' => 'https://images.unsplash.com/photo-1518709268805-4e9042af9f23?q=80&w=600&auto=format&fit=crop',
        'songs_count' => '24 lagu',
        'duration' => '1 jam 34 mnt'
    ],
    'weekly-top-50' => [
        'title' => 'Weekly Top 50',
        'desc' => 'Tangga lagu paling banyak diputar dan trending di Spotifake minggu ini. Diperbarui setiap hari Senin.',
        'cover' => 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?q=80&w=600&auto=format&fit=crop',
        'songs_count' => '50 lagu',
        'duration' => '3 jam 15 mnt'
    ],
    'coding-session' => [
        'title' => 'Coding Session',
        'desc' => 'Aliran nada elektronik retro-modern tanpa vokal yang memicu kondisi flow mendalam untuk programmer & kreator.',
        'cover' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=600&auto=format&fit=crop',
        'songs_count' => '32 lagu',
        'duration' => '2 jam 18 mnt'
    ],
    'night-drive' => [
        'title' => 'Night Drive Synth',
        'desc' => 'Lanskap suara synthwave kutub bernuansa neon, bassline hangat, dan atmosfer jalanan malam.',
        'cover' => 'https://images.unsplash.com/photo-1517411032315-54ef2cb783bb?q=80&w=600&auto=format&fit=crop',
        'songs_count' => '18 lagu',
        'duration' => '1 jam 08 mnt'
    ]
];

$currentPlaylist = isset($playlistsData[$playlistSlug]) ? $playlistsData[$playlistSlug] : $playlistsData['chill-vibes'];
$pageTitle = $currentPlaylist['title'] . " - Spotifake";

// Data Lagu di dalam Playlist
$playlistSongs = [
    [
        "id" => 1,
        "title" => "Midnight Echoes",
        "artist" => "Arctic Mirage",
        "album" => "Northern Lights Odyssey",
        "date_added" => "3 hari lalu",
        "duration" => "03:52",
        "cover" => "https://images.unsplash.com/photo-1509198397868-475647b2a1e5?q=80&w=300&auto=format&fit=crop"
    ],
    [
        "id" => 2,
        "title" => "Resonansi Senja",
        "artist" => "Jakarta Sunset Club",
        "album" => "Senja di Kota",
        "date_added" => "5 hari lalu",
        "duration" => "03:10",
        "cover" => "https://images.unsplash.com/photo-1501386761578-eac5c94b800a?q=80&w=300&auto=format&fit=crop"
    ],
    [
        "id" => 3,
        "title" => "Lembah Baku",
        "artist" => "Kalandra",
        "album" => "Indie Suara",
        "date_added" => "1 minggu lalu",
        "duration" => "04:15",
        "cover" => "https://images.unsplash.com/photo-1459749411175-04bf5292ceea?q=80&w=300&auto=format&fit=crop"
    ],
    [
        "id" => 4,
        "title" => "Pendar Renjana",
        "artist" => "Luna Maya Synth",
        "album" => "Akustik Spektrum",
        "date_added" => "2 minggu lalu",
        "duration" => "02:45",
        "cover" => "https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?q=80&w=300&auto=format&fit=crop"
    ],
    [
        "id" => 5,
        "title" => "Hujan di Sudut Kota",
        "artist" => "Niskala Nada",
        "album" => "Suara Teduh",
        "date_added" => "3 minggu lalu",
        "duration" => "04:02",
        "cover" => "https://images.unsplash.com/photo-1518609878373-06d740f60d8b?q=80&w=300&auto=format&fit=crop"
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
    <link rel="stylesheet" href="../assets/css/pengguna/detail-playlist.css">
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
                <li><a href="detail-playlist.php?playlist=chill-vibes" class="playlist-link <?= $playlistSlug === 'chill-vibes' ? 'text-info fw-bold' : ''; ?>">Chill Vibes 2026</a></li>
                <li><a href="detail-playlist.php?playlist=weekly-top-50" class="playlist-link <?= $playlistSlug === 'weekly-top-50' ? 'text-info fw-bold' : ''; ?>">Weekly Top 50</a></li>
                <li><a href="detail-playlist.php?playlist=coding-session" class="playlist-link <?= $playlistSlug === 'coding-session' ? 'text-info fw-bold' : ''; ?>">Coding Session</a></li>
                <li><a href="detail-playlist.php?playlist=night-drive" class="playlist-link <?= $playlistSlug === 'night-drive' ? 'text-info fw-bold' : ''; ?>">Night Drive Synth</a></li>
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
                        <input type="text" id="searchInput" placeholder="Cari dalam playlist ini...">
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

                <!-- 1. Header Detail Playlist (UI-005) -->
                <div class="playlist-header-banner">
                    <img src="<?= htmlspecialchars($currentPlaylist['cover']); ?>" alt="Cover Playlist" class="playlist-cover-big">

                    <div class="playlist-header-info">
                        <span class="playlist-type-tag">PUBLIC PLAYLIST &bull; SPOTIFAKE CURATION</span>
                        <h1 class="playlist-title-big"><?= htmlspecialchars($currentPlaylist['title']); ?></h1>
                        <p class="playlist-desc-text">
                            <?= htmlspecialchars($currentPlaylist['desc']); ?>
                        </p>
                        <div class="playlist-meta-row">
                            <span class="fw-bold text-white"><?= htmlspecialchars($userName); ?></span>
                            <span>&bull;</span>
                            <span><?= htmlspecialchars($currentPlaylist['songs_count']); ?></span>
                            <span>&bull;</span>
                            <span class="text-secondary"><?= htmlspecialchars($currentPlaylist['duration']); ?></span>
                        </div>
                    </div>
                </div>

                <!-- 2. Action Controls Bar -->
                <div class="playlist-action-bar">
                    <div class="action-bar-left">
                        <button class="btn-play-all play-trigger" data-track="<?= htmlspecialchars($playlistSongs[0]['title']); ?>" data-artist="<?= htmlspecialchars($playlistSongs[0]['artist']); ?>" data-duration="<?= htmlspecialchars($playlistSongs[0]['duration']); ?>" data-img="<?= htmlspecialchars($playlistSongs[0]['cover']); ?>" title="Putar Semua">
                            <i class="bi bi-play-fill"></i>
                        </button>
                        <button class="btn-action-round" id="btnFollowPlaylist" onclick="toggleFollowPlaylist(this)" title="Simpan ke Koleksi">
                            <i class="bi bi-bookmark-plus"></i>
                        </button>
                        <button class="btn-action-round" data-bs-toggle="modal" data-bs-target="#shareModal" title="Bagikan Playlist Ini">
                            <i class="bi bi-share"></i>
                        </button>
                        <button class="btn-action-round" onclick="showToast('Mengunduh playlist untuk pemutaran offline')" title="Unduh Offline">
                            <i class="bi bi-arrow-down-circle"></i>
                        </button>
                    </div>

                    <div>
                        <button class="btn btn-sm btn-outline-info rounded-pill px-3 fw-bold" onclick="toggleAddSongSection()">
                            <i class="bi bi-plus-circle me-1"></i> Tambah Lagu
                        </button>
                    </div>
                </div>

                <!-- 3. Form Tambah Lagu ke Playlist (Sesuai SDD UI-005) -->
                <div id="addSongBox" class="mb-4 p-4 rounded-4" style="display: none; background: rgba(14, 23, 42, 0.75); border: 1px dashed var(--border-cyan);">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold text-white mb-0"><i class="bi bi-search text-info me-2"></i>Cari Lagu untuk Ditambahkan ke Playlist</h5>
                        <button class="btn btn-sm text-secondary" onclick="toggleAddSongSection()"><i class="bi bi-x-lg"></i></button>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-dark border-secondary text-secondary"><i class="bi bi-music-note"></i></span>
                        <input type="text" class="form-control bg-dark border-secondary text-white" placeholder="Ketik judul lagu yang ingin kamu tambahkan...">
                        <button class="btn btn-primary-custom px-4" type="button" onclick="showToast('Mencari lagu di repositori Spotifake...')">Cari</button>
                    </div>
                    <div class="text-secondary small">
                        💡 Rekomendasi cepat: <a href="javascript:void(0)" onclick="addSongMock('Arus Frekuensi 2.0')" class="text-info text-decoration-none">+ Arus Frekuensi 2.0</a>, <a href="javascript:void(0)" onclick="addSongMock('Deep Focus Synth')" class="text-info text-decoration-none">+ Deep Focus Synth</a>
                    </div>
                </div>

                <!-- 4. Tabel Daftar Lagu di Playlist -->
                <div class="song-table-container">
                    <table class="song-table" id="playlistSongTable">
                        <thead>
                            <tr>
                                <th style="width: 50px; text-align: center;">#</th>
                                <th>JUDUL & ARTIS</th>
                                <th>ALBUM</th>
                                <th>DITAMBAHKAN</th>
                                <th style="text-align: right; padding-right: 1.5rem;">DURASI</th>
                                <th style="width: 60px; text-align: center;">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($playlistSongs as $index => $song): ?>
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
                                        <button class="btn btn-sm text-secondary p-0 border-0 bg-transparent hover-danger" onclick="event.stopPropagation(); removeSongRow(this, '<?= htmlspecialchars($song['title']); ?>')" title="Hapus dari playlist">
                                            <i class="bi bi-trash3 fs-6"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
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
                <button class="control-btn" data-bs-toggle="modal" data-bs-target="#shareModal" title="Bagikan Playlist Ini"><i class="bi bi-share"></i></button>
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
                            <h5 class="fw-bold mb-0 text-white">Bagikan Playlist: <?= htmlspecialchars($currentPlaylist['title']); ?></h5>
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <p class="text-secondary small mb-3">Bagikan playlist ini dengan teman-temanmu:</p>

                    <div class="share-url-box">
                        <input type="text" id="shareUrlInput" class="share-url-input" value="https://spotifake.app/playlist/<?= htmlspecialchars($playlistSlug); ?>" readonly>
                        <button type="button" class="btn-copy-url" onclick="copyShareLink()">
                            <i class="bi bi-clipboard me-1"></i> Salin
                        </button>
                    </div>

                    <div class="share-social-grid">
                        <a href="https://wa.me/?text=Dengarkan%20playlist%20<?= urlencode($currentPlaylist['title']); ?>%20di%20Spotifake:%20https://spotifake.app/playlist/<?= $playlistSlug; ?>" target="_blank" class="share-social-btn wa">
                            <i class="bi bi-whatsapp"></i>
                            <span>WhatsApp</span>
                        </a>
                        <a href="https://t.me/share/url?url=https://spotifake.app/playlist/<?= $playlistSlug; ?>" target="_blank" class="share-social-btn tg">
                            <i class="bi bi-telegram"></i>
                            <span>Telegram</span>
                        </a>
                        <a href="https://twitter.com/intent/tweet?text=Dengarkan%20playlist%20<?= urlencode($currentPlaylist['title']); ?>%20di%20Spotifake" target="_blank" class="share-social-btn tw">
                            <i class="bi bi-twitter-x"></i>
                            <span>Twitter / X</span>
                        </a>
                        <a href="javascript:void(0)" onclick="showToast('Tautan playlist disalin untuk Instagram Stories!')" class="share-social-btn ig">
                            <i class="bi bi-instagram"></i>
                            <span>Instagram</span>
                        </a>
                    </div>

                    <div class="qr-preview-box">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=https://spotifake.app/playlist/<?= $playlistSlug; ?>" alt="QR Code" class="qr-code-img">
                        <div>
                            <div class="fw-bold text-white small">Scan & Dengarkan Playlist</div>
                            <div class="text-secondary small">Arahkan kamera HP untuk membuka playlist langsung di ponsel.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Modular JS -->
    <script src="../assets/js/pengguna/player.js"></script>
    <script src="../assets/js/pengguna/playlist.js"></script>
    <script src="../assets/js/pengguna/share-modal.js"></script>
</body>

</html>
