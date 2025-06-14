<?php include 'sidebar.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tentang Aplikasi - MakanApaYa</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Poppins', sans-serif; }
  </style>
</head>
<body class="bg-pink-50 text-gray-800">

  <main class="ml-0 md:ml-64 p-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-pink-400 to-pink-600 text-white p-6 rounded-xl shadow-md mb-6 flex items-center justify-between">
      <div>
        <h1 class="text-3xl font-bold mb-1">Tentang MakanApaYa 🍱</h1>
        <p class="text-sm opacity-90">Aplikasi kuliner kampus berbasis review & voting</p>
      </div>
      <div class="hidden md:block text-6xl">ℹ️</div>
    </div>

    <!-- Deskripsi Aplikasi -->
    <div class="bg-white p-6 rounded-2xl shadow border border-pink-100 mb-6">
      <p class="mb-4 text-lg leading-relaxed">
        <strong class="text-pink-600">MakanApaYa</strong> adalah aplikasi berbasis web yang membantu mahasiswa memilih makanan terbaik di kantin kampus melalui sistem review dan voting yang interaktif.
      </p>
      <p class="text-gray-700 leading-relaxed">
        Dengan aplikasi ini, pengguna dapat memberikan ulasan, rating, dan mendapatkan rekomendasi kuliner favorit di sekitar kampus.
      </p>
    </div>

    <!-- Tim Pengembang -->
    <div class="bg-white p-6 rounded-2xl shadow border border-pink-100">
      <h2 class="text-xl font-semibold text-pink-600 mb-4">👩‍💻 Tim Pengembang</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <!-- Anindita -->
        <div class="group bg-pink-50 border border-pink-200 rounded-xl p-4 text-center shadow hover:shadow-lg transition">
          <div class="w-20 h-20 mx-auto rounded-full bg-pink-200 flex items-center justify-center text-2xl font-bold text-pink-700">A</div>
          <h3 class="mt-3 font-semibold text-lg">Anindita Tri Mulia</h3>
          <p class="text-sm text-gray-600">2317051064</p>
        </div>

        <!-- Intan -->
        <div class="group bg-pink-50 border border-pink-200 rounded-xl p-4 text-center shadow hover:shadow-lg transition">
          <div class="w-20 h-20 mx-auto rounded-full bg-pink-200 flex items-center justify-center text-2xl font-bold text-pink-700">I</div>
          <h3 class="mt-3 font-semibold text-lg">Intan Nur Laila</h3>
          <p class="text-sm text-gray-600">2317051109</p>
        </div>

        <!-- Rahayu -->
        <div class="group bg-pink-50 border border-pink-200 rounded-xl p-4 text-center shadow hover:shadow-lg transition">
          <div class="w-20 h-20 mx-auto rounded-full bg-pink-200 flex items-center justify-center text-2xl font-bold text-pink-700">R</div>
          <h3 class="mt-3 font-semibold text-lg">Rahayu Indah Lestari</h3>
          <p class="text-sm text-gray-600">2317051073</p>
        </div>
      </div>
    </div>
  </main>

</body>
</html>