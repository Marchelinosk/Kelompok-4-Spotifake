<?php
session_start();
require_once '../config/database.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Sesi habis, silakan login kembali.']);
    exit;
}

$id_user = (int) $_SESSION['user_id'];
$action  = $_POST['action'] ?? $_GET['action'] ?? '';

try {
    // 1. Toggle Like / Unlike Lagu (Tabel likes)
    if ($action === 'toggle_like') {
        $id_song = (int) ($_POST['id_song'] ?? 0);
        if ($id_song <= 0) {
            echo json_encode(['status' => 'error', 'message' => 'Pilih lagu terlebih dahulu.']);
            exit;
        }

        $check = $pdo->prepare("SELECT COUNT(*) FROM likes WHERE id_user = ? AND id_song = ?");
        $check->execute([$id_user, $id_song]);

        if ($check->fetchColumn() > 0) {
            $del = $pdo->prepare("DELETE FROM likes WHERE id_user = ? AND id_song = ?");
            $del->execute([$id_user, $id_song]);
            echo json_encode(['status' => 'success', 'liked' => false, 'message' => 'Dihapus dari Lagu Disukai']);
        } else {
            $ins = $pdo->prepare("INSERT INTO likes (id_user, id_song) VALUES (?, ?)");
            $ins->execute([$id_user, $id_song]);
            echo json_encode(['status' => 'success', 'liked' => true, 'message' => 'Ditambahkan ke Lagu Disukai ❤️']);
        }
        exit;
    }

    // 2. Buat Playlist / Koleksi Baru (Tabel playlists)
    if ($action === 'create_playlist') {
        $name = trim($_POST['playlist_name'] ?? '');
        $desc = trim($_POST['description'] ?? '');

        if ($name === '') {
            echo json_encode(['status' => 'error', 'message' => 'Nama koleksi tidak boleh kosong.']);
            exit;
        }

        $stmt = $pdo->prepare("INSERT INTO playlists (id_user, playlist_name, description) VALUES (?, ?, ?)");
        $stmt->execute([$id_user, $name, $desc]);
        $newId = $pdo->lastInsertId();

        echo json_encode([
            'status' => 'success',
            'id_playlist' => $newId,
            'playlist_name' => htmlspecialchars($name),
            'message' => "Koleksi \"{$name}\" berhasil dibuat! 🎵"
        ]);
        exit;
    }

    // 3. Tambahkan Lagu ke dalam Koleksi (Tabel playlist_songs)
    if ($action === 'add_to_playlist') {
        $id_playlist = (int) ($_POST['id_playlist'] ?? 0);
        $id_song     = (int) ($_POST['id_song'] ?? 0);

        if ($id_playlist <= 0 || $id_song <= 0) {
            echo json_encode(['status' => 'error', 'message' => 'Data koleksi atau lagu tidak valid.']);
            exit;
        }

        // Pastikan playlist milik user yang sedang login
        $ownerCheck = $pdo->prepare("SELECT playlist_name FROM playlists WHERE id_playlist = ? AND id_user = ?");
        $ownerCheck->execute([$id_playlist, $id_user]);
        $playlist = $ownerCheck->fetch(PDO::FETCH_ASSOC);

        if (!$playlist) {
            echo json_encode(['status' => 'error', 'message' => 'Koleksi tidak ditemukan.']);
            exit;
        }

        // Cek apakah lagu sudah ada di playlist tersebut
        $dupCheck = $pdo->prepare("SELECT COUNT(*) FROM playlist_songs WHERE id_playlist = ? AND id_song = ?");
        $dupCheck->execute([$id_playlist, $id_song]);

        if ($dupCheck->fetchColumn() > 0) {
            echo json_encode(['status' => 'info', 'message' => "Lagu sudah ada di koleksi \"{$playlist['playlist_name']}\"."]);
            exit;
        }

        $ins = $pdo->prepare("INSERT INTO playlist_songs (id_playlist, id_song) VALUES (?, ?)");
        $ins->execute([$id_playlist, $id_song]);

        echo json_encode([
            'status' => 'success',
            'message' => "Lagu ditambahkan ke koleksi \"{$playlist['playlist_name']}\" ✅"
        ]);
        exit;
    }

    // 4. Ambil Daftar Lagu dalam Satu Koleksi
    if ($action === 'get_playlist_songs') {
        $id_playlist = (int) ($_GET['id_playlist'] ?? 0);
        $stmt = $pdo->prepare("
            SELECT s.* 
            FROM songs s
            INNER JOIN playlist_songs ps ON s.id_song = ps.id_song
            INNER JOIN playlists p ON ps.id_playlist = p.id_playlist
            WHERE p.id_playlist = ? AND p.id_user = ?
            ORDER BY ps.added_at DESC
        ");
        $stmt->execute([$id_playlist, $id_user]);
        $songs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode(['status' => 'success', 'songs' => $songs]);
        exit;
    }

    // 5. Hapus Koleksi / Playlist (Tabel playlists & playlist_songs)
    if ($action === 'delete_playlist') {
        $id_playlist = (int) ($_POST['id_playlist'] ?? 0);
        if ($id_playlist <= 0) {
            echo json_encode(['status' => 'error', 'message' => 'ID koleksi tidak valid.']);
            exit;
        }

        $checkOwner = $pdo->prepare("SELECT playlist_name FROM playlists WHERE id_playlist = ? AND id_user = ?");
        $checkOwner->execute([$id_playlist, $id_user]);
        $pl = $checkOwner->fetch(PDO::FETCH_ASSOC);

        if (!$pl) {
            echo json_encode(['status' => 'error', 'message' => 'Koleksi tidak ditemukan.']);
            exit;
        }

        $pdo->prepare("DELETE FROM playlist_songs WHERE id_playlist = ?")->execute([$id_playlist]);
        $pdo->prepare("DELETE FROM playlists WHERE id_playlist = ? AND id_user = ?")->execute([$id_playlist, $id_user]);

        echo json_encode([
            'status' => 'success',
            'message' => "Koleksi \"{$pl['playlist_name']}\" berhasil dihapus 🗑️"
        ]);
        exit;
    }

    // 6. Hapus Lagu Tertentu dari Dalam Koleksi (Tabel playlist_songs)
    if ($action === 'remove_from_playlist') {
        $id_playlist = (int) ($_POST['id_playlist'] ?? 0);
        $id_song     = (int) ($_POST['id_song'] ?? 0);

        if ($id_playlist <= 0 || $id_song <= 0) {
            echo json_encode(['status' => 'error', 'message' => 'Data koleksi atau lagu tidak valid.']);
            exit;
        }

        $ownerCheck = $pdo->prepare("SELECT playlist_name FROM playlists WHERE id_playlist = ? AND id_user = ?");
        $ownerCheck->execute([$id_playlist, $id_user]);
        $playlist = $ownerCheck->fetch(PDO::FETCH_ASSOC);

        if (!$playlist) {
            echo json_encode(['status' => 'error', 'message' => 'Koleksi tidak ditemukan.']);
            exit;
        }

        $del = $pdo->prepare("DELETE FROM playlist_songs WHERE id_playlist = ? AND id_song = ?");
        $del->execute([$id_playlist, $id_song]);

        echo json_encode([
            'status' => 'success',
            'message' => "Lagu dihapus dari koleksi \"{$playlist['playlist_name']}\" 🗑️"
        ]);
        exit;
    }

    echo json_encode(['status' => 'error', 'message' => 'Aksi tidak dikenali.']);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Kesalahan database: ' . $e->getMessage()]);
}