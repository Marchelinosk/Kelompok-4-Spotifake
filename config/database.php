<?php
$host = 'localhost';
$dbname = 'spotifake_db'; // <--- Sesuaikan dengan nama database yang kamu buat
$username = 'root'; // Default XAMPP/Laragon biasanya 'root'
$password = ''; // Default XAMPP/Laragon biasanya kosong (tidak ada password)

try {
    // Membuat koneksi PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set mode error PDO ke exception agar mudah proses debug
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Set default fetch mode ke array asosiatif
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}
?>