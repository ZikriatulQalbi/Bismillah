<?php
include 'koneksi.php';

header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    echo json_encode(['status' => 'error', 'message' => 'ID tidak ditemukan']);
    exit;
}

$id = intval($_GET['id']);

$sql = "SELECT * FROM tracking WHERE id_lansia = $id ORDER BY waktu DESC LIMIT 1";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    echo json_encode(['status' => 'success', 'data' => $data]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
}
