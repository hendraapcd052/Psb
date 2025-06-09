<?php
// Koneksi database
$conn = new mysqli("localhost", "root", "", "dbpendaftaran");
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "SELECT * FROM pendaftar ORDER BY tanggal_daftar DESC LIMIT 10";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Data Pendaftar - Admin PSB</title>
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

    .sidebar.closed {
      width: 0;
      min-width: 0;
      overflow: hidden;
    }

    table {
      table-layout: fixed;
      width: 100%;
    }

    th,
    td {
      overflow: hidden;
      white-space: nowrap;
      text-overflow: ellipsis;
    }

    img {
      display: block;
      width: 40px;
      height: 40px;
      object-fit: cover;
      border-radius: 0.375rem;
    }
  </style>
</head>

<body class="min-h-screen">
  <div class="flex h-screen bg-gray-50">
    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar w-64 bg-white shadow-lg">
      <div class="p-4 border-b">
        <div class="flex items-center justify-center">
          <h1 class="text-2xl font-bold text-primary">SD Negeri Karawaci 7I</h1>
        </div>
      </div>
      <nav class="mt-4 px-4">
        <div class="text-xs uppercase text-gray-500 font-semibold">Menu Utama</div>
        <a href="dashboard.php" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-lg mt-2">
          <i class="ri-dashboard-line w-5 h-5"></i>
          <span class="mx-4">Dashboard</span>
        </a>
        <a href="data_pendaftar.php" class="flex items-center px-4 py-3 text-gray-700 bg-gray-100 rounded-lg mt-1">
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
        <div class="flex items-center justify-between p-4 max-w-7xl mx-auto">
          <div class="flex items-center space-x-4">
            <button id="toggleSidebarBtn" class="text-gray-500 hover:text-gray-600 focus:outline-none">
              <i class="ri-menu-line w-6 h-6"></i>
            </button>
            <h2 class="text-xl font-semibold text-gray-800">Data Pendaftar</h2>
          </div>
          <div class="flex items-center space-x-4">
            <button class="relative text-gray-500 hover:text-gray-600">
            </button>
            <div class="flex items-center space-x-3">
              <img class="h-10 w-10 rounded-full object-cover border-2 border-primary" src="../gambar/logo.jpg" alt="Admin">
              <span class="text-sm font-medium text-gray-700">Admin</span>
            </div>
          </div>
        </div>
      </header>

      <!-- Content -->
      <main class="flex-1 overflow-y-auto p-4">
        <div class="bg-white rounded-lg shadow p-6">
          <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Pendaftar Terbaru</h3>
            <a href="#" class="text-primary hover:text-primary/80 text-sm font-medium">Lihat Semua</a>
          </div>
          <div class="overflow-x-auto">
            <table class="divide-y divide-gray-200 border border-gray-300">
              <thead class="bg-gray-100">
                <tr>
                  <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 border border-gray-300 w-12">ID</th>
                  <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 border border-gray-300 w-64">Nama Siswa</th>
                  <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 border border-gray-300 w-28">Jenis Kelamin</th>
                  <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 border border-gray-300 w-40">TTL</th>
                  <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 border border-gray-300 w-64">Alamat</th>
                  <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 border border-gray-300 w-52">Asal Sekolah</th>
                  <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 border border-gray-300 w-32">Tgl Daftar</th>
                  <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 border border-gray-300 w-32">Status</th>
                  <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 border border-gray-300 w-24">Foto</th>
                  <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 border border-gray-300 w-24">KK</th>
                  <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 border border-gray-300 w-28">Aksi</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <?php $no = 1;
                while ($row = $result->fetch_assoc()): ?>
                  <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border border-gray-300 text-sm text-gray-700"><?php echo $no++; ?></td>
                    <td class="px-4 py-2 border border-gray-300">
                      <div class="flex items-center">
                        <div class="ml-3">
                          <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($row['nama_lengkap']); ?></div>
                        </div>
                      </div>
                    </td>
                    <td class="px-4 py-2 border border-gray-300 text-sm text-gray-700"><?php echo htmlspecialchars($row['jenis_kelamin']); ?></td>
                    <td class="px-4 py-2 border border-gray-300 text-sm text-gray-700"><?php echo htmlspecialchars($row['tempat_lahir']) . ', ' . date('d M Y', strtotime($row['tanggal_lahir'])); ?></td>
                    <td class="px-4 py-2 border border-gray-300 text-sm text-gray-700"><?php echo htmlspecialchars($row['alamat']); ?></td>
                    <td class="px-4 py-2 border border-gray-300 text-sm text-gray-700"><?php echo htmlspecialchars($row['asal_sekolah']); ?></td>
                    <td class="px-4 py-2 border border-gray-300 text-sm text-gray-700"><?php echo date('d M Y', strtotime($row['tanggal_daftar'])); ?></td>
                    <td class="px-4 py-2 border border-gray-300">
                      <?php if ($row['status'] == 'Terverifikasi'): ?>
                        <span class="text-xs px-2 py-1 rounded bg-green-100 text-green-700 font-semibold">Terverifikasi</span>
                      <?php else: ?>
                        <span class="text-xs px-2 py-1 rounded bg-yellow-100 text-yellow-700 font-semibold">Pending</span>
                      <?php endif; ?>
                    </td>
                    <td class="px-4 py-2 border border-gray-300 text-sm text-center">
                      <img src="<?php echo !empty($row['foto']) ? 'uploads/foto/' . htmlspecialchars($row['foto']) : 'https://via.placeholder.com/40?text=No+Foto'; ?>" onerror="this.src='https://via.placeholder.com/40?text=Foto';" />
                    </td>
                    <td class="px-4 py-2 border border-gray-300 text-sm text-center">
                      <img src="<?php echo 'uploads/kk/' . htmlspecialchars($row['kk'] ?? ''); ?>" onerror="this.src='https://via.placeholder.com/40';" />
                    </td>
                    <td class="px-4 py-2 border border-gray-300 text-sm text-center">
                      <a href="detail_pendaftar.php?id=<?= $row['id'] ?>" class="text-blue-600 hover:text-blue-800">Detail</a> |
                      <a href="hapus_pendaftar.php?id=<?= $row['id'] ?>" class="text-red-600 hover:text-red-800" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>

                    </td>

                    </td>
                  </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </div>
      </main>
    </div>
  </div>

  <script>
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('toggleSidebarBtn');

    toggleBtn.addEventListener('click', () => {
      sidebar.classList.toggle('closed');
    });
  </script>
</body>

</html>

<?php $conn->close(); ?>