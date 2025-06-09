<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Formulir Pendaftaran Siswa</title>
    <link rel="icon" href="../gambar/logo.jpg" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
            /* Gradien latar belakang yang lebih lembut dan hangat */
            background: linear-gradient(to bottom right, #e0f7fa, #e8f5e9); /* Biru muda ke hijau muda */
        }

        /* Styling fokus untuk input, select, textarea */
        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #60a5fa; /* blue-400 */
            box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.45); /* Shadow yang lebih jelas */
        }

        /* Styling hover untuk input agar ada indikasi interaksi */
        input:not(:focus):hover,
        select:not(:focus):hover,
        textarea:not(:focus):hover {
            border-color: #93c5fd; /* blue-300 */
        }

        /* Custom scrollbar untuk elemen yang mungkin membutuhkan scroll (jika ada) */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1; /* gray-300 */
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8; /* gray-400 */
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center px-4 py-12">
    <div class="bg-white shadow-xl rounded-3xl max-w-4xl w-full p-8 md:p-10 lg:p-12 space-y-8 transform transition-transform duration-300 hover:scale-[1.005]">
        <div class="text-center">
            <h1 class="text-4xl lg:text-5xl font-extrabold text-blue-800 mb-3 animate-fade-in-down">Formulir Pendaftaran Siswa</h1>
            <p class="text-gray-600 text-lg animate-fade-in-up">Wujudkan masa depan cerah anak Anda bersama kami!</p>
        </div>

        <form action="../admin/proses_pendaftar.php" method="POST" enctype="multipart/form-data" class="space-y-10">

            <div class="bg-blue-50 p-6 rounded-2xl shadow-inner-custom">
                <h2 class="text-2xl font-bold text-blue-700 border-b-2 border-blue-200 pb-3 mb-6 flex items-center">
                    <span class="mr-2">🧍</span> Data Pribadi
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nama_lengkap" class="block mb-2 font-medium text-gray-700 text-sm">Nama Lengkap</label>
                        <input type="text" id="nama_lengkap" name="nama_lengkap" required placeholder="Contoh: Andi Saputra"
                            class="w-full border border-gray-300 rounded-xl p-3 text-gray-800 focus:ring-blue-400 focus:border-blue-400 transition duration-200 shadow-sm" />
                    </div>
                    <div>
                        <label for="jenis_kelamin" class="block mb-2 font-medium text-gray-700 text-sm">Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin" required
                            class="w-full border border-gray-300 rounded-xl p-3 text-gray-800 focus:ring-blue-400 focus:border-blue-400 transition duration-200 shadow-sm">
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label for="tempat_lahir" class="block mb-2 font-medium text-gray-700 text-sm">Tempat Lahir</label>
                        <input type="text" id="tempat_lahir" name="tempat_lahir" required
                            class="w-full border border-gray-300 rounded-xl p-3 text-gray-800 focus:ring-blue-400 focus:border-blue-400 transition duration-200 shadow-sm" />
                    </div>
                    <div>
                        <label for="tanggal_lahir" class="block mb-2 font-medium text-gray-700 text-sm">Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" required
                            class="w-full border border-gray-300 rounded-xl p-3 text-gray-800 focus:ring-blue-400 focus:border-blue-400 transition duration-200 shadow-sm" />
                    </div>
                    <div class="md:col-span-2">
                        <label for="alamat" class="block mb-2 font-medium text-gray-700 text-sm">Alamat Lengkap</label>
                        <textarea id="alamat" name="alamat" rows="3" required placeholder="Jalan, Kelurahan, Kecamatan, Kota/Kabupaten..."
                            class="w-full border border-gray-300 rounded-xl p-3 text-gray-800 focus:ring-blue-400 focus:border-blue-400 transition duration-200 shadow-sm resize-y"></textarea>
                    </div>
                    <div>
                        <label for="asal_sekolah" class="block mb-2 font-medium text-gray-700 text-sm">Asal Sekolah</label>
                        <input type="text" id="asal_sekolah" name="asal_sekolah" required
                            class="w-full border border-gray-300 rounded-xl p-3 text-gray-800 focus:ring-blue-400 focus:border-blue-400 transition duration-200 shadow-sm" />
                    </div>
                    <div>
                        <label for="nisn" class="block mb-2 font-medium text-gray-700 text-sm">NISN</label>
                        <input type="text" id="nisn" name="nisn" pattern="\d*" maxlength="20" title="Masukkan hanya angka" required
                            class="w-full border border-gray-300 rounded-xl p-3 text-gray-800 focus:ring-blue-400 focus:border-blue-400 transition duration-200 shadow-sm" />
                    </div>
                </div>
            </div>

            <div class="bg-green-50 p-6 rounded-2xl shadow-inner-custom">
                <h2 class="text-2xl font-bold text-green-700 border-b-2 border-green-200 pb-3 mb-6 flex items-center">
                    <span class="mr-2">👪</span> Data Orang Tua
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nama_ayah" class="block mb-2 font-medium text-gray-700 text-sm">Nama Ayah</label>
                        <input type="text" id="nama_ayah" name="nama_ayah" required
                            class="w-full border border-gray-300 rounded-xl p-3 text-gray-800 focus:ring-green-400 focus:border-green-400 transition duration-200 shadow-sm" />
                    </div>
                    <div>
                        <label for="nama_ibu" class="block mb-2 font-medium text-gray-700 text-sm">Nama Ibu</label>
                        <input type="text" id="nama_ibu" name="nama_ibu" required
                            class="w-full border border-gray-300 rounded-xl p-3 text-gray-800 focus:ring-green-400 focus:border-green-400 transition duration-200 shadow-sm" />
                    </div>
                    <div>
                        <label for="no_hp" class="block mb-2 font-medium text-gray-700 text-sm">No. HP Orang Tua</label>
                        <input type="tel" id="no_hp" name="no_hp" required placeholder="Contoh: 081234567890"
                            class="w-full border border-gray-300 rounded-xl p-3 text-gray-800 focus:ring-green-400 focus:border-green-400 transition duration-200 shadow-sm" />
                    </div>
                    <div>
                        <label for="email" class="block mb-2 font-medium text-gray-700 text-sm">Email (opsional)</label>
                        <input type="email" id="email" name="email" placeholder="contoh@email.com"
                            class="w-full border border-gray-300 rounded-xl p-3 text-gray-800 focus:ring-green-400 focus:border-green-400 transition duration-200 shadow-sm" />
                    </div>
                </div>
            </div>

            <div class="bg-purple-50 p-6 rounded-2xl shadow-inner-custom">
                <h2 class="text-2xl font-bold text-purple-700 border-b-2 border-purple-200 pb-3 mb-6 flex items-center">
                    <span class="mr-2">📎</span> Upload Dokumen
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="foto" class="block mb-2 font-medium text-gray-700 text-sm">Foto 3x4 (JPG/PNG)</label>
                        <input type="file" id="foto" name="foto" accept="image/jpeg,image/png"
                            class="w-full border border-gray-300 rounded-xl p-3 text-gray-800 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-100 file:text-purple-700 hover:file:bg-purple-200 transition duration-200 shadow-sm" />
                        <p class="text-xs text-gray-500 mt-1">Ukuran maksimal 2MB. Format: JPG, PNG.</p>
                    </div>
                    <div>
                        <label for="kk" class="block mb-2 font-medium text-gray-700 text-sm">Kartu Keluarga (PDF/JPG)</label>
                        <input type="file" id="kk" name="kk" accept=".pdf,image/jpeg,image/png"
                            class="w-full border border-gray-300 rounded-xl p-3 text-gray-800 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-100 file:text-purple-700 hover:file:bg-purple-200 transition duration-200 shadow-sm" />
                        <p class="text-xs text-gray-500 mt-1">Ukuran maksimal 5MB. Format: PDF, JPG, PNG.</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row justify-between items-center pt-8 space-y-4 sm:space-y-0">
                <a href="dashboar_siswa.php"
                    class="text-blue-600 hover:text-blue-800 transition font-medium text-lg flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                    Kembali ke Beranda
                </a>
                <button type="submit"
                    class="bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 text-white px-8 py-3 rounded-full font-bold shadow-lg transform hover:scale-105 transition duration-300 ease-in-out flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    Kirim Pendaftaran
                </button>
            </div>
        </form>
    </div>
</body>

</html>