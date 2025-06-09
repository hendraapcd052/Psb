<?php
$host = "localhost";     // biasanya localhost
$user = "root";          // default user XAMPP/MySQL
$pass = "";              // kosong kalau di XAMPP
$db   = "dbpendaftaran";           // nama database kamu

$koneksi = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}
?>
