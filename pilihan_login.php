<!DOCTYPE html>
<html lang="id" class="h-full bg-gradient-to-br from-blue-100 to-white">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pilih Login - Aplikasi PSB SDN Tangerang</title>
  <link rel="icon" href="../gambar/logo.jpg" type="image/x-icon">
  <link rel="icon" type="image/png" href="assets/img/logoo.png" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex items-center justify-center p-6">
  <div class="w-full max-w-4xl bg-white rounded-2xl shadow-xl p-10">
    <div class="text-center mb-10">
      <img src="./gambar/logo.jpg" alt="Logo Sekolah" class="w-20 h-20 mx-auto mb-4" />
      <h1 class="text-2xl font-bold text-blue-700">Selamat Datang di Aplikasi PSB SDN 7 Karawaci</h1>
      <p class="text-sm text-gray-600">Silakan pilih jenis login Anda</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Login Siswa -->
      <a href="./siswa/dashboar_siswa.php"
        class="block bg-blue-500 hover:bg-blue-600 text-white rounded-xl p-6 text-center transition-all duration-200 shadow-md hover:shadow-lg">
        <h2 class="text-xl font-semibold mb-2">Daftar Siswa</h2>
        <p class="text-sm">Masuk sebagai calon siswa atau orang tua</p>
      </a>

      <!-- Login Admin -->
      <a href="login.php"
        class="block bg-gray-800 hover:bg-gray-900 text-white rounded-xl p-6 text-center transition-all duration-200 shadow-md hover:shadow-lg">
        <h2 class="text-xl font-semibold mb-2">Login Admin</h2>
        <p class="text-sm">Masuk sebagai pengelola/admin sekolah</p>
      </a>
    </div>
  </div>
</body>

</html>