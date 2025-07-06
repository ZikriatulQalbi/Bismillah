<?php
header("Content-Type: application/json");
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    $alamat = $_POST['alamat'];

    if (!$nama || !$umur || !$alamat) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap']);
        exit;
    }

    $query = mysqli_query($koneksi, "INSERT INTO lansia (nama, umur, alamat) VALUES ('$nama', '$umur', '$alamat')");

    if ($query) {
        echo json_encode(['status' => 'success', 'message' => 'Lansia berhasil ditambahkan']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan ke database']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Metode tidak diizinkan']);
}
