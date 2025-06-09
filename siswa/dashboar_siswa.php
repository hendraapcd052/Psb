<?php
// error_reporting(E_ALL); // Aktifkan ini untuk melihat error PHP selama pengembangan
// ini_set('display_errors', 1); // Aktifkan ini untuk menampilkan error di browser

// Koneksi ke database
// Pastikan nama database adalah 'dbpendaftaran' sesuai yang Anda sebutkan
$conn = new mysqli("localhost", "root", "", "dbpendaftaran");

// Cek koneksi database
if ($conn->connect_error) {
  // Lebih baik tidak menampilkan pesan error detail ke pengguna di production
  // Ganti dengan pesan user-friendly atau log errornya
  die("Koneksi gagal: Ada masalah dengan database. Silakan coba lagi nanti atau hubungi administrator.");
}

// Ambil pengumuman terbaru (jika ada tabel 'pengumuman' di database 'dbpendaftaran')
// Ini adalah bagian yang sebelumnya ada di kode Anda, diasumsikan tabelnya ada.
// Jika tidak ada, baris ini bisa dihapus atau disesuaikan.
$pengumuman = $conn->query("SELECT * FROM pengumuman ORDER BY tanggal DESC LIMIT 3");
// Anda bisa menambahkan penanganan error jika query gagal, misal:
// if (!$pengumuman) {
//     echo "Error mengambil pengumuman: " . $conn->error;
// }

?>

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>PSB - Pendaftaran Siswa Baru SD Negeri Karawaci 7</title>
  <link rel="icon" href="../gambar/logo.jpg" type="image/x-icon">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet" />
  <style>
    /* Global Styles */
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to bottom right, #e0f2fe, #e0f7fa);
      /* Light blue to light cyan gradient */
      color: #333;
      /* Darker default text color */
    }

    /* Navbar Styling */
    .bg-transparent-nav {
      background-color: transparent !important;
      transition: background-color 0.4s ease, box-shadow 0.4s ease;
    }

    .bg-solid-nav {
      background-color: #ffffff !important;
      /* White solid background for sticky nav */
      transition: background-color 0.4s ease, box-shadow 0.4s ease;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      /* Softer, more prominent shadow */
    }

    .nav-link {
      color: #4a5568;
      /* Darker gray for nav links */
      transition: color 0.3s ease;
    }

    .nav-link:hover {
      color: #2563eb;
      /* Blue-600 on hover */
    }

    .nav-button {
      background-color: #2563eb;
      /* Blue-600 for button */
      color: white;
      padding: 0.75rem 1.5rem;
      border-radius: 9999px;
      /* Fully rounded */
      transition: background-color 0.3s ease, transform 0.3s ease;
      box-shadow: 0 4px 8px rgba(227, 224, 224, 0.1);
    }

    .nav-button:hover {
      background-color: rgb(231, 233, 237);
      /* Blue-700 on hover */
      transform: translateY(-2px);
    }

    /* Hero Section Animations */
    @keyframes slideInLeft {
      0% {
        opacity: 0;
        transform: translateX(-50px);
      }

      100% {
        opacity: 1;
        transform: translateX(0);
      }
    }

    @keyframes slideInRight {
      0% {
        opacity: 0;
        transform: translateX(50px);
      }

      100% {
        opacity: 1;
        transform: translateX(0);
      }
    }

    .animate-slideInLeft {
      animation: slideInLeft 1s ease-out forwards;
      animation-delay: 0.2s;
      opacity: 0;
      /* Ensures starting hidden */
    }

    .animate-slideInRight {
      animation: slideInRight 1s ease-out forwards;
      animation-delay: 0.4s;
      opacity: 0;
      /* Ensures starting hidden */
    }

    /* Gallery Item Animation */
    .gallery-item-animation {
      position: relative;
      overflow: hidden;
      border: 2px solid transparent;
      /* Initial transparent border */
      transition: border-color 0.4s ease, transform 0.4s ease, box-shadow 0.4s ease;
      border-radius: 1rem;
      /* Rounded corners */
    }

    .gallery-item-animation::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      border: 2px solid transparent;
      transition: border-color 0.4s ease;
      pointer-events: none;
      /* Allows clicks on the image */
      border-radius: 1rem;
    }

    .gallery-item-animation:hover {
      transform: translateY(-8px) scale(1.02);
      /* Lifts and slightly scales up on hover */
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.25);
      /* Stronger, more spread out shadow */
    }

    .gallery-item-animation:hover::before {
      border-color: #3b82f6;
      /* Blue-500 border on hover */
    }

    /* Universal Section Shadow */
    section {
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
      /* Consistent, lighter shadow for sections */
    }

    /* Mobile Menu Specific Styling */
    #mobile-menu {
      transition: max-height 0.3s ease-out;
      overflow: hidden;
      max-height: 0;
      /* Start hidden */
      background-color: #2563eb;
      /* Blue-600 for mobile menu */
    }

    #mobile-menu.active {
      max-height: 300px;
      /* Adjust based on content height */
    }

    #mobile-menu a {
      padding: 0.75rem 0;
      display: block;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      color: white;
      /* White text for mobile menu links */
    }

    #mobile-menu a:last-child {
      border-bottom: none;
    }
  </style>
</head>

<body class="min-h-screen">

  <nav id="navbar" class="fixed w-full top-0 left-0 z-50 bg-transparent-nav">
    <div class="max-w-7xl mx-auto px-6 md:px-12">
      <div class="flex justify-between items-center h-20"> <a href="#home" class="text-blue-700 font-extrabold text-2xl tracking-wide transition-colors duration-300">SDN Karawaci 7</a>
        <ul class="hidden md:flex items-center space-x-10 font-semibold">
          <li><a href="#home" class="nav-link">Home</a></li>
          <li><a href="#about" class="nav-link">About</a></li>
          <li><a href="#galeri" class="nav-link">Galeri</a></li>
          <li><a href="pemberitahuan.php" class="nav-link">Pemberitahuan</a></li>
          <li><a href="#contact" class="nav-link">Contact</a></li>
          <li><a href="../pilihan_login.php" class="nav-button">Logout</a></li>
        </ul>
        <div class="md:hidden">
          <button id="btn-menu" aria-label="Menu" class="text-blue-700 focus:outline-none">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
              <path d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
          </button>
        </div>
      </div>
    </div>

    <div id="mobile-menu" class="md:hidden px-6 py-4 space-y-2">
      <a href="#home" class="block hover:text-blue-200 transition-colors duration-300">Home</a>
      <a href="#about" class="block hover:text-blue-200 transition-colors duration-300">About</a>
      <a href="#galeri" class="block hover:text-blue-200 transition-colors duration-300">Galeri</a>
      <a href="pemberitahuan.php" class="block hover:text-blue-200 transition-colors duration-300">Pemberitahuan</a>
      <a href="#contact" class="block hover:text-blue-200 transition-colors duration-300">Contact</a>
      <a href="../pilihan_login.php" class="block hover:text-blue-200 transition-colors duration-300">Logout</a>
    </div>
  </nav>

  <main class="max-w-7xl mx-auto px-6 md:px-12">

    <section id="home" class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center py-24 min-h-[calc(100vh-80px)]">
      <div class="animate-slideInLeft">
        <h1 class="text-6xl font-extrabold text-blue-800 mb-8 leading-tight">
          Daftarkan Diri Anda di <span class="text-blue-600">SD Negeri Karawaci 7</span>
        </h1>
        <p class="text-gray-700 text-xl mb-10 max-w-lg">
          Wujudkan masa depan cerah anak Anda bersama kami. Daftar sekarang dan jadilah bagian dari keluarga besar SD Negeri Karawaci 7.
        </p>
        <a href="formulir_pendaftaran.php" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold px-10 py-5 rounded-full shadow-lg transition transform hover:scale-105 duration-300 text-lg">
          Daftar Sekarang
        </a>
      </div>

      <div class="flex justify-center animate-slideInRight">
        <img src="http://localhost/dbpendaftaran/gambar/sekolah.jpg" alt="Gedung Sekolah SD Negeri Karawaci 7"
          class="w-full max-w-xl rounded-3xl shadow-2xl border-4 border-blue-100 transform hover:scale-105 transition-transform duration-500">
      </div>
    </section>



    <section id="about" class="py-20 px-8 md:px-16 bg-white rounded-3xl my-20">
      <h2 class="text-5xl font-bold text-blue-700 mb-12 text-center">🏫 Tentang SD Negeri Karawaci 7</h2>
      <div class="flex flex-col md:flex-row items-center gap-12">
        <div class="md:w-1/2 flex justify-center">
          <img src="http://localhost/dbpendaftaran/gambar/logo.jpg" alt="Logo SD Negeri Karawaci 7"
            class="w-full max-w-sm rounded-full shadow-xl border-4 border-blue-100">
        </div>
        <div class="md:w-1/2 text-gray-700 text-lg leading-relaxed">
          <p class="mb-6">
            SD Negeri Karawaci <br> adalah sekolah dasar negeri yang berlokasi strategis di Jl. Cibodas Raya, Perumnas 1, Karawaci Baru, Kota Tangerang. Berdiri sejak tahun **1982**, kami berkomitmen penuh di bawah naungan Dinas Pendidikan Kota Tangerang untuk menyediakan pendidikan berkualitas.
          </p>
          <p class="mb-6">
            Dengan sekitar **380 siswa** yang energik, sekolah kami didukung oleh **12 ruang kelas** yang nyaman, perpustakaan yang kaya literasi, dan fasilitas pendukung lainnya yang menunjang proses belajar-mengajar. Kami bangga telah **terakreditasi A**, menunjukkan standar pendidikan yang tinggi.
          </p>
          <p>
            Kami menerapkan **Kurikulum Merdeka** untuk mendorong kreativitas dan potensi unik setiap siswa. Meskipun terus beradaptasi dengan perkembangan teknologi, kami senantiasa berupaya meningkatkan kualitas pendidikan secara berkelanjutan demi masa depan cemerlang generasi penerus.
          </p>
        </div>
      </div>
    </section>



    <section id="galeri" class="py-20 px-8 md:px-16 my-20">
      <h2 class="text-5xl font-bold text-blue-700 mb-14 text-center">📸 Galeri Kegiatan Sekolah</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">
        <?php
        $gallery_images = [
          "http://localhost/dbpendaftaran/gambar/BeautyPlus_20240318155848203_save.jpg",
          "http://localhost/dbpendaftaran/gambar/BeautyPlus_20240504095916341_save.jpg",
          "http://localhost/dbpendaftaran/gambar/MARAWIS.jpeg.jpg",
          "http://localhost/dbpendaftaran/gambar/MELUKIS.jpeg.jpg",
          "http://localhost/dbpendaftaran/gambar/PRAMUKA.jpeg.jpg",
          "http://localhost/dbpendaftaran/gambar/SILAT.jpeg.jpg",
          "http://localhost/dbpendaftaran/gambar/MENARI.jpeg.jpg",
          "http://localhost/dbpendaftaran/gambar/MENARI.jpeg.jpg",
          "http://localhost/dbpendaftaran/gambar/MENARI.jpeg.jpg",
          "http://localhost/dbpendaftaran/gambar/MENARI.jpeg.jpg",
          "http://localhost/dbpendaftaran/gambar/MENARI.jpeg.jpg",
          "http://localhost/dbpendaftaran/gambar/MENARI.jpeg.jpg",
        ];
        foreach ($gallery_images as $img_src):
        ?>
          <div class="gallery-item-animation bg-white rounded-xl shadow-lg">
            <img src="<?= htmlspecialchars($img_src) ?>" alt="Galeri SD Negeri Karawaci 7" class="w-full h-64 object-cover object-center rounded-t-xl transition-transform duration-500 hover:scale-110">
          </div>
        <?php endforeach; ?>
      </div>
    </section>



    <section id="contact" class="py-20 px-8 md:px-16 my-20 bg-white rounded-3xl">
      <h2 class="text-5xl font-bold text-blue-700 mb-12 text-center">Hubungi Kami 👋</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-16 text-gray-700">
        <div class="space-y-8">
          <div>
            <h3 class="font-semibold text-2xl text-blue-800 mb-3">📍 Alamat</h3>
            <p class="text-lg">
              SD Negeri Karawaci 7 berlokasi di Jl. Cibodas Raya No.23, RT.001/RW.002, Kelurahan Karawaci Baru, Kecamatan Karawaci, Kota Tangerang.
            </p>
          </div>
          <div>
            <h3 class="font-semibold text-2xl text-blue-800 mb-3">📞 Telepon</h3>
            <p class="text-lg">+62 812 3456 7890</p>
          </div>
        </div>
        <div class="space-y-8">
          <div>
            <h3 class="font-semibold text-2xl text-blue-800 mb-3">📧 Email</h3>
            <p class="text-lg">sdn7karawaci@gmail.com</p>
          </div>
          <div>
            <h3 class="font-semibold text-2xl text-blue-800 mb-3">⏰ Jam Operasional</h3>
            <p class="text-lg">Senin sampai Jumat pada pukul 07.00 hingga 12.00 WIB</p>
          </div>
        </div>
      </div>

      <div class="mt-16 text-center">
        <h3 class="font-semibold text-2xl text-blue-700 mb-8">Ikuti Kami di Media Sosial!</h3>
        <div class="flex justify-center space-x-10 text-blue-600 text-4xl">
          <a href="https://wa.me/6281234567890" target="_blank" class="hover:text-green-500 transform hover:scale-125 transition-transform duration-300" aria-label="WhatsApp">
            <svg class="w-10 h-10 fill-current" viewBox="0 0 32 32">
              <path d="M16.02 2.004C8.84 2.004 2.91 7.935 2.91 15.12c0 2.72.73 5.24 2 7.44l-2.07 6.35 6.54-2.06c2.13 1.16 4.61 1.82 7.26 1.82 7.18 0 13.11-5.93 13.11-13.12s-5.93-13.12-13.11-13.12zM16.02 28.04c-2.37 0-4.57-.66-6.43-1.81l-.46-.28-3.88 1.23 1.2-3.77-.3-.48c-1.17-1.87-1.85-4.06-1.85-6.45 0-6.6 5.37-11.97 11.96-11.97s11.96 5.37 11.96 11.97-5.37 11.96-11.96 11.96z" />
              <path d="M22.12 18.78l-3.38-.93c-.44-.12-.9-.01-1.22.29l-.85.86c-1.8-.96-3.18-2.34-4.14-4.14l.86-.85c.31-.32.42-.78.29-1.22l-.93-3.38a1.27 1.27 0 00-1.24-.92c-.67 0-1.23.55-1.23 1.22 0 7.03 5.71 12.74 12.74 12.74.67 0 1.22-.56 1.22-1.23 0-.57-.38-1.07-.92-1.24z" />
            </svg>
          </a>
          <a href="https://facebook.com/sdn7karawaci" target="_blank" class="hover:text-blue-700 transform hover:scale-125 transition-transform duration-300" aria-label="Facebook">
            <svg class="w-10 h-10 fill-current" viewBox="0 0 24 24">
              <path d="M22.675 0h-21.35C.592 0 0 .592 0 1.325v21.351C0 23.408.592 24 1.325 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.894-4.788 4.659-4.788 1.325 0 2.463.099 2.794.143v3.24h-1.918c-1.505 0-1.797.716-1.797 1.767v2.318h3.587l-.467 3.622h-3.12V24h6.116C23.408 24 24 23.408 24 22.675V1.325C24 .592 23.408 0 22.675 0z" />
            </svg>
          </a>
          <a href="https://instagram.com/sdn7karawaci" target="_blank" class="hover:text-pink-500 transform hover:scale-125 transition-transform duration-300" aria-label="Instagram">
            <svg class="w-10 h-10 fill-current" viewBox="0 0 24 24">
              <path d="M12 2.163c3.204 0 3.584.012 4.849.07 1.366.062 2.633.332 3.608 1.308.974.975 1.245 2.242 1.308 3.608.058 1.265.07 1.645.07 4.849s-.012 3.584-.07 4.849c-.063 1.366-.334 2.633-1.308 3.608-.975.974-2.242 1.245-3.608 1.308-1.265.058-1.645.07-4.849.07s-3.584-.012-4.849-.07c-1.366-.063-2.633-.334-3.608-1.308-.974-.975-1.245-2.242-1.308-3.608C2.175 15.584 2.163 15.204 2.163 12s.012-3.584.07-4.849c.063-1.366.334-2.633 1.308-3.608.975-.974 2.242-1.245 3.608-1.308C8.416 2.175 8.796 2.163 12 2.163zm0-2.163C8.741 0 8.332.014 7.052.072 5.773.13 4.56.374 3.515 1.418 2.47 2.462 2.226 3.675 2.168 4.954.014 8.332 0 8.741 0 12s.014 3.668.072 4.948c.058 1.279.302 2.492 1.347 3.537 1.045 1.045 2.258 1.289 3.537 1.347C8.332 23.986 8.741 24 12 24s3.668-.014 4.948-.072c1.279-.058 2.492-.302 3.537-1.347C21.536.374 20.323.13 19.044.072 17.764.014 17.355 0 14.096 0H12z" />
              <path d="M12 5.838A6.162 6.162 0 0 0 5.838 12 6.162 6.162 0 0 0 12 18.162 6.162 6.162 0 0 0 18.162 12 6.162 6.162 0 0 0 12 5.838zm0 10.162A4 4 0 1 1 16 12a4.004 4.004 0 0 1-4 4z" />
              <circle cx="18.406" cy="5.594" r="1.44" />
            </svg>
          </a>
          <a href="mailto:sdn7karawaci@gmail.com" class="hover:text-red-500 transform hover:scale-125 transition-transform duration-300" aria-label="Email">
            <svg class="w-10 h-10 fill-current" viewBox="0 0 24 24">
              <path d="M12 12.713l11.985-9.713H0L12 12.713zM12 14.828l-12-9.827V21h24V5.001l-12 9.827z" />
            </svg>
          </a>
        </div>
      </div>
    </section>

  </main>

  <footer class="bg-blue-700 text-white py-10 mt-20 text-center">
    <div class="max-w-7xl mx-auto px-6 md:px-12">
      <p class="text-lg">&copy; 2025 SD Negeri Karawaci 7. All rights reserved.</p>
      <p class="text-sm mt-3">Dibuat dengan ❤️ untuk pendidikan.</p>
    </div>
  </footer>

  <script>
    const navbar = document.getElementById('navbar');
    const btnMenu = document.getElementById('btn-menu');
    const mobileMenu = document.getElementById('mobile-menu');
    const navLinks = document.querySelectorAll('#navbar ul a, #mobile-menu a'); // All nav links

    // Function to update navbar link colors based on state
    function updateNavbarLinkColors(isSolid) {
      navLinks.forEach(link => {
        // Apply color changes only to desktop nav links (within #navbar ul)
        if (link.closest('#navbar ul')) {
          if (isSolid) {
            link.style.color = '#4a5568'; // Dark gray when sticky
          } else {
            link.style.color = '#4a5568'; // Dark gray when transparent initially
          }
        }
      });
      // Specific colors for logo and mobile menu icon
      document.querySelector('#navbar a.font-extrabold').style.color = isSolid ? '#2563eb' : '#2563eb'; // Blue-600 for logo
      document.querySelector('#navbar button#btn-menu').style.color = isSolid ? '#2563eb' : '#2563eb'; // Blue-600 for mobile menu icon
    }

    // Toggle mobile menu
    btnMenu.addEventListener('click', () => {
      if (mobileMenu.classList.contains('hidden')) {
        mobileMenu.classList.remove('hidden'); // Remove hidden first
        setTimeout(() => {
          mobileMenu.classList.add('active'); // Then add active to trigger transition
        }, 10); // Small delay for reflow
      } else {
        mobileMenu.classList.remove('active'); // Remove active to start transition out
        setTimeout(() => {
          mobileMenu.classList.add('hidden'); // Add hidden after transition completes
        }, 300); // Matches CSS transition duration (0.3s)
      }
    });

    // Change navbar style on scroll
    window.addEventListener('scroll', () => {
      if (window.scrollY > 80) { // Increased scroll threshold for stickiness
        navbar.classList.add('bg-solid-nav');
        navbar.classList.remove('bg-transparent-nav');
        updateNavbarLinkColors(true); // Update colors for solid state
      } else {
        navbar.classList.add('bg-transparent-nav');
        navbar.classList.remove('bg-solid-nav');
        updateNavbarLinkColors(false); // Update colors for transparent state
      }
    });

    // Initialize navbar colors on page load (in case user refreshes when scrolled)
    window.addEventListener('load', () => {
      if (window.scrollY > 80) {
        updateNavbarLinkColors(true);
      } else {
        updateNavbarLinkColors(false);
      }
    });

    // Close mobile menu when a link is clicked
    mobileMenu.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', () => {
        mobileMenu.classList.add('hidden');
        mobileMenu.classList.remove('active');
      });
    });

    // Smooth scroll for all anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function(e) {
        e.preventDefault();

        // Get target element, accounting for fixed navbar height
        const targetId = this.getAttribute('href');
        const targetElement = document.querySelector(targetId);
        const navbarHeight = navbar.offsetHeight; // Get current navbar height

        if (targetElement) {
          const elementPosition = targetElement.getBoundingClientRect().top + window.scrollY;
          const offsetPosition = elementPosition - navbarHeight - 20; // Add some extra padding

          window.scrollTo({
            top: offsetPosition,
            behavior: 'smooth'
          });
        }
      });
    });

    // Intersection Observer for scroll-based animations (example usage)
    const slideInLeftElements = document.querySelectorAll('.animate-slideInLeft');
    const slideInRightElements = document.querySelectorAll('.animate-slideInRight');

    const observer = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = '1'; // Make it visible
          entry.target.style.transform = 'translateX(0)'; // Apply final transform
          entry.target.style.animationPlayState = 'running'; // Ensure animation runs
          observer.unobserve(entry.target); // Stop observing once animated
        }
      });
    }, {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    }); // Adjust threshold as needed

    // Observe elements
    slideInLeftElements.forEach(el => observer.observe(el));
    slideInRightElements.forEach(el => observer.observe(el));
  </script>

</body>

</html>

<?php
// Tutup koneksi database
if (isset($conn) && $conn instanceof mysqli) {
  $conn->close();
}
?>