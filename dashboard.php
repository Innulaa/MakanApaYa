<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>MakanApaYa - Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#FFF6EB] text-gray-800">

  <!-- Header -->
  <header class="bg-white py-4 px-6 shadow flex justify-between items-center fixed top-0 w-full z-40">
    <div class="flex items-center space-x-4">
      <?php include 'sidebar.php'; ?>
      <h1 class="text-2xl font-bold text-pink-700 ml-4">MakanApaYa 🍽</h1>
    </div>
    <p class="text-pink-700 font-bold">
      SELAMAT DATANG, <span class="font-bold"><?php echo htmlspecialchars($username); ?></span> 👋
    </p>
  </header>

  <!-- Main content -->
  <main class="ml-0 transition-all duration-300 pt-24 px-6">
    
    <!-- Hero Section -->
    <section class="py-12">
      <div class="max-w-7xl mx-auto md:flex items-center justify-between">
        <div class="md:w-1/2 mb-8 md:mb-0">
          <h1 class="text-4xl font-bold text-gray-800 mb-4">Cari Makan Enak di Kantin?</h1>
          <p class="text-gray-700">Review jujur dari mahasiswa untuk mahasiswa. Cek rekomendasi & kasih penilaianmu!</p>
        </div>
        <div class="md:w-1/2 flex justify-center">
          <img src="makan.jpg" alt="Gambar Makanan" class="w-64 h-64 object-cover rounded-full shadow-lg border-4 border-white" />
        </div>
      </div>
    </section>

    <!-- Tenant Favorit -->
    <section class="bg-white py-12 px-6 rounded-xl shadow-md">
      <h2 class="text-2xl font-bold text-center mb-8">Rekomendasi Makanan Terlaris Se FMIPA UNILA</h2>
      <div class="flex overflow-x-auto space-x-4 pb-4">
        <div class="min-w-[200px] bg-pink-100 p-4 rounded-xl shadow text-center">
          <img src="naspad.jpeg" class="w-full h-32 object-cover rounded-md mb-2" />
          <h3 class="font-semibold">Nasi Padang Uni Rahayu</h3>
          <p class="text-sm text-gray-600">⭐ 4.9</p>
        </div>
        <div class="min-w-[200px] bg-yellow-100 p-4 rounded-xl shadow text-center">
          <img src="mieayam.jpeg" class="w-full h-32 object-cover rounded-md mb-2" />
          <h3 class="font-semibold">Mie Ayam Mbak Anin</h3>
          <p class="text-sm text-gray-600">⭐ 4.9</p>
        </div>
        <div class="min-w-[200px] bg-blue-200 p-4 rounded-xl shadow text-center">
          <img src="seblak.jpeg" class="w-full h-32 object-cover rounded-md mb-2" />
          <h3 class="font-semibold">Seblak TehIntan</h3>
          <p class="text-sm text-gray-600">⭐ 4.9</p>
        </div>
      </div>
      <div class="mt-4 text-center">
        <a href="tenant_kantin.php" class="text-blue-600 font-semibold hover:underline">Lihat Semua Tenant →</a>
      </div>
    </section>

    <!-- Voting -->
    <section class="bg-pink-100 px-6 py-12 text-center my-6 mx-4 rounded-xl">
      <h3 class="text-xl font-semibold mb-2">Voting Menu Terenak Mingguan</h3>
      <p class="text-gray-700 mb-4">Yuk ikut voting menu terenak minggu ini & bantu teman kampus memilih makanan terbaik!</p>
      <a href="voting.php" class="bg-pink-500 text-white px-5 py-2 rounded-full hover:bg-pink-600">Vote Sekarang</a>
    </section>

  
  </main>

  <!-- Footer -->
  <footer class="bg-gray-100 py-8 text-center text-sm text-gray-500 mt-10">
    <p>© 2025 MakanApaYa. Dibuat oleh Kelompok Lima ❤️</p>
  </footer>

</body>
</html>
