<?php
date_default_timezone_set("Asia/Jakarta");
$host = 'mysql';              // Sesuai nama service di docker-compose
$user = 'lansia';             // Username dari MYSQL_USER
$pass = 'lansia321';          // Password dari MYSQL_PASSWORD
$db   = 'db_lansia';          // Database dari MYSQL_DATABASE

$koneksi = new mysqli($host, $user, $pass, $db);
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
