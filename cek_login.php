<?php
session_start();

// Contoh koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "makanapaya");

// Ambil data dari form
$username = $_POST['username'];
$password = $_POST['password'];

// Cek ke database
$query = "SELECT * FROM users WHERE username='$username'";
$result = $koneksi->query($query);

if ($result->num_rows === 1) {
  $data = $result->fetch_assoc();
  if (password_verify($password, $data['password'])) {
  $_SESSION['user_id']  = $data['id']; // ✅ Tambahkan ini!
  $_SESSION['username'] = $data['username'];
  $_SESSION['role']     = $data['role'];
  header("Location: dashboard.php");
  exit();
  } else {
    echo "<script>alert('Password salah'); window.location='login.php';</script>";
  }
} else {
  echo "<script>alert('Username tidak ditemukan'); window.location='login.php';</script>";
}
?>
