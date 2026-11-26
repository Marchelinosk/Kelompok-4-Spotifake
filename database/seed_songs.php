<?php
require_once '../config/database.php';

$keywords = ['Hindia', 'Pamungkas', 'Nadin Amizah', 'Feast', 'Tulus', 'Lofi Beats'];
$totalInserted = 0;

$checkStmt = $pdo->prepare("SELECT COUNT(*) FROM songs WHERE title = ? AND artist = ?");
$insertStmt = $pdo->prepare("
    INSERT INTO songs (title, artist, album, genre, duration, file_path) 
    VALUES (?, ?, ?, ?, ?, ?)
");

foreach ($keywords as $keyword) {
    $url = "https://itunes.apple.com/search?term=" . urlencode($keyword) . "&entity=song&country=ID&limit=8";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);

    $data = json_decode($response, true);

    if (!empty($data['results'])) {
        foreach ($data['results'] as $item) {
            if (empty($item['previewUrl'])) continue;

            $title     = $item['trackName'];
            $artist    = $item['artistName'];
            $album     = $item['collectionName'] ?? 'Single';
            $genre     = $item['primaryGenreName'] ?? 'Pop';
            $duration  = (int) floor(($item['trackTimeMillis'] ?? 30000) / 1000);
            $file_path = $item['previewUrl'];

            $checkStmt->execute([$title, $artist]);
            if ($checkStmt->fetchColumn() == 0) {
                $insertStmt->execute([$title, $artist, $album, $genre, $duration, $file_path]);
                $totalInserted++;
            }
        }
    }
}

echo "<h3>Berhasil memasukkan {$totalInserted} lagu baru ke tabel songs!</h3>";