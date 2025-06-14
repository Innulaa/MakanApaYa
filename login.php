<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login - MakanApaYa</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-pink-50 flex items-center justify-center h-screen font-sans">

  <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md border border-pink-100">
    <div class="text-center mb-6">
      <div class="bg-pink-500 text-white w-14 h-14 mx-auto flex items-center justify-center rounded-full text-2xl font-bold shadow-md">
        M
      </div>
      <h1 class="text-2xl font-bold text-pink-600 mt-4">Selamat Datang!</h1>
      <p class="text-gray-600">Silakan login untuk melanjutkan</p>
    </div>
    
    <form action="cek_login.php" method="POST" class="space-y-4">
      <div>
        <label for="username" class="block mb-1 font-semibold text-sm">Username</label>
        <input type="text" id="username" name="username" required class="w-full px-4 py-2 border border-pink-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400">
      </div>
      <div>
        <label for="password" class="block mb-1 font-semibold text-sm">Password</label>
        <input type="password" id="password" name="password" required class="w-full px-4 py-2 border border-pink-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400">
      </div>
      <button type="submit" class="w-full bg-pink-500 text-white font-semibold py-2 rounded-full hover:bg-pink-600 transition">Login</button>
    </form>

    <p class="text-sm text-center text-gray-500 mt-6">
      Belum punya akun? <a href="register.php" class="text-pink-600 hover:underline">Daftar di sini</a>
    </p>
  </div>

</body>
</html>
