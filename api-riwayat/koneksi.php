<?php
// Koneksi ke database db_jatuh
$koneksiJatuh = new mysqli("mysql", "lansia", "lansia321", "db_jatuh");
if ($koneksiJatuh->connect_error) {
    die("Koneksi ke db_jatuh gagal: " . $koneksiJatuh->connect_error);
}

// Koneksi ke database db_tracking
$koneksiTracking = new mysqli("mysql", "lansia", "lansia321", "db_tracking");
if ($koneksiTracking->connect_error) {
    die("Koneksi ke db_tracking gagal: " . $koneksiTracking->connect_error);
}
