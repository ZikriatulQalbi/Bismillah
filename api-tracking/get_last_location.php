<?php
include 'koneksi.php'; // atau 'koneksi.php' jika file ini di root

header('Content-Type: application/json');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id == 0) {
    echo json_encode(["error" => "id_lansia tidak valid"]);
    exit;
}

$sql = "SELECT latitude, longitude, waktu 
        FROM tracking 
        WHERE id_lansia = $id 
        ORDER BY waktu DESC 
        LIMIT 1";

$result = $koneksi->query($sql);

if ($result && $row = $result->fetch_assoc()) {
    echo json_encode($row);
} else {
    echo json_encode(["message" => "Data tidak ditemukan"]);
}
