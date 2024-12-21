<?php
$host = "localhost"; // Server database
$username = "root";  // Username MySQL
$password = "";      // Password MySQL (biarkan kosong jika default)
$dbname = "festify-main"; // Nama database

// Koneksi ke database
$conn = new mysqli($host, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function url_dasar() {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'];
    $path = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    return $protocol . $host . $path;
}
?>
