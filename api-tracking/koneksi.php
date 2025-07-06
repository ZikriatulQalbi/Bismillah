<?php
$host = 'mysql';
$user = 'lansia';
$pass = 'lansia321';
$db   = 'db_tracking';

$koneksi = new mysqli($host, $user, $pass, $db);
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
