<?php
include 'koneksi.php';

// Tampilkan error (debugging saat pengembangan)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Pastikan request method adalah POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data JSON dari body
    $data = json_decode(file_get_contents("php://input"), true);

    // Validasi input wajib
    if (!isset($data['id_lansia'])) {
        echo json_encode([
            "status" => "error",
            "message" => "id_lansia tidak ditemukan dalam request"
        ]);
        exit;
    }

    // Ambil nilai
    $id_lansia = $data['id_lansia'];
    $event = $data['event'] ?? 'jatuh'; // default: jatuh
    $waktu = $data['waktu'] ?? date('Y-m-d H:i:s'); // jika tidak dikirim, ambil waktu sekarang

    // Simpan ke database
    $sql = "INSERT INTO fall_event (id_lansia, event, waktu) 
            VALUES ('$id_lansia', '$event', '$waktu')";

    if ($koneksi->query($sql)) {
        // Kirim notifikasi ke Telegram via microservice notifikasi
        $pesan = [
            // 'pesan' => "🚨 Lansia ID $id_lansia terdeteksi JATUH pada $waktu"
            'pesan' => " JATUH TERDETEKSI 🚨"
        ];

        file_get_contents("http://api-notification/send_telegram.php", false, stream_context_create([
            'http' => [
                'method'  => 'POST',
                'header'  => 'Content-Type: application/json',
                'content' => json_encode($pesan)
            ]
        ]));

        echo json_encode(["status" => "success", "message" => "Data jatuh berhasil disimpan"]);
    } else {
        echo json_encode(["status" => "error", "message" => $koneksi->error]);
    }
} else {
    echo json_encode([
        "status" => "invalid",
        "message" => "Gunakan metode POST"
    ]);
}
