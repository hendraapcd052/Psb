<?php
// Koneksi database

$koneksi = new mysqli("localhost", "root", "", "dbpendaftaran");
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Ambil data pendaftar terbaru (limit 5)
$sql = "SELECT nama_lengkap, tanggal_daftar, asal_sekolah, nisn FROM pendaftar ORDER BY tanggal_daftar DESC LIMIT 5";
$result = $koneksi->query($sql);

// Fungsi hitung total pendaftar
function hitung_total($koneksi) {
    $query = "SELECT COUNT(*) as total FROM pendaftar";
    $res = $koneksi->query($query);
    return $res->fetch_assoc()['total'] ?? 0;
}

// Fungsi hitung total verifikasi
function hitung_verifikasi($koneksi) {
    $query = "SELECT COUNT(*) as total_verif FROM pendaftar WHERE status = 'terverifikasi'";
    $res = $koneksi->query($query);
    return $res->fetch_assoc()['total_verif'] ?? 0;
}

// Ambil data statistik
$total = hitung_total($koneksi);
$total_verif = hitung_verifikasi($koneksi);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Dashboard - Sistem PSB</title>
  <link rel="icon" href="../gambar/logo.jpg" type="image/x-icon">
  <script src="https://cdn.tailwindcss.com/3.4.16"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#4F46E5',
            secondary: '#10B981',
          },
          borderRadius: {
            button: '8px',
          },
        },
      },
    };
  </script>
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" />
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f9fafb;
    }
    .sidebar {
      transition: all 0.3s ease;
      position: relative;
      z-index: 40;
    }
    .sidebar-hidden {
      transform: translateX(-100%);
      transition: transform 0.3s ease;
      position: absolute;
      z-index: 50;
    }
  </style>
</head>
<body class="min-h-screen">
  <div class="flex h-screen bg-gray-50">
    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar w-64 bg-white shadow-lg">
      <div class="p-4 border-b">
        <div class="flex items-center justify-center">
          <h1 class="text-2xl font-bold text-primary">SD Negeri Karawaci 7</h1>
        </div>
      </div>
      <nav class="mt-4 px-4">
        <div class="text-xs uppercase text-gray-500 font-semibold">Menu Utama</div>
        <a href="#" class="flex items-center px-4 py-3 text-gray-700 bg-gray-100 rounded-lg mt-2">
          <i class="ri-dashboard-line w-5 h-5"></i>
          <span class="mx-4">Dashboard</span>
        </a>
        <a href="data_pendaftar.php" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-lg mt-1">
          <i class="ri-user-add-line w-5 h-5"></i>
          <span class="mx-4">Data Pendaftar</span>
        </a>
        <a href="pengumuman.php" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-lg mt-1">
          <i class="ri-file-list-3-line w-5 h-5"></i>
          <span class="mx-4">Pengumuman</span>
        </a>
        <a href="../pilihan_login.php" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-lg mt-1">
          <i class="ri-settings-line w-5 h-5"></i>
          <span class="mx-4">Logout</span>
        </a>
      </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
      <!-- Header -->
      <header class="bg-white shadow-sm">
        <div class="flex items-center justify-between p-4">
          <div class="flex items-center space-x-4">
            <button id="btn-toggle" class="text-gray-500 hover:text-gray-600">
              <i class="ri-menu-line w-6 h-6"></i>
            </button>
            <h2 class="text-xl font-semibold text-gray-800">Dashboard Admin</h2>
          </div>
          <div class="flex items-center space-x-4">
           <div class="flex items-center space-x-3">
              <img class="h-10 w-10 rounded-full object-cover border-2 border-primary" src="../gambar/logo.jpg" alt="Admin">
              <span class="text-sm font-medium text-gray-700">Admin</span>
            </div>
          </div>
        </div>
      </header>

      <!-- Content -->
      <main class="flex-1 overflow-y-auto p-4">
        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-8">
          <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
              <div class="p-3 bg-primary/10 rounded-full text-primary">
                <i class="ri-user-add-line w-6 h-6"></i>
              </div>
              <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Total Pendaftar</h3>
                <p class="text-2xl font-semibold text-gray-900"><?= $total ?></p>
              </div>
            </div>
          </div>
          <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
              <div class="p-3 bg-green-100 rounded-full text-green-600">
                <i class="ri-checkbox-circle-line w-6 h-6"></i>
              </div>
              <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Terverifikasi</h3>
                <p class="text-2xl font-semibold text-gray-900"><?= $total_verif ?></p>
              </div>
            </div>
          </div>
        </div>

        <!-- Pendaftar Terbaru -->
        <div class="bg-white rounded-lg shadow">
          <div class="p-6 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">Pendaftar Terbaru</h3>
            <a href="data_pendaftar.php" class="text-primary hover:text-primary/80 text-sm font-medium">Lihat Semua</a>
          </div>
          <div class="overflow-x-auto">
            <table class="w-full">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Siswa</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Daftar</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Asal Sekolah</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NISN</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <?php if ($result->num_rows > 0): ?>
                  <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($row['nama_lengkap']) ?></td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= date('d M Y', strtotime($row['tanggal_daftar'])) ?></td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($row['asal_sekolah']) ?></td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($row['nisn']) ?></td>
                    </tr>
                  <?php endwhile; ?>
                <?php else: ?>
                  <tr><td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada data pendaftar</td></tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </main>
    </div>
  </div>

  <script>
    const btnToggle = document.getElementById('btn-toggle');
    const sidebar = document.getElementById('sidebar');

    btnToggle.addEventListener('click', () => {
      sidebar.classList.toggle('sidebar-hidden');
    });
  </script>
</body>
</html>

<?php $koneksi->close(); ?>
