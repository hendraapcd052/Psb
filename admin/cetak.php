<?php
$conn = new mysqli("localhost", "root", "", "dbpendaftaran");
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

if (!isset($_GET['id'])) {
  die("ID tidak ditemukan.");
}

$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM pendaftar WHERE id = $id LIMIT 1");

if ($result->num_rows == 0) {
  die("Data tidak ditemukan.");
}

$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Cetak Data Pendaftar</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      padding: 40px;
      background: #fff;
      color: #333;
    }

    .container {
      width: 800px;
      margin: auto;
      border: 1px solid #ccc;
      padding: 40px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .header {
      text-align: center;
      margin-bottom: 30px;
    }

    .header img {
      height: 90px;
      margin-bottom: 10px;
    }

    .header h1 {
      font-size: 22px;
      margin: 0;
    }

    .header p {
      margin: 2px 0;
    }

    h2 {
      text-align: center;
      margin-top: 0;
      margin-bottom: 30px;
      font-size: 20px;
      text-decoration: underline;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 30px;
    }

    td {
      border: 1px solid #cbd5e0; /* Tailwind gray-400 */
      padding: 8px;
      text-align: left;
    }

    .label {
      width: 220px;
      font-weight: bold;
    }

    .image-container {
      display: flex;
      justify-content: space-around;
      margin-top: 30px;
    }

    .image-box {
      text-align: center;
    }

    .image-box img {
      max-height: 150px;
      border: 1px solid #ccc;
      padding: 4px;
    }

    .ttd {
      text-align: right;
      margin-top: 60px;
      padding-right: 60px;
    }

    @media print {
      .no-print {
        display: none;
      }
    }
  </style>
</head>
<body>
  
  <div class="container">
    <div class="header">
      <img src="../gambar/logo.jpg" alt="Logo Sekolah">
      <h1>SEKOLAH DASAR NEGERI KARAWACI 7</h1>
      <p>SD Negeri Karawaci 7 berlokasi di Jl. Cibodas Raya No.23, RT.001/RW.002, Kelurahan Karawaci Baru, Kecamatan Karawaci, Kota Tangerang</p>
      <p>Telepon: (021) 12345678 | Email: sdn7karawaci@gmail.com</p>
    </div>

    <h2>Formulir Pendaftaran Siswa Baru</h2>

    <table class>
      <tr><td class="label">Nama Lengkap</td><td>: <?= htmlspecialchars($data['nama_lengkap']); ?></td></tr>
      <tr><td class="label">Tempat, Tanggal Lahir</td><td>: <?= htmlspecialchars($data['tempat_lahir']) . ', ' . date('d M Y', strtotime($data['tanggal_lahir'])); ?></td></tr>
      <tr><td class="label">Jenis Kelamin</td><td>: <?= htmlspecialchars($data['jenis_kelamin']); ?></td></tr>
      <tr><td class="label">Alamat</td><td>: <?= nl2br(htmlspecialchars($data['alamat'])); ?></td></tr>
      <tr><td class="label">Asal Sekolah</td><td>: <?= htmlspecialchars($data['asal_sekolah']); ?></td></tr>
      <tr><td class="label">Nama Ayah</td><td>: <?= htmlspecialchars($data['nama_ayah']); ?></td></tr>
      <tr><td class="label">Nama Ibu</td><td>: <?= htmlspecialchars($data['nama_ibu']); ?></td></tr>
      <tr><td class="label">No. HP Orang Tua</td><td>: <?= htmlspecialchars($data['no_hp']); ?></td></tr>
      <tr><td class="label">Status</td><td>: <?= htmlspecialchars($data['status']); ?></td></tr>
      <tr><td class="label">Tanggal Daftar</td><td>: <?= date('d M Y', strtotime($data['tanggal_daftar'])); ?></td></tr>
    </table>

    <div class="image-container">
      <div class="image-box">
        <strong>Foto Siswa</strong><br>
        <img src="<?= !empty($data['foto']) ? 'uploads/foto/' . htmlspecialchars($data['foto']) : 'https://via.placeholder.com/150?text=No+Foto'; ?>">
      </div>
      <div class="image-box">
        <strong>Poto KK</strong><br>
        <img src="<?= !empty($data['kk']) ? 'uploads/kk/' . htmlspecialchars($data['kk']) : 'https://via.placeholder.com/150?text=No+KK'; ?>">
      </div>
    </div>

    <div class="ttd">
      <p>Tangerang, <?= date('d M Y'); ?></p>
      <p>Kepala Sekolah</p>
      <br><br>
      <p><strong>Drs. Ahmad Subandi</strong></p>
      <p>NIP. 19650401 199003 1 001</p>
    </div>

    <div class="center no-print" style="text-align: center; margin-top: 40px;">
      <button onclick="window.print()" style="padding: 10px 20px; font-size: 16px; cursor: pointer;">🖨️ Cetak Halaman</button>
      <div class="fixed top-4 right-4 z-50">
    <a href="dashboard.php" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold px-4 py-2 rounded shadow-md transition duration-300">
      ⬅ Kembali
    </a>
  </div>
    </div>
  </div>
</body>
</html>