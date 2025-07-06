<?php
header("Content-Type: application/json");
include 'koneksi.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id === 0) {
    echo json_encode(["status" => "error", "message" => "ID tidak valid"]);
    exit;
}

// Ambil data jatuh
$fallQuery = "SELECT id, 'jatuh' AS tipe, waktu, NULL AS status_zona FROM fall_event WHERE id_lansia = $id";
$fallResult = $koneksiJatuh->query($fallQuery);
$fallData = [];
while ($row = $fallResult->fetch_assoc()) {
    $fallData[] = $row;
}

// Ambil data zona
$zonaQuery = "SELECT id, 'zona' AS tipe, waktu, status_zona FROM tracking WHERE id_lansia = $id AND status_zona IS NOT NULL";
$zonaResult = $koneksiTracking->query($zonaQuery);
$zonaData = [];
while ($row = $zonaResult->fetch_assoc()) {
    $zonaData[] = $row;
}

// Gabungkan dan urutkan berdasarkan waktu DESC
$combined = array_merge($fallData, $zonaData);
usort($combined, function ($a, $b) {
    return strtotime($b['waktu']) - strtotime($a['waktu']);
});

echo json_encode(["status" => "success", "data" => $combined]);
