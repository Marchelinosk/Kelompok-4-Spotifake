<?php
session_start();
require_once '../config/database.php';

$pageTitle = "Koleksi Saya - Spotifake";
$userName = isset($_SESSION['username']) ? $_SESSION['username'] : "elsyanrr_";

// Data Playlist Koleksi (Mockup sesuai SDD UI-005B)
$myPlaylists = [
    [
        "name" => "Chill Vibes 2026",
        "desc" => "Santai dengan beat lo-fi dan ambient malam",
        "songs" => 24,
        "cover" => "https://images.unsplash.com/photo-1518709268805-4e9042af9f23?q=80&w=400&auto=format&fit=crop",
        "slug" => "chill-vibes",
        "sample_track" => "Chill Lofi Beats",
        "sample_artist" => "Lo-Fi Dreamer",
        "sample_duration" => "02:45"
    ],
    [
        "name" => "Weekly Top 50",
        "desc" => "Lagu terpopuler minggu ini di Indonesia",
        "songs" => 50,
        "cover" => "https://images.unsplash.com/photo-1470225620780-dba8ba36b745?q=80&w=400&auto=format&fit=crop",
        "slug" => "weekly-top-50",
        "sample_track" => "Top Indonesian Hits 2026",
        "sample_artist" => "Indo Chart Radio",
        "sample_duration" => "03:22"
    ],
    [
        "name" => "Coding Session",
        "desc" => "Fokus ngoding tanpa distraksi",
        "songs" => 32,
        "cover" => "https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=400&auto=format&fit=crop",
        "slug" => "coding-session",
        "sample_track" => "Deep Focus Synth",
        "sample_artist" => "Cyber Pulse",
        "sample_duration" => "04:10"
    ],
    [
        "name" => "Night Drive Synth",
        "desc" => "Synthwave untuk perjalanan malam",
        "songs" => 18,
        "cover" => "https://images.unsplash.com/photo-1517411032315-54ef2cb783bb?q=80&w=400&auto=format&fit=crop",
        "slug" => "night-drive",
        "sample_track" => "Polar Night Ambient",
        "sample_artist" => "Subzero Lab",
        "sample_duration" => "05:20"
    ],
    [
        "name" => "Akustik Senja",
        "desc" => "Petikan gitar dan melodi hangat",
        "songs" => 15,
        "cover" => "https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?q=80&w=400&auto=format&fit=crop",
        "slug" => "akustik-senja",
        "sample_track" => "Pendar Renjana",
        "sample_artist" => "Luna Maya Synth",
        "sample_duration" => "02:45"
    ],
    [
        "name" => "Deep Focus Alpha",
        "desc" => "Gelombang alpha untuk konsentrasi maksimal",
        "songs" => 40,
        "cover" => "https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=400&auto=format&fit=crop",
        "slug" => "deep-focus",
        "sample_track" => "Resonansi Senja",
        "sample_artist" => "Jakarta Sunset Club",
        "sample_duration" => "03:10"
    ]
];

// Data Artis yang Diikuti (Sesuai SDD & Tema Musik)
$followedArtists = [
    [
        "name" => "Arctic Mirage",
        "genre" => "Artis • Synthwave / Electronic",
        "monthly_listeners" => "1.4M Pendengar Bulanan",
        "avatar" => "https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=400&auto=format&fit=crop",
        "sample_track" => "Midnight Echoes",
        "duration" => "03:52"
    ],
    [
        "name" => "Kalandra",
        "genre" => "Artis • Indie Folk Nusantara",
        "monthly_listeners" => "850K Pendengar Bulanan",
        "avatar" => "https://images.unsplash.com/photo-1465847899084-d164df4dedc6?q=80&w=400&auto=format&fit=crop",
        "sample_track" => "Lembah Baku",
        "duration" => "04:15"
    ],
    [
        "name" => "Nora Valkyrie",
        "genre" => "Artis • Ambient & Soundscape",
        "monthly_listeners" => "620K Pendengar Bulanan",
        "avatar" => "https://images.unsplash.com/photo-1517411032315-54ef2cb783bb?q=80&w=400&auto=format&fit=crop",
        "sample_track" => "Frost Horizon",
        "duration" => "04:15"
    ],
    [
        "name" => "Jakarta Sunset Club",
        "genre" => "Artis • Lo-Fi Beats & Jazzhop",
        "monthly_listeners" => "410K Pendengar Bulanan",
        "avatar" => "https://images.unsplash.com/photo-1501386761578-eac5c94b800a?q=80&w=400&auto=format&fit=crop",
        "sample_track" => "Resonansi Senja",
        "duration" => "03:10"
    ],
    [
        "name" => "Elsya Handayani",
        "genre" => "Artis • Akustik & Pop Syahdu",
        "monthly_listeners" => "320K Pendengar Bulanan",
        "avatar" => "https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=400&auto=format&fit=crop",
        "sample_track" => "Gelombang Fajar",
        "duration" => "04:45"
    ],
    [
        "name" => "Calvin H.",
        "genre" => "Artis • Chillwave & Digital Mood",
        "monthly_listeners" => "280K Pendengar Bulanan",
        "avatar" => "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=400&auto=format&fit=crop",
        "sample_track" => "Senja di Balik Layar",
        "duration" => "03:20"
    ]
];

// Data Album Tersimpan (Sesuai SDD Hal 41-43)
$savedAlbums = [
    [
        "title" => "Northern Lights Odyssey",
        "artist" => "Arctic Mirage",
        "year" => "2026",
        "tracks_count" => "12 Lagu",
        "cover" => "https://images.unsplash.com/photo-1509198397868-475647b2a1e5?q=80&w=400&auto=format&fit=crop",
        "sample_track" => "Midnight Echoes",
        "duration" => "03:52"
    ],
    [
        "title" => "Subzero Reflections",
        "artist" => "Nora Valkyrie",
        "year" => "2025",
        "tracks_count" => "10 Lagu",
        "cover" => "https://images.unsplash.com/photo-1518709268805-4e9042af9f23?q=80&w=400&auto=format&fit=crop",
        "sample_track" => "Frost Horizon",
        "duration" => "04:15"
    ],
    [
        "title" => "Glacial Drift EP",
        "artist" => "Kaelen Voss",
        "year" => "2026",
        "tracks_count" => "6 Lagu",
        "cover" => "https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=400&auto=format&fit=crop",
        "sample_track" => "Neon Tundra",
        "duration" => "02:58"
    ],
    [
        "title" => "Cahaya Pertama",
        "artist" => "Elsya Handayani",
        "year" => "2026",
        "tracks_count" => "8 Lagu",
        "cover" => "https://images.unsplash.com/photo-1459749411175-04bf5292ceea?q=80&w=400&auto=format&fit=crop",
        "sample_track" => "Gelombang Fajar",
        "duration" => "04:45"
    ],
    [
        "title" => "Morning Digital",
        "artist" => "Calvin H.",
        "year" => "2026",
        "tracks_count" => "9 Lagu",
        "cover" => "https://images.unsplash.com/photo-1501386761578-eac5c94b800a?q=80&w=400&auto=format&fit=crop",
        "sample_track" => "Senja di Balik Layar",
        "duration" => "03:20"
    ],
    [
        "title" => "Suara Teduh Vol. 1",
        "artist" => "Alya & Lazuardi",
        "year" => "2025",
        "tracks_count" => "11 Lagu",
        "cover" => "https://images.unsplash.com/photo-1518609878373-06d740f60d8b?q=80&w=400&auto=format&fit=crop",
        "sample_track" => "Kala Hujan Turun",
        "duration" => "04:02"
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

    <style>
        /* Sentuhan Elegan Khusus Koleksi Saya */
        .collection-hero-bar {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .collection-hero-bar h1 {
            font-size: 2.2rem;
            font-weight: 800;
            color: #fff;
            margin: 0;
            letter-spacing: -0.5px;
        }

        .collection-hero-bar p {
            color: #94a3b8;
            font-size: 0.95rem;
            margin: 0.25rem 0 0 0;
        }

        .btn-new-playlist {
            background: linear-gradient(135deg, #0ea5e9, #0284c7);
            color: #fff;
            border: none;
            padding: 0.65rem 1.35rem;
            border-radius: 9999px;
            font-weight: 600;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 4px 14px rgba(14, 165, 233, 0.35);
            transition: all 0.25s ease;
            cursor: pointer;
        }

        .btn-new-playlist:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(14, 165, 233, 0.5);
            color: #fff;
        }

        /* Filter Chips Modern */
        .genre-chips-wrapper {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            margin-bottom: 1.75rem;
            overflow-x: auto;
            padding-bottom: 0.25rem;
        }

        .chip-btn {
            background: rgba(255, 255, 255, 0.05);
            color: #cbd5e1;
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 0.45rem 1.25rem;
            border-radius: 9999px;
            font-size: 0.85rem;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s ease;
            white-space: nowrap;
            user-select: none;
        }

        .chip-btn:hover {
            background: rgba(255, 255, 255, 0.12);
            color: #fff;
        }

        .chip-btn.active {
            background: #fff;
            color: #0b1120;
            font-weight: 700;
            border-color: #fff;
            box-shadow: 0 2px 10px rgba(255, 255, 255, 0.2);
        }

        /* Shortcut Banner Lagu yang Disukai (Spotify Minimalist) */
        .liked-shortcut-card {
            background: linear-gradient(135deg, #4338ca 0%, #6366f1 60%, #38bdf8 100%);
            border-radius: 16px;
            padding: 1.35rem 1.6rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            text-decoration: none;
            margin-bottom: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 8px 24px rgba(67, 56, 202, 0.25);
            transition: all 0.25s ease;
        }

        .liked-shortcut-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(67, 56, 202, 0.4);
        }

        .liked-shortcut-left {
            display: flex;
            align-items: center;
            gap: 1.25rem;
        }

        .liked-icon-circle {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(8px);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.5rem;
        }

        .liked-shortcut-title {
            color: #fff;
            font-size: 1.15rem;
            font-weight: 700;
            margin: 0;
        }

        .liked-shortcut-sub {
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.85rem;
            margin: 0.2rem 0 0 0;
        }

        .liked-shortcut-arrow {
            color: #fff;
            font-size: 1.2rem;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .liked-shortcut-card:hover .liked-shortcut-arrow {
            transform: translateX(4px);
            background: #fff;
            color: #4338ca;
        }

        /* Grid Kartu Playlist */
        .collection-card {
            cursor: pointer;
            position: relative;
            background: var(--bg-card);
            border: 1px solid var(--border-subtle);
            border-radius: 18px;
            padding: 1.15rem;
            transition: all 0.25s ease;
            display: flex;
            flex-direction: column;
        }

        .collection-card:hover {
            background: var(--bg-card-hover);
            border-color: rgba(0, 162, 255, 0.4);
            transform: translateY(-4px);
            box-shadow: 0 14px 28px -10px rgba(0, 0, 0, 0.7), 0 0 18px rgba(0, 162, 255, 0.15);
        }

        .collection-card .card-play-btn {
            position: absolute;
            right: 0.75rem;
            bottom: 0.75rem;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #22c55e;
            color: #050a14;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
            opacity: 0;
            transform: translateY(8px);
            transition: all 0.25s ease;
            box-shadow: 0 6px 16px rgba(34, 197, 94, 0.4);
            border: none;
            z-index: 4;
        }

        .collection-card:hover .card-play-btn {
            opacity: 1;
            transform: translateY(0);
        }

        .collection-card .card-play-btn:hover {
            transform: scale(1.08);
            background: #4ade80;
        }

        /* Kartu Artis Diikuti (Lingkaran Bulat Elegan) */
        .artist-card {
            background: var(--bg-card);
            border: 1px solid var(--border-subtle);
            border-radius: 18px;
            padding: 1.25rem;
            text-align: center;
            transition: all 0.25s ease;
            cursor: pointer;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .artist-card:hover {
            background: var(--bg-card-hover);
            border-color: rgba(0, 162, 255, 0.4);
            transform: translateY(-4px);
            box-shadow: 0 14px 28px -10px rgba(0, 0, 0, 0.7);
        }

        .artist-avatar-wrap {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            overflow: hidden;
            margin-bottom: 1rem;
            position: relative;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
        }

        .artist-avatar-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .artist-card:hover .artist-avatar-img {
            transform: scale(1.05);
        }

        .artist-play-btn {
            position: absolute;
            right: 8px;
            bottom: 8px;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #0ea5e9;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            opacity: 0;
            transform: translateY(6px);
            transition: all 0.25s ease;
            box-shadow: 0 4px 14px rgba(14, 165, 233, 0.45);
            border: none;
            z-index: 4;
        }

        .artist-card:hover .artist-play-btn {
            opacity: 1;
            transform: translateY(0);
        }

        .artist-card-name {
            font-size: 1rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 0.2rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            width: 100%;
        }

        .artist-card-genre {
            font-size: 0.8rem;
            color: #94a3b8;
            margin-bottom: 0.35rem;
        }

        .artist-card-listeners {
            font-size: 0.75rem;
            color: #64748b;
        }

        .btn-follow-toggle {
            margin-top: 0.75rem;
            font-size: 0.75rem;
            padding: 0.3rem 0.85rem;
            border-radius: 9999px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: transparent;
            color: #cbd5e1;
            transition: all 0.2s;
        }

        .btn-follow-toggle:hover {
            border-color: #fff;
            color: #fff;
        }

        .btn-follow-toggle.following {
            background: rgba(14, 165, 233, 0.15);
            border-color: #0ea5e9;
            color: #38bdf8;
            font-weight: 600;
        }

        /* Modal Buat Playlist (Spotify Style) */
        .modal-spotifake {
            z-index: 1060 !important;
        }

        .modal-spotifake .modal-dialog {
            z-index: 1061 !important;
        }

        .modal-spotifake .modal-content {
            background: #111827;
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.8);
            color: #fff;
            backdrop-filter: blur(20px);
        }

        .modal-spotifake .modal-header {
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            padding: 1.25rem 1.5rem;
        }

        .modal-spotifake .modal-title {
            font-weight: 700;
            font-size: 1.2rem;
            color: #fff;
        }

        .modal-spotifake .modal-body {
            padding: 1.5rem;
        }

        .modal-spotifake .modal-footer {
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding: 1rem 1.5rem;
        }

        .playlist-modal-grid {
            display: grid;
            grid-template-columns: 140px 1fr;
            gap: 1.25rem;
        }

        @media (max-width: 576px) {
            .playlist-modal-grid {
                grid-template-columns: 1fr;
            }
        }

        .playlist-cover-placeholder {
            width: 140px;
            height: 140px;
            border-radius: 12px;
            background: linear-gradient(135deg, #1e293b, #334155);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
            border: 1px dashed rgba(255, 255, 255, 0.2);
            font-size: 2.2rem;
        }

        .playlist-cover-placeholder span {
            font-size: 0.7rem;
            margin-top: 0.25rem;
            color: #64748b;
        }

        .input-spotifake {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 10px;
            color: #fff;
            padding: 0.65rem 0.9rem;
            width: 100%;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .input-spotifake:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: #0ea5e9;
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.25);
            color: #fff;
            outline: none;
        }

        .input-spotifake::placeholder {
            color: #64748b;
        }
    </style>
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
                <li><a href="javascript:void(0)" class="nav-link-custom" id="navCreatePlaylist" data-bs-toggle="modal" data-bs-target="#modalCreatePlaylist"><i class="bi bi-plus-square"></i><span>Buat Playlist</span></a></li>
            </ul>

            <div class="sidebar-heading">PLAYLISTS</div>
            <ul class="playlist-list" id="sidebarPlaylistList">
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
                        <input type="text" id="searchInput" placeholder="Cari di koleksi saya...">
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

                <!-- Header Bar Koleksi -->
                <div class="collection-hero-bar">
                    <div>
                        <h1>Koleksi Saya</h1>
                        <p>Semua playlist, artis favorit, dan album yang kamu kurasi ada di sini</p>
                    </div>
                    <button type="button" class="btn-new-playlist" id="btnBuatPlaylistBaru" data-bs-toggle="modal" data-bs-target="#modalCreatePlaylist">
                        <i class="bi bi-plus-lg"></i> Buat Playlist Baru
                    </button>
                </div>

                <!-- Filter Chips Kategori (Bisa Ditekan & Berganti Tampilan) -->
                <div class="genre-chips-wrapper">
                    <a href="javascript:void(0)" class="chip-btn active" data-tab="semua">Semua</a>
                    <a href="javascript:void(0)" class="chip-btn" data-tab="playlist">Playlist Saya</a>
                    <a href="javascript:void(0)" class="chip-btn" data-tab="artis">Artis Diikuti</a>
                    <a href="javascript:void(0)" class="chip-btn" data-tab="album">Album Tersimpan</a>
                </div>

                <!-- Shortcut Kartu Lagu yang Disukai (Muncul pada tab 'Semua' dan 'Playlist') -->
                <div id="likedSectionWrapper">
                    <a href="lagu-disukai.php" class="liked-shortcut-card">
                        <div class="liked-shortcut-left">
                            <div class="liked-icon-circle">
                                <i class="bi bi-heart-fill"></i>
                            </div>
                            <div>
                                <h3 class="liked-shortcut-title">Lagu yang Disukai</h3>
                                <p class="liked-shortcut-sub">128 lagu favorit tersimpan di perpustakaanmu</p>
                            </div>
                        </div>
                        <div class="liked-shortcut-arrow">
                            <i class="bi bi-chevron-right"></i>
                        </div>
                    </a>
                </div>

                <!-- ==================== BAGIAN 1: PLAYLIST SAYA ==================== -->
                <section class="dashboard-section tab-content-section" id="sectionPlaylist">
                    <div class="section-header-row mb-3">
                        <h2 class="section-main-title" style="font-size: 1.25rem;">Playlist Buatanmu</h2>
                        <span class="text-muted small" id="playlistCountText"><?= count($myPlaylists); ?> playlist</span>
                    </div>

                    <div class="collection-grid" id="playlistCardsGrid">
                        <?php foreach ($myPlaylists as $pl): ?>
                            <div class="collection-card playlist-item" data-title="<?= strtolower(htmlspecialchars($pl['name'])); ?>" onclick="location.href='detail-playlist.php?playlist=<?= urlencode($pl['slug']); ?>'">
                                <div class="collection-img-wrapper">
                                    <img src="<?= htmlspecialchars($pl['cover']); ?>" alt="<?= htmlspecialchars($pl['name']); ?>" class="collection-img">
                                    <button class="card-play-btn play-trigger" data-track="<?= htmlspecialchars($pl['sample_track']); ?>" data-artist="<?= htmlspecialchars($pl['sample_artist']); ?>" data-duration="<?= htmlspecialchars($pl['sample_duration']); ?>" data-img="<?= htmlspecialchars($pl['cover']); ?>" title="Putar <?= htmlspecialchars($pl['name']); ?>" onclick="event.stopPropagation();">
                                        <i class="bi bi-play-fill"></i>
                                    </button>
                                </div>
                                <div class="collection-title"><?= htmlspecialchars($pl['name']); ?></div>
                                <div class="collection-desc"><?= htmlspecialchars($pl['desc']); ?> &bull; <?= $pl['songs']; ?> lagu</div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>

                <!-- ==================== BAGIAN 2: ARTIS YANG DIIKUTI ==================== -->
                <section class="dashboard-section tab-content-section" id="sectionArtis">
                    <div class="section-header-row mb-3">
                        <h2 class="section-main-title" style="font-size: 1.25rem;">Artis yang Diikuti</h2>
                        <span class="text-muted small"><?= count($followedArtists); ?> artis</span>
                    </div>

                    <div class="collection-grid" id="artistCardsGrid">
                        <?php foreach ($followedArtists as $art): ?>
                            <div class="artist-card artist-item" data-title="<?= strtolower(htmlspecialchars($art['name'])); ?>">
                                <div class="artist-avatar-wrap">
                                    <img src="<?= htmlspecialchars($art['avatar']); ?>" alt="<?= htmlspecialchars($art['name']); ?>" class="artist-avatar-img">
                                    <button class="artist-play-btn play-trigger" data-track="<?= htmlspecialchars($art['sample_track']); ?>" data-artist="<?= htmlspecialchars($art['name']); ?>" data-duration="<?= htmlspecialchars($art['duration']); ?>" data-img="<?= htmlspecialchars($art['avatar']); ?>" title="Putar Musik <?= htmlspecialchars($art['name']); ?>" onclick="event.stopPropagation();">
                                        <i class="bi bi-play-fill"></i>
                                    </button>
                                </div>
                                <div class="artist-card-name"><?= htmlspecialchars($art['name']); ?></div>
                                <div class="artist-card-genre"><?= htmlspecialchars($art['genre']); ?></div>
                                <div class="artist-card-listeners"><?= htmlspecialchars($art['monthly_listeners']); ?></div>
                                <button class="btn-follow-toggle following" onclick="event.stopPropagation(); toggleFollowArtist(this, '<?= htmlspecialchars($art['name']); ?>')">
                                    <i class="bi bi-check2 me-1"></i> Mengikuti
                                </button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>

                <!-- ==================== BAGIAN 3: ALBUM TERSIMPAN ==================== -->
                <section class="dashboard-section tab-content-section" id="sectionAlbum">
                    <div class="section-header-row mb-3">
                        <h2 class="section-main-title" style="font-size: 1.25rem;">Album Tersimpan</h2>
                        <span class="text-muted small"><?= count($savedAlbums); ?> album</span>
                    </div>

                    <div class="collection-grid" id="albumCardsGrid">
                        <?php foreach ($savedAlbums as $alb): ?>
                            <div class="collection-card album-item" data-title="<?= strtolower(htmlspecialchars($alb['title'])); ?> <?= strtolower(htmlspecialchars($alb['artist'])); ?>" onclick="showToast('Membuka album: <?= htmlspecialchars($alb['title']); ?>');">
                                <div class="collection-img-wrapper">
                                    <img src="<?= htmlspecialchars($alb['cover']); ?>" alt="<?= htmlspecialchars($alb['title']); ?>" class="collection-img">
                                    <button class="card-play-btn play-trigger" data-track="<?= htmlspecialchars($alb['sample_track']); ?>" data-artist="<?= htmlspecialchars($alb['artist']); ?>" data-duration="<?= htmlspecialchars($alb['duration']); ?>" data-img="<?= htmlspecialchars($alb['cover']); ?>" title="Putar Album <?= htmlspecialchars($alb['title']); ?>" onclick="event.stopPropagation();">
                                        <i class="bi bi-play-fill"></i>
                                    </button>
                                </div>
                                <div class="collection-title"><?= htmlspecialchars($alb['title']); ?></div>
                                <div class="collection-desc"><?= htmlspecialchars($alb['artist']); ?> &bull; <?= htmlspecialchars($alb['year']); ?> &bull; <?= htmlspecialchars($alb['tracks_count']); ?></div>
                            </div>
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

    <!-- ==================== MODAL BUAT PLAYLIST (SPOTIFY STYLE - DIRECT CHILD OF BODY) ==================== -->
    <div class="modal fade modal-spotifake" id="modalCreatePlaylist" tabindex="-1" aria-labelledby="modalCreatePlaylistLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreatePlaylistLabel"><i class="bi bi-music-note-list text-info me-2"></i>Buat Playlist Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formCreatePlaylist">
                    <div class="modal-body">
                        <div class="playlist-modal-grid">
                            <div class="playlist-cover-placeholder">
                                <i class="bi bi-music-note-beamed"></i>
                                <span>Cover Otomatis</span>
                            </div>
                            <div>
                                <div class="mb-3">
                                    <label for="inputPlaylistName" class="form-label text-secondary small fw-bold">Nama Playlist</label>
                                    <input type="text" class="input-spotifake" id="inputPlaylistName" placeholder="Misal: Night Drive Chill #1" required autofocus>
                                </div>
                                <div>
                                    <label for="inputPlaylistDesc" class="form-label text-secondary small fw-bold">Deskripsi (Opsional)</label>
                                    <textarea class="input-spotifake" id="inputPlaylistDesc" rows="3" placeholder="Beri sedikit cerita tentang playlist ini..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary text-white btn-sm px-3 rounded-pill" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary btn-sm px-4 rounded-pill fw-bold" style="background: #0ea5e9; border: none;">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Modular JS -->
    <script src="../assets/js/pengguna/player.js"></script>
    <script src="../assets/js/pengguna/playlist.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // 1. Inisialisasi Modal Buat Playlist
            const createModalEl = document.getElementById('modalCreatePlaylist');
            let createModal = null;
            if (createModalEl && typeof bootstrap !== 'undefined') {
                createModal = new bootstrap.Modal(createModalEl);
            }
            const btnHeaderCreate = document.getElementById('btnBuatPlaylistBaru');
            const navCreate = document.getElementById('navCreatePlaylist');
            const formCreate = document.getElementById('formCreatePlaylist');
            const inputName = document.getElementById('inputPlaylistName');
            const inputDesc = document.getElementById('inputPlaylistDesc');

            function openCreateModal(e) {
                if (e) e.preventDefault();
                if (inputName) inputName.value = '';
                if (inputDesc) inputDesc.value = '';
                if (createModal) {
                    createModal.show();
                } else if (createModalEl && typeof bootstrap !== 'undefined') {
                    createModal = new bootstrap.Modal(createModalEl);
                    createModal.show();
                }
            }

            if (btnHeaderCreate) btnHeaderCreate.addEventListener('click', openCreateModal);
            if (navCreate) navCreate.addEventListener('click', openCreateModal);

            // Buka modal otomatis jika datang dengan ?action=create
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('action') === 'create') {
                setTimeout(openCreateModal, 200);
            }

            // Fungsi render playlist kustom dari LocalStorage
            function renderCustomPlaylists() {
                try {
                    const saved = JSON.parse(localStorage.getItem('spotifake_custom_playlists') || '[]');
                    const grid = document.getElementById('playlistCardsGrid');
                    const sidebarList = document.getElementById('sidebarPlaylistList');
                    if (!grid || !Array.isArray(saved)) return;

                    saved.forEach(pl => {
                        const targetUrl = `detail-playlist.php?playlist=${encodeURIComponent(pl.slug)}&title=${encodeURIComponent(pl.name)}&desc=${encodeURIComponent(pl.desc)}&creator=${encodeURIComponent('<?= htmlspecialchars($userName); ?>')}`;

                        const newCard = document.createElement('div');
                        newCard.className = 'collection-card playlist-item';
                        newCard.setAttribute('data-title', pl.name.toLowerCase());
                        newCard.onclick = () => location.href = targetUrl;
                        newCard.innerHTML = `
                            <div class="collection-img-wrapper">
                                <img src="${pl.cover}" class="collection-img" alt="${pl.name}">
                                <button class="card-play-btn play-trigger" data-track="${pl.name}" data-artist="<?= htmlspecialchars($userName); ?>" data-duration="03:00" data-img="${pl.cover}" title="Putar" onclick="event.stopPropagation();">
                                    <i class="bi bi-play-fill"></i>
                                </button>
                            </div>
                            <div class="collection-title">${pl.name}</div>
                            <div class="collection-desc">${pl.desc} &bull; ${pl.songs || 0} lagu</div>
                        `;
                        grid.prepend(newCard);

                        if (sidebarList) {
                            const newLi = document.createElement('li');
                            newLi.innerHTML = `<a href="${targetUrl}" class="playlist-link text-info">${pl.name}</a>`;
                            sidebarList.prepend(newLi);
                        }
                    });
                } catch (err) {
                    console.error('Gagal memuat playlist tersimpan:', err);
                }
            }
            renderCustomPlaylists();

            // 2. Submit Form Buat Playlist
            if (formCreate) {
                formCreate.addEventListener('submit', (e) => {
                    e.preventDefault();
                    const name = inputName.value.trim();
                    const desc = inputDesc.value.trim() || 'Dibuat oleh <?= htmlspecialchars($userName); ?>';

                    if (!name) return;

                    const grid = document.getElementById('playlistCardsGrid');
                    const slug = name.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
                    const targetUrl = `detail-playlist.php?playlist=${encodeURIComponent(slug || 'playlist-baru')}&title=${encodeURIComponent(name)}&desc=${encodeURIComponent(desc)}&creator=${encodeURIComponent('<?= htmlspecialchars($userName); ?>')}`;
                    const coverUrl = 'https://images.unsplash.com/photo-1518709268805-4e9042af9f23?q=80&w=400&auto=format&fit=crop';

                    // Simpan ke LocalStorage agar tersimpan persisten
                    try {
                        const saved = JSON.parse(localStorage.getItem('spotifake_custom_playlists') || '[]');
                        saved.unshift({
                            name: name,
                            desc: desc,
                            slug: slug || 'playlist-baru',
                            cover: coverUrl,
                            songs: 0
                        });
                        localStorage.setItem('spotifake_custom_playlists', JSON.stringify(saved));
                    } catch (err) {
                        console.error('Gagal menyimpan playlist ke LocalStorage:', err);
                    }

                    // Buat card playlist baru di UI
                    const newCard = document.createElement('div');
                    newCard.className = 'collection-card playlist-item';
                    newCard.setAttribute('data-title', name.toLowerCase());
                    newCard.onclick = () => location.href = targetUrl;
                    newCard.innerHTML = `
                        <div class="collection-img-wrapper">
                            <img src="${coverUrl}" class="collection-img" alt="${name}">
                            <button class="card-play-btn play-trigger" data-track="${name}" data-artist="<?= htmlspecialchars($userName); ?>" data-duration="03:00" data-img="${coverUrl}" title="Putar" onclick="event.stopPropagation();">
                                <i class="bi bi-play-fill"></i>
                            </button>
                        </div>
                        <div class="collection-title">${name}</div>
                        <div class="collection-desc">${desc} &bull; 0 lagu</div>
                    `;

                    grid.prepend(newCard);

                    // Tambahkan juga ke sidebar
                    const sidebarList = document.getElementById('sidebarPlaylistList');
                    if (sidebarList) {
                        const newLi = document.createElement('li');
                        newLi.innerHTML = `<a href="${targetUrl}" class="playlist-link text-info">${name}</a>`;
                        sidebarList.prepend(newLi);
                    }

                    // Re-bind click event untuk play button baru
                    const newPlayBtn = newCard.querySelector('.play-trigger');
                    if (newPlayBtn) {
                        newPlayBtn.addEventListener('click', (ev) => {
                            ev.preventDefault();
                            ev.stopPropagation();
                            const track = newPlayBtn.getAttribute('data-track');
                            const artist = newPlayBtn.getAttribute('data-artist');
                            const duration = newPlayBtn.getAttribute('data-duration');
                            const img = newPlayBtn.getAttribute('data-img');
                            if (typeof playTrack === 'function') {
                                playTrack(track, artist, duration, img);
                            } else {
                                showToast(`Memutar: ${track}`);
                            }
                        });
                    }

                    if (createModal) {
                        createModal.hide();
                    } else if (typeof bootstrap !== 'undefined') {
                        const bsModal = bootstrap.Modal.getInstance(createModalEl);
                        if (bsModal) bsModal.hide();
                    }

                    showToast(`Playlist "${name}" berhasil dibuat! 🎵`);

                    // Arahkan otomatis ke halaman playlist baru
                    setTimeout(() => {
                        window.location.href = targetUrl;
                    }, 500);
                });
            }

            // 3. Tab Switching Interaktif (Semua, Playlist Saya, Artis Diikuti, Album Tersimpan)
            const chips = document.querySelectorAll('.chip-btn');
            const secPlaylist = document.getElementById('sectionPlaylist');
            const secArtis = document.getElementById('sectionArtis');
            const secAlbum = document.getElementById('sectionAlbum');
            const likedWrap = document.getElementById('likedSectionWrapper');

            function switchTab(tabName) {
                chips.forEach(c => c.classList.remove('active'));
                const activeBtn = document.querySelector(`.chip-btn[data-tab="${tabName}"]`);
                if (activeBtn) activeBtn.classList.add('active');

                if (tabName === 'semua') {
                    secPlaylist.style.display = '';
                    secArtis.style.display = '';
                    secAlbum.style.display = '';
                    likedWrap.style.display = '';
                    showToast('Menampilkan: Semua Koleksi');
                } else if (tabName === 'playlist') {
                    secPlaylist.style.display = '';
                    secArtis.style.display = 'none';
                    secAlbum.style.display = 'none';
                    likedWrap.style.display = '';
                    showToast('Menampilkan: Playlist Saya');
                } else if (tabName === 'artis') {
                    secPlaylist.style.display = 'none';
                    secArtis.style.display = '';
                    secAlbum.style.display = 'none';
                    likedWrap.style.display = 'none';
                    showToast('Menampilkan: Artis yang Diikuti');
                } else if (tabName === 'album') {
                    secPlaylist.style.display = 'none';
                    secArtis.style.display = 'none';
                    secAlbum.style.display = '';
                    likedWrap.style.display = 'none';
                    showToast('Menampilkan: Album Tersimpan');
                }
            }

            chips.forEach(chip => {
                chip.addEventListener('click', () => {
                    const tab = chip.getAttribute('data-tab');
                    switchTab(tab);
                });
            });

            // 4. Pencarian Real-Time (Mencari di semua item yang sedang aktif)
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.addEventListener('input', (e) => {
                    const q = e.target.value.toLowerCase().trim();
                    const allItems = document.querySelectorAll('.playlist-item, .artist-item, .album-item');
                    allItems.forEach(item => {
                        const title = item.getAttribute('data-title') || '';
                        if (title.includes(q) || q === '') {
                            item.style.display = '';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            }
        });

        // Toggle Mengikuti / Berhenti Mengikuti Artis
        function toggleFollowArtist(btn, artistName) {
            if (btn.classList.contains('following')) {
                btn.classList.remove('following');
                btn.innerHTML = '<i class="bi bi-plus-lg me-1"></i> Ikuti';
                showToast(`Berhenti mengikuti ${artistName}`);
            } else {
                btn.classList.add('following');
                btn.innerHTML = '<i class="bi bi-check2 me-1"></i> Mengikuti';
                showToast(`Mengikuti ${artistName} ✨`);
            }
        }
    </script>
</body>

</html>