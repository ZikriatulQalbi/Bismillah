<?php
include 'koneksi.php';

header('Content-Type: application/json');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id == 0) {
    echo json_encode([]);
    exit;
}

$sql = "SELECT id, id_lansia, event AS status, waktu FROM fall_event WHERE id_lansia = $id ORDER BY waktu DESC";
$result = $koneksi->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
