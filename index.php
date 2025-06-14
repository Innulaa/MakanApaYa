<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>MakanApaYa - Review Kantin Kampus</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-800">


  <!-- Hero Section -->
  <section class="bg-orange-50 py-16 px-6 md:px-20 flex flex-col md:flex-row items-center">
    <div class="md:w-1/2 text-center md:text-left">
      <h1 class="text-4xl font-bold mb-4">Cari Makan Enak di Kantin?</h1>
      <p class="mb-6 text-lg">Review jujur dari mahasiswa untuk mahasiswa. Cek rekomendasi & kasih penilaianmu!</p>
      <a href="login.php" class="bg-blue-600 text-white px-6 py-3 rounded-full hover:bg-blue-700 transition">Get Started</a>
    </div>
    <div class="md:w-1/2 mt-8 md:mt-0 flex justify-center">
      <img src="makan.jpg" class="w-64 h-64 object-cover rounded-full shadow-lg" alt="Ilustrasi Makanan" />
    </div>
  </section>

  <!-- Tenant Favorit Mingguan -->
  <section class="bg-white py-12 px-6">
    <h2 class="text-2xl font-bold text-center mb-8">Rekomendasi Makanan Terlaris Se FMIPA UNILA</h2>
    <div class="flex overflow-x-auto space-x-4 pb-4">
      <!-- Card Tenant -->
      <div class="click-block min-w-[200px] bg-pink-100 p-4 rounded-xl shadow text-center cursor-pointer">
        <img src="naspad.jpeg" class="w-full h-32 object-cover rounded-md mb-2" />
        <h3 class="font-semibold">Nasi Padang Uni Rahayu</h3>
        <p class="text-sm text-gray-600">⭐ 4.9</p>
      </div>
      <div class="click-block min-w-[200px] bg-yellow-100 p-4 rounded-xl shadow text-center cursor-pointer">
        <img src="mieayam.jpeg" class="w-full h-32 object-cover rounded-md mb-2" />
        <h3 class="font-semibold">Mie Ayam Mbak Anin</h3>
        <p class="text-sm text-gray-600">⭐ 4.9</p>
      </div>
      <div class="click-block min-w-[200px] bg-blue-200 p-4 rounded-xl shadow text-center cursor-pointer">
        <img src="seblak.jpeg" class="w-full h-32 object-cover rounded-md mb-2" />
        <h3 class="font-semibold">Seblak TehIntan</h3>
        <p class="text-sm text-gray-600">⭐ 4.9</p>
      </div>
    </div>
    <div class="mt-4 text-center">
      <a href="#" class="click-block text-blue-600 font-semibold hover:underline">Lihat Semua Tenant →</a>
    </div>
  </section>

  <!-- Voting Menu Terenak -->
  <section class="click-block bg-pink-100 px-6 py-12 text-center my-6 mx-4 rounded-xl cursor-pointer">
    <h3 class="text-xl font-semibold mb-2">Voting Menu Terenak Mingguan</h3>
    <p class="text-gray-700 mb-4">Yuk ikut voting menu terenak minggu ini & bantu teman kampus memilih makanan terbaik!</p>
    <span class="inline-block bg-pink-500 text-white px-5 py-2 rounded-full hover:bg-pink-600">Vote Sekarang</span>
  </section>


  <!-- Footer -->
  <footer class="bg-gray-100 py-8 text-center text-sm text-gray-500">
    <p>© 2025 MakanApaYa.Dibuat oleh Kelompok Lima❤️ .</p>
  </footer>

  <div id="popup" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white p-6 rounded-xl shadow-lg text-center max-w-sm">
      <p class="mb-4 text-lg font-semibold text-gray-800">Klik Get Started untuk login</p>
      <button onclick="closePopup()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Oke</button>
    </div>
  </div>

  <script>
    const blocks = document.querySelectorAll('.click-block');
    blocks.forEach(el => {
      el.addEventListener('click', (e) => {
        e.preventDefault();
        document.getElementById('popup').classList.remove('hidden');
      });
    });

    function closePopup() {
      document.getElementById('popup').classList.add('hidden');
    }
  </script>

</body>
</html>
