<?php
$koneksi = new mysqli("localhost", "root", "", "makanapaya");

$errors = [];
$sukses = "";

// Proses form ketika disubmit
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $konfirmasi = $_POST['konfirmasi'];

  // Validasi
  if ($password !== $konfirmasi) {
    $errors[] = "Konfirmasi password tidak cocok.";
  }

  // Cek apakah username/email sudah ada
  $cek = $koneksi->query("SELECT * FROM users WHERE username='$username' OR email='$email'");
  if ($cek->num_rows > 0) {
    $errors[] = "Username atau email sudah digunakan.";
  }

  // Jika tidak ada error
  if (empty($errors)) {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $simpan = $koneksi->query("INSERT INTO users (nama, email, username, password, role) VALUES ('$nama', '$email', '$username', '$hash', 'user')");

    if ($simpan) {
      $sukses = "Registrasi berhasil! Silakan login.";
    } else {
      $errors[] = "Gagal menyimpan ke database.";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register - MakanApaYa</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-pink-50 flex items-center justify-center min-h-screen font-sans">

  <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-lg border border-pink-200">
    <div class="text-center mb-6">
      <div class="bg-pink-500 text-white w-14 h-14 mx-auto flex items-center justify-center rounded-full text-2xl font-bold shadow-md">
        🍱
      </div>
      <h1 class="text-2xl font-bold text-pink-600 mt-4">Daftar Akun Baru</h1>
      <p class="text-gray-600">Yuk gabung untuk mulai kasih review makanan favoritmu!</p>
    </div>

    <!-- Tampilkan pesan -->
    <?php if (!empty($errors)): ?>
      <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
        <ul class="list-disc ml-5">
          <?php foreach ($errors as $e) echo "<li>$e</li>"; ?>
        </ul>
      </div>
    <?php elseif ($sukses): ?>
      <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-sm text-center">
        <?= $sukses ?>
        <br><a href="login.php" class="underline text-green-800">Login di sini</a>
      </div>
    <?php endif; ?>

    <!-- Form Register -->
    <form action="" method="POST" class="space-y-4">
      <div>
        <label class="block mb-1 font-semibold text-sm">Nama Lengkap</label>
        <input type="text" name="nama" required class="w-full px-4 py-2 border border-pink-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400">
      </div>
      <div>
        <label class="block mb-1 font-semibold text-sm">Email</label>
        <input type="email" name="email" required class="w-full px-4 py-2 border border-pink-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400">
      </div>
      <div>
        <label class="block mb-1 font-semibold text-sm">Username</label>
        <input type="text" name="username" required class="w-full px-4 py-2 border border-pink-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400">
      </div>
      <div>
        <label class="block mb-1 font-semibold text-sm">Password</label>
        <input type="password" name="password" required class="w-full px-4 py-2 border border-pink-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400">
      </div>
      <div>
        <label class="block mb-1 font-semibold text-sm">Konfirmasi Password</label>
        <input type="password" name="konfirmasi" required class="w-full px-4 py-2 border border-pink-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400">
      </div>

      <button type="submit" class="w-full bg-pink-500 text-white font-semibold py-2 rounded-full hover:bg-pink-600 transition">Daftar Sekarang</button>
    </form>

    <p class="text-sm text-center text-gray-500 mt-6">
      Sudah punya akun? <a href="login.php" class="text-pink-600 hover:underline">Login di sini</a>
    </p>
  </div>

</body>
</html>
