<?php

// Konfigurasi Bot Telegram
$botToken = "7892364006:AAGPraavraQgz4GlKVgU_-sWM8eUMyNG9QY";      // Ganti dengan token bot kamu dari BotFather
$chatId   = "1292858444";        // Ganti dengan chat ID yang menerima notifikasi

// Ambil body JSON dari POST
$data = json_decode(file_get_contents("php://input"), true);
$pesan = $data['pesan'] ?? 'Tidak ada pesan dikirim';

// Endpoint Telegram API
$url = "https://api.telegram.org/bot$botToken/sendMessage";

// Parameter request
$params = [
    'chat_id' => $chatId,
    'text'    => $pesan
];

// Kirim request ke Telegram
$options = [
    'http' => [
        'method'  => 'POST',
        'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
        'content' => http_build_query($params)
    ]
];

$context  = stream_context_create($options);
$response = file_get_contents($url, false, $context);

// Tampilkan hasil
if ($response) {
    echo json_encode(["status" => "success", "message" => "Notifikasi Telegram terkirim"]);
} else {
    echo json_encode(["status" => "error", "message" => "Gagal mengirim notifikasi"]);
}
