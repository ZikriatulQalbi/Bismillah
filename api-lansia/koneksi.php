<?php
$host = "mysql";       // Nama service MySQL di docker-compose
$user = "lansia";      // User sesuai docker-compose
$pass = "lansia321";
$db   = "db_lansia";

$koneksi = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
