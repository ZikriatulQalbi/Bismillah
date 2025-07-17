<?php

// Ambil parameter lat dan lng dari URL
$lat = $_GET['lat'] ?? null;
$lng = $_GET['lng'] ?? null;

if (!$lat || !$lng) {
    echo json_encode(["error" => "Parameter lat dan lng wajib diisi"]);
    exit;
}

// URL Nominatim OpenStreetMap untuk reverse geocoding
$url = "https://nominatim.openstreetmap.org/reverse?lat=$lat&lon=$lng&format=json";

// Wajib: Tambahkan User-Agent agar tidak diblok
$options = [
    "http" => [
        "header" => "User-Agent: MyLansiaApp/1.0\r\n"
    ]
];
$context = stream_context_create($options);

// Ambil data dari API
$response = file_get_contents($url, false, $context);

// Cek apakah request berhasil
if ($response === FALSE) {
    echo json_encode(["error" => "Gagal mengambil data dari OSM"]);
    exit;
}

// Decode hasil JSON
$data = json_decode($response, true);

// Cek dan ambil hasil
if (isset($data['display_name'])) {
    echo json_encode([
        "alamat" => $data['display_name']
    ]);
} else {
    echo json_encode([
        "error" => "Alamat tidak ditemukan"
    ]);
}
