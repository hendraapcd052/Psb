<?php
// Koneksi database
$conn = new mysqli("localhost", "root", "", "dbpendaftaran");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses tambah pengumuman
$message = '';
$error = '';

if (isset($_POST['submit'])) {
    $judul = $conn->real_escape_string($_POST['judul']);
    $isi = $conn->real_escape_string($_POST['isi']);
    $tanggal = date('Y-m-d');

    $sql = "INSERT INTO pengumuman (judul, isi, tanggal) VALUES ('$judul', '$isi', '$tanggal')";
    if ($conn->query($sql)) {
        $message = "Pengumuman berhasil ditambahkan!";
    } else {
        $error = "Gagal menambahkan pengumuman: " . $conn->error;
    }
}

// Proses hapus pengumuman
if (isset($_GET['hapus'])) {
    $id_hapus = intval($_GET['hapus']);
    $sql = "DELETE FROM pengumuman WHERE id = $id_hapus";
    if ($conn->query($sql)) {
        header("Location: pengumuman.php"); // Redirect untuk menghindari resubmission form
        exit;
    } else {
        $error = "Gagal menghapus pengumuman: " . $conn->error;
    }
}

// Ambil data pengumuman
$result = $conn->query("SELECT * FROM pengumuman ORDER BY tanggal DESC");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Manajemen Pengumuman - Admin PSB</title>
    <link rel="icon" href="../gambar/logo.jpg" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom styles untuk warna primary jika dibutuhkan, atau bisa langsung pakai Tailwind */
        .text-primary {
            color: #4F46E5; /* Contoh warna ungu */
        }
        .focus\:ring-primary:focus {
            --tw-ring-color: #4F46E5;
        }
        .bg-primary {
            background-color: #4F46E5;
        }
        .hover\:bg-primary-dark:hover {
            background-color: #4338CA; /* Warna sedikit lebih gelap dari primary */
        }
        .btn-red {
            background-color: #EF4444;
            color: white;
            padding: 8px 16px;
            border-radius: 0.25rem;
            transition: background-color 0.2s ease-in-out;
        }
        .btn-red:hover {
            background-color: #DC2626;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-indigo-50 to-purple-100 min-h-screen p-6 font-sans">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-lg border border-gray-100">
        <h1 class="text-3xl font-extrabold mb-6 text-center text-primary">Manajemen Pengumuman</h1>

        <?php if ($message) : ?>
            <div id="alert" class="bg-green-50 border border-green-300 text-green-700 px-4 py-3 rounded-lg relative mb-6 shadow-sm" role="alert">
                <strong class="font-semibold">Berhasil!</strong> <span class="block sm:inline"><?= $message ?></span>
            </div>
        <?php endif; ?>
        <?php if ($error) : ?>
            <div class="bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded-lg relative mb-6 shadow-sm" role="alert">
                <strong class="font-semibold">Error!</strong> <span class="block sm:inline"><?= $error ?></span>
            </div>
        <?php endif; ?>

        <hr class="mb-8 border-gray-200" />

        <h2 class="text-2xl font-bold mb-5 text-gray-800">Tambah Pengumuman Baru</h2>
        <form method="POST" class="mb-10 p-6 border border-gray-200 rounded-lg bg-gray-50 shadow-sm">
            <div class="mb-5">
                <label for="judul" class="block text-gray-700 font-medium mb-2">Judul Pengumuman</label>
                <input type="text" id="judul" name="judul" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200"
                    placeholder="Masukkan judul pengumuman" />
            </div>

            <div class="mb-6">
                <label for="isi" class="block text-gray-700 font-medium mb-2">Isi Pengumuman</label>
                <textarea id="isi" name="isi" rows="6" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200 resize-y"
                    placeholder="Tuliskan isi pengumuman di sini..."></textarea>
            </div>

            <div class="flex flex-col sm:flex-row gap-4">
                <button type="submit" name="submit"
                    class="flex-1 bg-primary text-white font-semibold px-6 py-3 rounded-lg shadow-md hover:bg-primary-dark transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                    <svg class="inline-block w-5 h-5 mr-2 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Tambah Pengumuman
                </button>
                <a href="dashboard.php"
                    class="flex-1 text-center bg-gray-200 text-gray-800 font-semibold px-6 py-3 rounded-lg shadow-md hover:bg-gray-300 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">
                    <svg class="inline-block w-5 h-5 mr-2 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Dashboard
                </a>
            </div>
        </form>

        <hr class="mb-8 border-gray-200" />

        <h2 class="text-2xl font-bold mb-5 text-gray-800">Daftar Pengumuman</h2>
        <div class="space-y-6">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm hover:shadow-md transition duration-200">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="font-bold text-xl text-gray-900 leading-tight"><?= htmlspecialchars($row['judul']) ?></h3>
                            <a href="pengumuman.php?hapus=<?= $row['id'] ?>"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini secara permanen?')"
                                class="btn-red flex items-center text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                Hapus
                            </a>
                        </div>
                        <p class="text-gray-700 mt-2 leading-relaxed whitespace-pre-line"><?= nl2br(htmlspecialchars($row['isi'])) ?></p>
                        <small class="text-gray-500 mt-3 block text-sm italic">Diposting pada: <?= date('d F Y', strtotime($row['tanggal'])) ?></small>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="bg-gray-100 border border-gray-200 text-gray-600 px-6 py-4 rounded-lg text-center italic">
                    <p>Belum ada pengumuman yang ditambahkan.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Alert otomatis hilang setelah 3 detik
        setTimeout(() => {
            const alert = document.getElementById('alert');
            if (alert) {
                alert.style.transition = 'opacity 0.5s ease-out';
                alert.style.opacity = '0';
                setTimeout(() => alert.style.display = 'none', 500); // Sembunyikan setelah transisi selesai
            }
        }, 3000);
    </script>
</body>

</html>

<?php $conn->close(); ?>