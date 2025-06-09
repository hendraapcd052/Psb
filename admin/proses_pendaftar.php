<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "dbpendaftaran");

// Cek koneksi
if ($koneksi->connect_error) {
  die("Koneksi gagal: " . $koneksi->connect_error);
}

// Ambil data dari form
$nama_lengkap   = $_POST['nama_lengkap'];
$jenis_kelamin  = $_POST['jenis_kelamin'];
$tempat_lahir   = $_POST['tempat_lahir'];
$tanggal_lahir  = $_POST['tanggal_lahir'];
$alamat         = $_POST['alamat'];
$asal_sekolah   = $_POST['asal_sekolah'];
$nisn           = $_POST['nisn'];
$nama_ayah      = $_POST['nama_ayah'];
$nama_ibu       = $_POST['nama_ibu'];
$no_hp          = $_POST['no_hp'];
$email          = $_POST['email'];

// Tambahkan tanggal daftar (tanggal hari ini)
$tanggal_daftar = date('Y-m-d'); // Format: 2025-06-03

// Upload file
$foto_name = $_FILES['foto']['name'];
$kk_name   = $_FILES['kk']['name'];
$foto_tmp  = $_FILES['foto']['tmp_name'];
$kk_tmp    = $_FILES['kk']['tmp_name'];

$foto_dir = "uploads/foto/";
$kk_dir   = "uploads/kk/";

if (!is_dir($foto_dir)) mkdir($foto_dir, 0777, true);
if (!is_dir($kk_dir)) mkdir($kk_dir, 0777, true);

// Simpan file
$foto_path = $foto_dir . basename($foto_name);
$kk_path = $kk_dir . basename($kk_name);

if (move_uploaded_file($foto_tmp, $foto_path) && move_uploaded_file($kk_tmp, $kk_path)) {
  // Simpan data ke database (dengan tanggal_daftar)
  $sql = "INSERT INTO pendaftar 
    (nama_lengkap, jenis_kelamin, tempat_lahir, tanggal_lahir, nisn, asal_sekolah, alamat, 
    nama_ayah, nama_ibu, no_hp, email, foto, kk, tanggal_daftar) 
    VALUES (
      '$nama_lengkap', '$jenis_kelamin', '$tempat_lahir', '$tanggal_lahir', 
      '$nisn', '$asal_sekolah', '$alamat', 
      '$nama_ayah', '$nama_ibu', '$no_hp', '$email', '$foto_name', '$kk_name', '$tanggal_daftar'
    )";

  if ($koneksi->query($sql) === TRUE) {
    echo "<script>
      alert('✅ Data berhasil disimpan!\\nSilakan tunggu informasi selanjutnya.');
      window.history.back();
    </script>";
  } else {
    echo "<script>
      alert('❌ Gagal menyimpan ke database!');
      window.history.back();
    </script>";
  }
}

$koneksi->close();
