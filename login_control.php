<?php
session_start();
include 'config/koneksi.php'; // sesuaikan path jika folder berbeda

// Ambil data dari form
$username = $_POST['username'];
$password = $_POST['password'];

// Cek user di database
$query = "SELECT * FROM users WHERE username = ?";
$stmt = $koneksi->prepare($query); // pakai $koneksi, bukan $conn
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
  $user = $result->fetch_assoc();

  // Verifikasi password
  if (password_verify($password, $user['password'])) {
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'] ?? 'admin';

    // Redirect ke halaman dashboard
    header("Location: http://localhost/dbpendaftaran/admin/dashboard.php");
    exit;
  } else {
    echo "<script>alert('Password salah!'); window.location.href='login.php';</script>";
  }
} else {
  echo "<script>alert('Username tidak ditemukan!'); window.location.href='login_admin.php';</script>";
}
