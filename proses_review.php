<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'koneksi.php';
date_default_timezone_set('Asia/Jakarta');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Akses tidak valid.');
}

$menu_id   = intval($_POST['menu_id'] ?? 0);
$user_id   = intval($_POST['user_id'] ?? 0);
$rating    = intval($_POST['rating'] ?? 0);
$komentar  = trim($_POST['komentar'] ?? '');
$tanggal   = date('Y-m-d H:i:s');

if ($menu_id <= 0 || $rating < 1 || $rating > 5) {
    die('Data tidak valid.');
}

if ($komentar === '') $komentar = 'Tidak ada komentar.';

$stmt = $conn->prepare("INSERT INTO reviews (menu_id, user_id, rating, komentar, tanggal, created_at)
                        VALUES (?, ?, ?, ?, ?, NOW())");
$stmt->bind_param("iiiss", $menu_id, $user_id, $rating, $komentar, $tanggal);

if ($stmt->execute()) {
    header("Location: review.php?sukses=1");
    exit;
} else {
    echo "Gagal menyimpan review: " . $conn->error;
}
?>
