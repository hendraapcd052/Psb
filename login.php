<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Siswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(30px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .fade-in {
      animation: fadeIn 1s ease-out;
    }
  </style>
</head>

<body class="bg-gradient-to-tr from-blue-50 to-white min-h-screen flex items-center justify-center">

  <div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-md fade-in">

    <!-- Logo -->
    <div class="flex justify-center mb-6">
      <img src="gambar/logo.jpg" alt="Logo SMA" class="h-20 w-auto animate-bounce-slow">
    </div>

    <h2 class="text-xl font-bold text-center mb-6 text-gray-800">Login Admin</h2>

    <form action="login_control.php" method="POST" class="space-y-4">

      <!-- Username -->
      <div>
        <label for="username" class="block font-medium text-gray-700">Username</label>
        <input type="text" id="username" name="username" required class="w-full p-3 mt-1 border rounded-xl focus:ring-2 focus:ring-blue-500" placeholder="Masukkan username">
      </div>

      <!-- Password -->
      <div>
        <label for="password" class="block font-medium text-gray-700">Password</label>
        <input type="password" id="password" name="password" required class="w-full p-3 mt-1 border rounded-xl focus:ring-2 focus:ring-blue-500" placeholder="Masukkan password">
      </div>

      <!-- Tombol Login -->
      <div class="text-center pt-2">
        <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-xl hover:bg-blue-700 transition-all hover:scale-105">
          Login
        </button>
        <!-- Tombol Kembali -->
        <div class="text-center mt-4">
          <a href="pilihan_login.php" class="text-blue-600 hover:underline hover:text-blue-800 transition-all">← Kembali</a>
        </div>
      </div>
  </div>
  </form>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          animation: {
            'bounce-slow': 'bounce 2s infinite',
          }
        }
      }
    }
  </script>
</body>

</html>