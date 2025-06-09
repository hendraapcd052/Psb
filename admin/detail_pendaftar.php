<?php
$conn = new mysqli("localhost", "root", "", "dbpendaftaran");
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

if (!isset($_GET['id'])) {
  die("ID pendaftar tidak ditemukan.");
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM pendaftar WHERE id = $id LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
  die("Data pendaftar tidak ditemukan.");
}

$data = $result->fetch_assoc();
$updated = isset($_GET['update']) && $_GET['update'] === 'success';
?>

<!DOCTYPE html>
<html lang="id" class="bg-gray-50">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Detail Pendaftar - <?= htmlspecialchars($data['nama_lengkap']); ?></title>
  <link rel="icon" href="../gambar/logo.jpg" type="image/x-icon">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const alertBox = document.getElementById("alert-box");
      if (alertBox) {
        setTimeout(() => {
          alertBox.style.display = "none";
        }, 3000); // 3 detik
      }
    });
  </script>
</head>

<body class="min-h-screen flex flex-col bg-gray-50 font-sans">

  <header class="bg-white shadow p-4 sticky top-0 z-10">
    <div class="container mx-auto flex justify-between items-center">
      <h1 class="text-xl font-bold text-gray-800">Detail Pendaftar</h1>
      <a href="data_pendaftar.php" class="text-indigo-600 hover:text-indigo-800 font-medium">← Kembali ke daftar</a>
    </div>
  </header>

  <main class="container mx-auto flex-grow px-4 py-8">
    <?php if ($updated): ?>
      <div id="alert-box" class="mb-6 bg-green-100 text-green-800 px-4 py-3 rounded shadow text-center font-medium">
        ✅ Data berhasil diperbarui.
      </div>
    <?php endif; ?>

    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-xl p-6 space-y-6">
      <div class="flex flex-col md:flex-row gap-6">
        <div class="flex-shrink-0">
          <img src="<?= !empty($data['foto']) ? 'uploads/foto/' . htmlspecialchars($data['foto']) : 'https://via.placeholder.com/150?text=No+Foto'; ?>"
            alt="Foto Pendaftar"
            class="w-40 h-40 rounded-lg object-cover border border-gray-300 shadow-sm">
        </div>
        <div class="flex-1 grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
          <div><span class="font-semibold text-gray-600">Nama Lengkap:</span> <br><?= htmlspecialchars($data['nama_lengkap']); ?></div>
          <div><span class="font-semibold text-gray-600">Email:</span> <br><?= htmlspecialchars($data['email']); ?></div>
          <div><span class="font-semibold text-gray-600">Jenis Kelamin:</span> <br><?= htmlspecialchars($data['jenis_kelamin']); ?></div>
          <div><span class="font-semibold text-gray-600">TTL:</span> <br><?= htmlspecialchars($data['tempat_lahir']) . ', ' . date('d M Y', strtotime($data['tanggal_lahir'])); ?></div>
          <div class="sm:col-span-2"><span class="font-semibold text-gray-600">Alamat:</span> <br><span class="whitespace-pre-line"><?= htmlspecialchars($data['alamat']); ?></span></div>
          <div><span class="font-semibold text-gray-600">Asal Sekolah:</span> <br><?= htmlspecialchars($data['asal_sekolah']); ?></div>
          <div><span class="font-semibold text-gray-600">Nama Ayah:</span> <br><?= htmlspecialchars($data['nama_ayah']); ?></div>
          <div><span class="font-semibold text-gray-600">Nama Ibu:</span> <br><?= htmlspecialchars($data['nama_ibu']); ?></div>
          <div><span class="font-semibold text-gray-600">No. HP Orang Tua:</span> <br><?= htmlspecialchars($data['no_hp']); ?></div>
          <div>
            <span class="font-semibold text-gray-600">Status:</span> <br>
            <?php if ($data['status'] == 'Terverifikasi'): ?>
              <span class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">Terverifikasi</span>
            <?php else: ?>
              <span class="inline-block bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold">Pending</span>
            <?php endif; ?>
          </div>
          <div><span class="font-semibold text-gray-600">Tanggal Daftar:</span> <br><?= date('d M Y', strtotime($data['tanggal_daftar'])); ?></div>
        </div>
      </div>

      <div class="grid sm:grid-cols-2 gap-6">
        <div>
          <span class="font-semibold text-gray-600">Kartu Keluarga (KK):</span><br>
          <img src="<?= !empty($data['kk']) ? 'uploads/kk/' . htmlspecialchars($data['kk']) : 'https://via.placeholder.com/150?text=No+KK'; ?>"
            alt="Kartu Keluarga"
            class="w-40 h-auto rounded-lg border border-gray-300 shadow-sm mt-2">
        </div>
      </div>

      <div class="text-center pt-4">
        <a href="update_pendaftar.php?id=<?= $id ?>" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-semibold shadow transition">
          ✏️ Edit Data
        </a>
        <a href="cetak.php?id=<?= $id ?>" target="_blank" class="inline-block bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg text-sm font-semibold shadow transition">
          🖨️ Cetak
        </a>

      </div>
    </div>
  </main>

  <footer class="bg-white p-4 text-center text-gray-500 text-sm mt-10">
    &copy; <?= date('Y'); ?> Sekolah Anda. Hak Cipta Dilindungi.
  </footer>

</body>

</html>