<?php
session_start();
include 'koneksi.php';

$user_id  = $_SESSION['user_id'] ?? 0;
$lat      = $_POST['latitude']  ?? null;
$lon      = $_POST['longitude'] ?? null;

if ($user_id && $lat && $lon) {
    $stmt = $conn->prepare(
        "INSERT INTO locations_log (user_id, latitude, longitude, waktu)
         VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("idd", $user_id, $lat, $lon);
    $stmt->execute();
    echo 'OK';
} else {
    http_response_code(400);
    echo 'Bad Request';
}
?>
