<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "dbpendaftaran");

if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ID dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
  // Ambil data untuk mengetahui nama file foto dan kk
  $sqlGet = "SELECT foto, kk FROM pendaftar WHERE id = $id";
  $result = $conn->query($sqlGet);

  if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();

    // Hapus file foto jika ada
    if (!empty($data['foto']) && file_exists("uploads/foto/" . $data['foto'])) {
      unlink("uploads/foto/" . $data['foto']);
    }

    // Hapus file KK jika ada
    if (!empty($data['kk']) && file_exists("uploads/kk/" . $data['kk'])) {
      unlink("uploads/kk/" . $data['kk']);
    }

    // Hapus data dari database
    $sqlDelete = "DELETE FROM pendaftar WHERE id = $id";
    if ($conn->query($sqlDelete) === TRUE) {
      header("Location: data_pendaftar.php?msg=deleted");
      exit();
    } else {
      echo "Gagal menghapus data: " . $conn->error;
    }
  } else {
    echo "Data tidak ditemukan.";
  }
} else {
  echo "ID tidak valid.";
}

$conn->close();
?>
