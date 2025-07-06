<?php
header("Content-Type: application/json");
include 'koneksi.php';

$sql = "SELECT * FROM lansia";
$result = $koneksi->query($sql);

$data = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode(["status" => "success", "data" => $data]);
} else {
    echo json_encode(["status" => "empty", "message" => "Tidak ada data lansia"]);
}
