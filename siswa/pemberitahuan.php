<?php
$conn = new mysqli("localhost", "root", "", "dbpendaftaran");
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}
$pengumuman = $conn->query("SELECT * FROM pengumuman ORDER BY tanggal DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard Siswa</title>
  <link rel="icon" href="../gambar/logo.jpg" type="image/x-icon" />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f9fafb;
    }
    .card-content {
      max-height: 200px;
      overflow-y: auto;
      word-wrap: break-word;
    }
    .card-content::-webkit-scrollbar {
      width: 6px;
    }
    .card-content::-webkit-scrollbar-thumb {
      background-color: #cbd5e1;
      border-radius: 4px;
    }
  </style>
</head>

<body class="min-h-screen bg-gradient-to-b from-blue-50 to-white">

  <!-- Tombol Kembali -->
  <div class="fixed top-4 right-4 z-50">
    <a href="dashboar_siswa.php"
      class="backdrop-blur-md bg-white/70 border border-gray-200 hover:bg-white hover:shadow-xl transition-all duration-300 text-gray-800 font-semibold px-4 py-2 rounded-lg shadow-md">
      ⬅ Kembali
    </a>
  </div>

  <main class="max-w-7xl mx-auto px-6 py-16">
    <h1 class="text-4xl font-bold text-blue-700 mb-10 text-center">📢 Pengumuman untuk Siswa</h1>

    <?php if ($pengumuman->num_rows > 0): ?>
      <div class="grid gap-8 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
        <?php while ($row = $pengumuman->fetch_assoc()): ?>
          <div class="bg-white border border-blue-100 rounded-2xl p-6 shadow-sm hover:shadow-lg transition duration-300">
            <div class="flex items-center mb-4">
              <div class="bg-blue-100 text-blue-600 p-2 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <h3 class="text-lg font-semibold text-blue-800 ml-4"><?= htmlspecialchars($row['judul']) ?></h3>
            </div>
            <p class="text-gray-700 card-content mb-4 leading-relaxed">
              <?= nl2br(htmlspecialchars($row['isi'])) ?>
            </p>
            <p class="text-sm text-gray-500 text-right"><?= date('d M Y', strtotime($row['tanggal'])) ?></p>
          </div>
        <?php endwhile; ?>
      </div>
    <?php else: ?>
      <p class="text-center text-gray-500 italic mt-8">Belum ada pengumuman yang tersedia.</p>
    <?php endif; ?>
  </main>

</body>
</html>

<?php $conn->close(); ?>
