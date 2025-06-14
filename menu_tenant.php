<?php 
include 'koneksi.php';

$tenant_id = $_GET['id'];
$tenant = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tenants WHERE id = $tenant_id"));
$menus = mysqli_query($conn, "SELECT * FROM menus WHERE tenant_id = $tenant_id");

// Proses kirim review
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $menu_id = $_POST['menu_id'];
    $rating = $_POST['rating'];
    $komentar = mysqli_real_escape_string($conn, $_POST['komentar']);
    $user_id = $_SESSION['user_id'];
    mysqli_query($conn, "INSERT INTO reviews (menu_id, user_id, rating, komentar) VALUES ($menu_id, $user_id, $rating, '$komentar')");
    header("Location: menu_tenant.php?id=$tenant_id");
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Menu <?= htmlspecialchars($tenant['nama_tenant']) ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
  <div class="max-w-4xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-orange-600 mb-4">🍱 Menu dari <?= htmlspecialchars($tenant['nama_tenant']) ?></h1>

    <?php while ($menu = mysqli_fetch_assoc($menus)): ?>
      <div class="bg-white shadow-md p-4 rounded-lg mb-6">
        <h2 class="text-lg font-semibold text-gray-800"><?= htmlspecialchars($menu['nama_menu']) ?></h2>
        <p class="text-gray-600 mb-2">Rp<?= number_format($menu['harga']) ?></p>

        <form method="post" class="space-y-2">
          <input type="hidden" name="menu_id" value="<?= $menu['id'] ?>">
          <label class="block text-sm">Rating:</label>
          <select name="rating" required class="w-full p-2 border rounded">
            <option value="">Pilih rating</option>
            <?php for ($i = 1; $i <= 5; $i++): ?>
              <option value="<?= $i ?>"><?= $i ?> Bintang</option>
            <?php endfor; ?>
          </select>
          <textarea name="komentar" placeholder="Komentar kamu..." required class="w-full p-2 border rounded"></textarea>
          <button type="submit" class="bg-orange-400 text-white px-4 py-2 rounded hover:bg-orange-500 transition">Kirim Review</button>
        </form>
      </div>
    <?php endwhile; ?>

    <a href="tenant_list.php" class="text-orange-500 hover:underline">← Kembali ke daftar tenant</a>
  </div>
</body>
</html>
