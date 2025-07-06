<?php
header("Content-Type: application/json");
include 'koneksi.php'; // atau sesuaikan path-nya

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_lansia'];

    $query = mysqli_query($koneksi, "SELECT * FROM lansia WHERE id_lansia = '$id'");
    if ($row = mysqli_fetch_assoc($query)) {
        echo json_encode($row);
    } else {
        echo json_encode(["status" => "error", "message" => "Data tidak ditemukan"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Metode tidak diizinkan"]);
}
