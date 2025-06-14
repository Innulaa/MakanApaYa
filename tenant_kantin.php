<?php
include 'koneksi.php';
include 'sidebar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Daftar Tenant Kantin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

  <main class="ml-0 p-8 transition-all duration-300">
    <h1 class="text-2xl font-bold text-pink-500 mb-6 flex items-center gap-2">
      🍽️ Daftar Tenant Kantin
    </h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
      <?php
      $query = mysqli_query($conn, "SELECT * FROM tenant_kantin");
      while($row = mysqli_fetch_assoc($query)) {
        $gambar = !empty($row['gambar']) ? 'uploads/' . htmlspecialchars($row['gambar']) : 'uploads/mbok_darmi.jpg';

      ?>
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
          <img src="<?= $gambar ?>" alt="<?= htmlspecialchars($row['nama']); ?>" class="w-full h-40 object-cover">
          <div class="p-4">
            <h2 class="text-lg font-semibold text-gray-800"><?= htmlspecialchars($row['nama']); ?></h2>
            <p class="text-sm text-gray-500 mb-4"><?= htmlspecialchars($row['deskripsi']); ?></p>
            <a href="menus.php?id=<?= $row['id']; ?>" class="bg-pink-500 text-white px-3 py-1 rounded hover:bg-pink-600 transition">Lihat Menu</a>
          </div>
        </div>
      <?php } ?>
    </div>
  </main>

  <script>
    // Klik di luar sidebar untuk nutup otomatis
    document.addEventListener('click', function (e) {
      const sidebar = document.getElementById('sidebar');
      const toggleBtn = document.getElementById('toggleSidebar');

      if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target)) {
        sidebar.classList.add('-translate-x-full');
        document.querySelector('main').classList.remove('ml-64');
      }
    });
  </script>

</body>
</html>
