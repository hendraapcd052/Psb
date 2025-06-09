<?php
include 'config/koneksi.php';

$username = 'admin';
$password_plain = 'admin'; // password asli
$password_hash = password_hash($password_plain, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, password, role) VALUES (?, ?, 'admin')";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("ss", $username, $password_hash);

if ($stmt->execute()) {
    echo "User berhasil ditambahkan!";
} else {
    echo "Gagal: " . $stmt->error;
}
?>
