<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil body JSON
    $data = json_decode(file_get_contents("php://input"), true);

    // Validasi input
    if (!isset($data['id_lansia']) || !isset($data['latitude']) || !isset($data['longitude']) || !isset($data['status_zona'])) {
        echo json_encode([
            "status" => "error",
            "message" => "id_lansia, latitude, longitude, dan status_zona wajib dikirim"
        ]);
        exit;
    }

    $id_lansia = $data['id_lansia'];
    $latitude = $data['latitude'];
    $longitude = $data['longitude'];
    $status_zona = $data['status_zona'];

    // Jika waktu tidak dikirim, pakai waktu sekarang
    $waktu = isset($data['waktu']) ? $data['waktu'] : date("Y-m-d H:i:s");

    // Simpan ke database
    $sql = "INSERT INTO tracking (id_lansia, latitude, longitude, waktu, status_zona)
            VALUES ('$id_lansia', '$latitude', '$longitude', '$waktu', '$status_zona')";

    if ($koneksi->query($sql)) {
        echo json_encode(["status" => "success", "message" => "Data tracking disimpan"]);
    } else {
        echo json_encode(["status" => "error", "message" => $koneksi->error]);
    }
} else {
    echo json_encode(["status" => "invalid", "message" => "Gunakan metode POST"]);
}
