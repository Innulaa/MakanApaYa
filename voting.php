<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}
if (!isset($_SESSION['user_id'])) {
  die("Sesi user_id belum ditemukan. Silakan login ulang.");
}

include 'koneksi.php';

$username = $_SESSION['username'];
$user_id  = $_SESSION['user_id'];

$now    = new DateTime();
$minggu = $now->format("W");
$tahun  = $now->format("o");

$menus = mysqli_query($conn, 
  "SELECT menus.id, menus.nama_menu, tenant_kantin.nama AS nama_tenant
   FROM menus
   JOIN tenant_kantin ON menus.tenant_id = tenant_kantin.id");

$msg = '';
$showStats = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $menu_id = intval($_POST['menu_id']);

  mysqli_begin_transaction($conn);

  try {
    $cek_vote = mysqli_query($conn,
      "SELECT * FROM voting 
       WHERE user_id = $user_id AND minggu_ke = $minggu AND tahun = $tahun");

    if (!$cek_vote) {
      throw new Exception("Gagal mengecek data voting.");
    }

    if (mysqli_num_rows($cek_vote) === 0) {
      $insert = mysqli_query($conn,
        "INSERT INTO voting (user_id, menu_id, minggu_ke, tahun)
         VALUES ($user_id, $menu_id, $minggu, $tahun)");

      if (!$insert) {
        throw new Exception("Gagal menyimpan data voting.");
      }

      mysqli_commit($conn);
      $msg = "Terima kasih! Suara kamu telah tercatat.";
    } else {
      mysqli_rollback($conn);
      $msg = "Kamu sudah voting minggu ini! Tunggu minggu depan ya 🍽";
    }

  } catch (Exception $e) {
    mysqli_rollback($conn);
    $msg = "Terjadi kesalahan: " . $e->getMessage();
  }

  $showStats = true;
}

// Statistik Voting Minggu Ini
$hasil_voting = mysqli_query($conn,
  "SELECT menus.nama_menu, COUNT(*) AS jumlah
   FROM voting
   JOIN menus ON voting.menu_id = menus.id
   WHERE minggu_ke = $minggu AND tahun = $tahun
   GROUP BY menus.nama_menu");

$data_menu = [];
$data_jumlah = [];
while ($row = mysqli_fetch_assoc($hasil_voting)) {
  $data_menu[] = $row['nama_menu'];
  $data_jumlah[] = $row['jumlah'];
}

// Daftar Voter Minggu Ini
$voters = mysqli_query($conn,
  "SELECT users.username, menus.nama_menu
   FROM voting
   JOIN users ON voting.user_id = users.id
   JOIN menus ON voting.menu_id = menus.id
   WHERE minggu_ke = $minggu AND tahun = $tahun
   ORDER BY users.username ASC");

// Ambil Top 3 Menu Mingguan dari FUNCTION
$top3_query = mysqli_query($conn, "SELECT Top3MenuMingguan() AS top3");
$top3_row = mysqli_fetch_assoc($top3_query);
$top3_text = $top3_row ? $top3_row['top3'] : 'Belum ada data ranking';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Voting Menu Terenak</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-[#FFF6EB] text-gray-800">
  <header class="bg-white py-4 px-6 shadow flex justify-between items-center fixed top-0 w-full z-40">
    <div class="flex items-center space-x-4">
      <?php include 'sidebar.php'; ?>
      <h1 class="text-2xl font-bold text-pink-700 ml-4">MakanApaYa 🍽</h1>
    </div>
    <p class="text-pink-700 font-bold">
      SELAMAT DATANG, <span class="font-bold"><?= htmlspecialchars($username) ?></span> 👋
    </p>
  </header>

  <main id="mainContent" class="flex-1 transition-all duration-300 pt-24 px-6">
    <div class="max-w-3xl mx-auto">
      <h2 class="text-3xl font-bold text-pink-600 mb-6 text-center">
        🥇 Voting Menu Terenak Minggu Ini
      </h2>

      <?php if (!empty($msg)): ?>
        <p class="bg-green-50 border border-green-200 text-green-700 px-4 py-2 rounded mb-6 text-center">
          <?= $msg ?>
        </p>
      <?php endif; ?>

      <?php if (!$showStats): ?>
        <form method="post" class="bg-white p-8 rounded-xl shadow space-y-6">
          <select name="menu_id" required
                  class="w-full border border-pink-300 rounded-md p-3 focus:ring-pink-500 focus:border-pink-500">
            <option value="" selected disabled>Pilih Menu Favorit Kamu</option>
            <?php while ($m = mysqli_fetch_assoc($menus)): ?>
              <option value="<?= $m['id'] ?>">
                <?= htmlspecialchars($m['nama_menu']) ?> — <?= htmlspecialchars($m['nama_tenant']) ?>
              </option>
            <?php endwhile; ?>
          </select>

          <button type="submit"
                  class="bg-pink-500 hover:bg-pink-600 text-white w-full py-3 rounded-md font-semibold transition">
            Vote Sekarang
          </button>
        </form>
      <?php endif; ?>

      <?php if ($showStats): ?>
        <div class="mt-10">
          <h3 class="text-2xl font-bold text-center mb-4 text-pink-600">📊 Hasil Voting Minggu Ini</h3>
          <canvas id="chartVoting" height="200"></canvas>
          <script>
            const ctx = document.getElementById('chartVoting').getContext('2d');
            const chart = new Chart(ctx, {
              type: 'bar',
              data: {
                labels: <?= json_encode($data_menu) ?>,
                datasets: [{
                  label: 'Jumlah Suara',
                  data: <?= json_encode($data_jumlah) ?>,
                  backgroundColor: '#ec4899',
                }]
              },
              options: {
                responsive: true,
                plugins: {
                  legend: { display: false },
                  title: { display: false }
                },
                scales: {
                  y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                  }
                }
              }
            });
          </script>
        </div>

        <div class="mt-10">
          <h3 class="text-2xl font-bold text-center mb-4 text-pink-600">🧑‍🤝‍🧑 Daftar Voter Minggu Ini</h3>
          <div class="bg-white shadow rounded-xl p-6">
            <table class="w-full text-left border-separate border-spacing-y-2">
              <thead>
                <tr class="text-pink-600 font-semibold">
                  <th class="px-2">No</th>
                  <th class="px-2">Username</th>
                  <th class="px-2">Menu yang Dipilih</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; while ($v = mysqli_fetch_assoc($voters)): ?>
                  <tr class="bg-pink-50">
                    <td class="px-2 py-1"><?= $no++ ?></td>
                    <td class="px-2 py-1"><?= htmlspecialchars($v['username']) ?></td>
                    <td class="px-2 py-1"><?= htmlspecialchars($v['nama_menu']) ?></td>
                  </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </div>

        <div class="mt-10">
          <h3 class="text-2xl font-bold text-center mb-4 text-pink-600">🏆 Top 3 Menu Mingguan Terfavorit</h3>
          <div class="bg-white shadow rounded-xl p-6 text-center text-lg text-gray-700">
            <?= htmlspecialchars($top3_text) ?>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </main>

  <script>
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('toggleSidebar');
    const mainContent = document.getElementById('mainContent');

    toggleBtn?.addEventListener('click', () => {
      sidebar.classList.toggle('-translate-x-full');
      sidebar.classList.toggle('hidden');
      mainContent.classList.toggle('ml-64');
    });

    function adjustMain() {
      const open = !sidebar.classList.contains('hidden') && !sidebar.classList.contains('-translate-x-full');
      mainContent.classList.toggle('ml-64', open);
    }
    document.addEventListener('DOMContentLoaded', adjustMain);
    document.addEventListener('click', adjustMain);
  </script>
</body>
</html>