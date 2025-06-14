<?php
include 'koneksi.php';
include 'sidebar.php';
date_default_timezone_set('Asia/Jakarta');

/* ---------- Fungsi waktu relatif ---------- */
function timeAgo($datetime) {
    $diff = time() - strtotime($datetime);
    if ($diff < 60)           return $diff . " detik lalu";
    if ($diff < 3600)         return floor($diff/60) . " menit lalu";
    if ($diff < 86400)        return floor($diff/3600) . " jam lalu";
    if ($diff < 604800)       return floor($diff/86400) . " hari lalu";
    return date('d M Y', strtotime($datetime));
}

/* ---------- Ringkasan rating per menu ---------- */
$summary = mysqli_query($conn, "
  SELECT m.id AS menu_id, m.nama_menu,
         t.nama AS nama_tenant,
         COUNT(r.id) AS total_review,
         IFNULL(ROUND(AVG(r.rating),2),0) AS rata_rating
  FROM menus m
  JOIN tenant_kantin t ON t.id = m.tenant_id
  LEFT JOIN reviews r  ON r.menu_id = m.id
  GROUP BY m.id
  ORDER BY rata_rating DESC, total_review DESC
");

/* ---------- Review terbaru ---------- */
$reviews = mysqli_query($conn, "
  SELECT r.*, m.nama_menu, t.nama AS nama_tenant
  FROM reviews r
  JOIN menus m          ON m.id = r.menu_id
  JOIN tenant_kantin t  ON t.id = m.tenant_id
  ORDER BY r.tanggal DESC
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Review & Rating</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body class="bg-gray-100 flex">
  <!-- SIDEBAR sudah di‑render oleh sidebar.php -->
  <main id="mainContent"
        class="flex-1 transition-all duration-300 px-4 sm:px-8 lg:px-16 py-6">
    <h1 class="text-3xl font-bold text-pink-600 mb-8">⭐ Review & Rating</h1>

    <!-- ===== Ringkasan Rating ===== -->
    <section class="mb-12">
      <h2 class="text-2xl font-semibold text-pink-700 mb-4">Ringkasan Rating</h2>
      <?php if (mysqli_num_rows($summary)): ?>
        <?php while ($s = mysqli_fetch_assoc($summary)): ?>
          <div class="bg-pink-50 border border-pink-200 rounded-xl shadow mb-4 p-4">
            <h3 class="text-lg font-bold text-pink-700">
              <?= htmlspecialchars($s['nama_menu']); ?>
              <span class="text-sm text-gray-500">— <?= htmlspecialchars($s['nama_tenant']); ?></span>
            </h3>
            <p class="text-sm text-gray-600">
              <?= $s['total_review']; ?> ulasan •
              <?= number_format($s['rata_rating'],2); ?>/5 ⭐
            </p>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p class="text-gray-600">Belum ada menu yang diulas.</p>
      <?php endif; ?>
    </section>

    <!-- ===== Review Terbaru ===== -->
    <section>
      <h2 class="text-2xl font-semibold text-pink-700 mb-4">Ulasan Terbaru</h2>
      <?php if (mysqli_num_rows($reviews)): ?>
        <?php while ($rev = mysqli_fetch_assoc($reviews)): ?>
          <div class="bg-white border border-gray-200 rounded-xl shadow mb-4 p-4">
            <h3 class="text-lg font-semibold text-pink-700">
              <?= htmlspecialchars($rev['nama_menu']); ?>
              <span class="text-sm text-gray-500">— <?= htmlspecialchars($rev['nama_tenant']); ?></span>
            </h3>
            <p class="text-sm text-gray-600 mb-1">Rating: <?= $rev['rating']; ?>/5</p>
            <p class="text-gray-700 mb-2"><?= htmlspecialchars($rev['komentar']); ?></p>
            <p class="text-xs text-gray-400"><?= timeAgo($rev['tanggal']); ?></p>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p class="text-gray-600">Belum ada ulasan.</p>
      <?php endif; ?>
    </section>
  </main>

  <script>
    /* Geser konten jika sidebar terbuka */
    function adjustMain(){
      const sb=document.getElementById('sidebar');
      const mc=document.getElementById('mainContent');
      if(!sb||!mc) return;
      sb.classList.contains('-translate-x-full') ? mc.classList.remove('ml-64') : mc.classList.add('ml-64');
    }
    document.addEventListener('DOMContentLoaded', adjustMain);
    document.addEventListener('click', adjustMain);
  </script>

<?php if (isset($_GET['sukses']) && $_GET['sukses'] == 1): ?>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      Swal.fire({
        title: 'Review Terkirim!',
        text: 'Review berhasil dikirimkan 🎉',
        icon: 'success',
        confirmButtonText: 'Lihat Review',
        confirmButtonColor: '#ec4899' // Tailwind pink-500
      }).then(() => {
        const latestReviewSection = document.querySelector("section:last-of-type");
        if (latestReviewSection) {
          latestReviewSection.scrollIntoView({ behavior: 'smooth' });
        }
      });
    });
  </script>
<?php endif; ?>

</body>
</html>
