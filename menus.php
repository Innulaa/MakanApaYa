<?php
session_start();
include 'koneksi.php';
include 'sidebar.php';

error_reporting(E_ALL); ini_set('display_errors', 1);

if (!isset($_GET['id'])) {
    die('<div class="p-6 text-red-600">ID tenant tidak ditemukan.</div>');
}
$tenant_id = intval($_GET['id']);

$tenant = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tenant_kantin WHERE id = $tenant_id"));
if (!$tenant) {
    die('<div class="p-6 text-red-600">Tenant tidak ditemukan.</div>');
}

$query_menus = mysqli_query($conn, "SELECT * FROM menus WHERE tenant_id = $tenant_id");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Menu <?= htmlspecialchars($tenant['nama']); ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    #mainContent {
      transition: margin-left 0.3s ease;
      margin-left: 0;
    }
    #mainContent.sidebar-open {
      margin-left: 16rem; /* 64 = 16rem = sidebar width */
    }
  </style>
</head>
<body class="bg-gray-100 flex">

  <!-- Sidebar: Sudah ada via include 'sidebar.php' -->

  <!-- MAIN CONTENT -->
  <main id="mainContent" class="flex-1 px-4 sm:px-8 lg:px-16 py-6">
    <h1 class="text-3xl font-bold text-pink-600 mb-8">
      🍽️ Menu dari <?= htmlspecialchars($tenant['nama']); ?>
    </h1>

    <?php if (mysqli_num_rows($query_menus) > 0): ?>
      <?php while ($menu = mysqli_fetch_assoc($query_menus)) : ?>
        <?php
          $menu_id = (int)$menu['id'];
          $stat = mysqli_fetch_assoc(
            mysqli_query($conn, "SELECT ROUND(AVG(rating),2) AS avg, COUNT(*) AS total FROM reviews WHERE menu_id = $menu_id")
          );
        ?>
        <div class="w-full max-w-4xl mx-auto bg-pink-50 border border-pink-200 rounded-xl shadow mb-10">
          <div class="p-6 space-y-4">
            <div>
              <h2 class="text-xl font-semibold text-pink-700"><?= htmlspecialchars($menu['nama_menu']); ?></h2>
              <p class="text-gray-700">Rp<?= number_format($menu['harga'],0,',','.'); ?></p>
              <?php if ($stat && $stat['total']): ?>
                <p class="text-sm text-gray-600">Rating rata-rata:
                  <span class="font-bold text-pink-700"><?= $stat['avg']; ?></span> (<?= $stat['total']; ?> ulasan)
                </p>
              <?php else: ?>
                <p class="text-sm text-gray-600 italic">Belum ada rating</p>
              <?php endif; ?>
            </div>

            <!-- FORM REVIEW -->
            <form action="proses_review.php" method="post" class="space-y-3">
              <input type="hidden" name="menu_id" value="<?= $menu_id; ?>">
              <input type="hidden" name="tenant_id" value="<?= $tenant_id; ?>">
              <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?? 0; ?>">

              <label class="block text-sm font-medium text-gray-700">Rating:</label>
              <select name="rating" required
                      class="w-full border border-pink-300 rounded-md p-2 focus:ring-pink-500 focus:border-pink-500">
                <option value="" selected disabled>Pilih rating</option>
                <?php for ($i=1; $i<=5; $i++): ?>
                  <option value="<?= $i; ?>"><?= $i; ?></option>
                <?php endfor; ?>
              </select>

              <textarea name="komentar" rows="3" placeholder="Komentar kamu..."
                        class="w-full border border-pink-300 rounded-md p-2 focus:ring-pink-500 focus:border-pink-500"></textarea>

              <button type="submit"
                      class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-md">
                Kirim Review
              </button>
            </form>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p class="text-gray-600">Belum ada menu untuk tenant ini.</p>
    <?php endif; ?>
  </main>

  <!-- JS untuk geser konten saat sidebar terbuka -->
  <script>
    function adjustContent() {
      const sidebar = document.getElementById('sidebar');
      const main = document.getElementById('mainContent');
      const isOpen = !sidebar.classList.contains('hidden') && !sidebar.classList.contains('-translate-x-full');
      main.classList.toggle('sidebar-open', isOpen);
    }

    document.addEventListener('DOMContentLoaded', adjustContent);
    document.addEventListener('click', adjustContent);
  </script>

  <script>
navigator.geolocation.getCurrentPosition(pos => {
  const data = new FormData();
  data.append('latitude',  pos.coords.latitude);
  data.append('longitude', pos.coords.longitude);

  fetch('save_location.php', { method: 'POST', body: data })
    .then(r => r.text()).then(console.log);
});
</script>


</body>
</html>
