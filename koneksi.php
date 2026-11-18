<?php
// NIM : 2500302054
// Nama : Naufal Basyirul Wafir Thoriq
// Pertemuan 10

$host = "localhost";
$username = "root";
$password = "";
$database = "db_perpustakaan";

$koneksi = mysqli_connect(
    $host,
    $username,
    $password,
    $database
);

if (!$koneksi) {
    die("Koneksi database gagal: " .
        htmlspecialchars(mysqli_connect_error()));
}

mysqli_set_charset($koneksi, "utf8mb4");
?>