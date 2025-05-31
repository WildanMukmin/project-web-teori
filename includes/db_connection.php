<?php
define('DB_SERVER', 'localhost',); // Ganti jika database Anda di server lain
define('DB_USERNAME', 'root');   // Ganti dengan username database Anda
define('DB_PASSWORD', '');       // Ganti dengan password database Anda
define('DB_NAME', 'perpustakaan_db');

// Buat koneksi
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}
?>