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
$pesan = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Ambil input teks
  $nama_lengkap = $_POST['nama_lengkap'];
  $email = $_POST['email'];
  $jenis_kelamin = $_POST['jenis_kelamin'];
  $tempat_lahir = $_POST['tempat_lahir'];
  $tanggal_lahir = $_POST['tanggal_lahir'];
  $alamat = $_POST['alamat'];
  $asal_sekolah = $_POST['asal_sekolah'];
  $nama_ayah = $_POST['nama_ayah'];
  $nama_ibu = $_POST['nama_ibu'];
  $no_hp = $_POST['no_hp'];
  $status = $_POST['status'];

  // Upload foto baru jika ada
  $foto = $data['foto'];
  if (!empty($_FILES['foto']['name'])) {
    $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png'])) {
      $foto = uniqid() . '.' . $ext;
      move_uploaded_file($_FILES['foto']['tmp_name'], 'uploads/foto/' . $foto);
    }
  }

  // Upload KK baru jika ada
  $kk = $data['kk'];
  if (!empty($_FILES['kk']['name'])) {
    $ext = pathinfo($_FILES['kk']['name'], PATHINFO_EXTENSION);
    if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'pdf'])) {
      $kk = uniqid() . '.' . $ext;
      move_uploaded_file($_FILES['kk']['tmp_name'], 'uploads/kk/' . $kk);
    }
  }

  // Simpan perubahan
  $stmt = $conn->prepare("UPDATE pendaftar SET nama_lengkap=?, email=?, jenis_kelamin=?, tempat_lahir=?, tanggal_lahir=?, alamat=?, asal_sekolah=?, nama_ayah=?, nama_ibu=?, no_hp=?, status=?, foto=?, kk=? WHERE id=?");
  $stmt->bind_param("sssssssssssssi", $nama_lengkap, $email, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $alamat, $asal_sekolah, $nama_ayah, $nama_ibu, $no_hp, $status, $foto, $kk, $id);

 if ($stmt->execute()) {
    header("Location: detail_pendaftar.php?id=$id&update=success");
    exit;
  } else {
    $pesan = "<div class='bg-red-100 text-red-800 p-3 rounded'>Gagal menyimpan data.</div>";
  }

}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Pendaftar</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
  <div class="max-w-4xl mx-auto py-10 px-6">
    <div class="bg-white p-8 rounded-lg shadow-lg">
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-blue-700">✏️ Edit Data Pendaftar</h1>
        <a href="detail_pendaftar.php?id=<?= $id ?>" class="text-sm text-blue-600 hover:underline">← Kembali</a>
      </div>

      <?= $pesan ?>

      <form method="post" enctype="multipart/form-data" class="space-y-6">
        <div class="grid md:grid-cols-2 gap-6">
          <div>
            <label class="block font-semibold mb-1">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" value="<?= htmlspecialchars($data['nama_lengkap']) ?>" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" required>
          </div>
          <div>
            <label class="block font-semibold mb-1">Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($data['email']) ?>" class="w-full border rounded px-3 py-2" required>
          </div>
          <div>
            <label class="block font-semibold mb-1">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="w-full border rounded px-3 py-2">
              <option value="Laki-laki" <?= $data['jenis_kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
              <option value="Perempuan" <?= $data['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
            </select>
          </div>
          <div>
            <label class="block font-semibold mb-1">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" value="<?= htmlspecialchars($data['tempat_lahir']) ?>" class="w-full border rounded px-3 py-2">
          </div>
          <div>
            <label class="block font-semibold mb-1">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" value="<?= $data['tanggal_lahir'] ?>" class="w-full border rounded px-3 py-2">
          </div>
          <div>
            <label class="block font-semibold mb-1">Asal Sekolah</label>
            <input type="text" name="asal_sekolah" value="<?= htmlspecialchars($data['asal_sekolah']) ?>" class="w-full border rounded px-3 py-2">
          </div>
          <div>
            <label class="block font-semibold mb-1">Nama Ayah</label>
            <input type="text" name="nama_ayah" value="<?= htmlspecialchars($data['nama_ayah']) ?>" class="w-full border rounded px-3 py-2">
          </div>
          <div>
            <label class="block font-semibold mb-1">Nama Ibu</label>
            <input type="text" name="nama_ibu" value="<?= htmlspecialchars($data['nama_ibu']) ?>" class="w-full border rounded px-3 py-2">
          </div>
          <div>
            <label class="block font-semibold mb-1">No. HP Orang Tua</label>
            <input type="text" name="no_hp" value="<?= htmlspecialchars($data['no_hp']) ?>" class="w-full border rounded px-3 py-2">
          </div>
          <div>
            <label class="block font-semibold mb-1">Status</label>
            <select name="status" class="w-full border rounded px-3 py-2">
              <option value="Pending" <?= $data['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
              <option value="Terverifikasi" <?= $data['status'] == 'Terverifikasi' ? 'selected' : '' ?>>Terverifikasi</option>
            </select>
          </div>
        </div>

        <div>
          <label class="block font-semibold mb-1">Alamat</label>
          <textarea name="alamat" rows="3" class="w-full border rounded px-3 py-2"><?= htmlspecialchars($data['alamat']) ?></textarea>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
          <div>
            <label class="block font-semibold mb-1">Foto</label>
            <img src="<?= !empty($data['foto']) ? 'uploads/foto/' . $data['foto'] : 'https://via.placeholder.com/150?text=No+Foto'; ?>" alt="Foto" class="w-32 h-32 object-cover rounded border mb-2">
            <input type="file" name="foto" accept=".jpg,.jpeg,.png" class="w-full border rounded px-3 py-2">
          </div>
          <div>
            <label class="block font-semibold mb-1">Kartu Keluarga (KK)</label>
            <img src="<?= !empty($data['kk']) ? 'uploads/kk/' . $data['kk'] : 'https://via.placeholder.com/150?text=No+KK'; ?>" alt="KK" class="w-32 h-32 object-cover rounded border mb-2">
            <input type="file" name="kk" accept=".jpg,.jpeg,.png,.pdf" class="w-full border rounded px-3 py-2">
          </div>
        </div>

        <div class="text-right">
          <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow">
            💾 Simpan Perubahan
          </button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
