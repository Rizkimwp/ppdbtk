<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>PPDB SMPIT QUR'AN Daar El-Muflihin</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" />
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

    <style>
        /* Wrapper untuk menampung gambar dan ornamen */
        .img-hero-wrapper {
            position: relative;
            z-index: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
            /* Ruang untuk ornamen keluar jalur */
        }

        /* Gambar Utama (Kyai) */
        .main-hero-img {
            position: relative;
            z-index: 10;
            /* Pastikan gambar ada di paling depan */
            /* Memberikan efek bayangan agar gambar terlihat 'muncul' */
            filter: drop-shadow(0px 15px 30px rgba(13, 110, 253, 0.3));
            max-height: 550px;
            /* Menjaga agar tidak terlalu besar di layar lebar */
            width: auto;
        }

        /* Instrumen 1: Bentuk Abstrak Biru Besar di belakang */
        .instrument-blob-1 {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 120%;
            height: 120%;
            /* Membuat bentuk organik yang tidak beraturan */
            border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
            background: linear-gradient(45deg, #cfe2ff, #e0cfff);
            opacity: 0.6;
            z-index: 5;
            animation: morphing 15s ease-in-out infinite;
            /* Animasi bergerak halus */
        }

        /* Instrumen 2: Lingkaran Cahaya Kuning/Emas (Kesan Islami/Suci) */
        .instrument-glow {
            position: absolute;
            top: 10%;
            right: 10%;
            width: 150px;
            height: 150px;
            background: radial-gradient(circle, rgba(255, 223, 126, 0.6) 0%, rgba(255, 255, 255, 0) 70%);
            border-radius: 50%;
            z-index: 6;
        }

        /* Instrumen 3: Pola Titik-titik Modern */
        .instrument-dots {
            position: absolute;
            bottom: -20px;
            left: -20px;
            width: 100px;
            height: 100px;
            background-image: radial-gradient(rgba(13, 110, 253, 0.4) 2px, transparent 2px);
            background-size: 15px 15px;
            z-index: 4;
        }

        /* 1. Wrapper baru untuk membuat bentuk lingkaran */
        .image-circle-frame {
            position: relative;
            z-index: 10;
            /* Pastikan berada di atas instrumen background */
            width: 450px;
            /* Tentukan ukuran lebar lingkaran */
            height: 450px;
            /* Tinggi harus sama dengan lebar agar jadi bulat sempurna */
            border-radius: 50%;
            /* Kunci untuk membuat bentuk bulat */
            overflow: hidden;
            /* Memotong bagian gambar yang keluar dari lingkaran */

            /* Desain Bingkai */
            border: 8px solid #ffffff;
            /* Warna dan ketebalan bingkai putih */
            box-shadow: 0 15px 35px rgba(13, 110, 253, 0.2);
            /* Bayangan lembut di luar bingkai */

            /* Agar posisi di tengah */
            margin: auto;
        }

        /* 2. Update style untuk gambar di dalamnya */
        .main-hero-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* PENTING: Agar gambar mengisi lingkaran tanpa gepeng/terdistorsi */

            /* HAPUS atau KOMENTARI filter drop-shadow yang lama karena kita sudah pakai box-shadow di frame */
            /* filter: drop-shadow(0px 15px 30px rgba(13, 110, 253, 0.3)); */
        }

        /* 3. Responsif untuk layar HP (agar lingkaran tidak kegedean) */
        @media (max-width: 768px) {
            .image-circle-frame {
                width: 320px;
                height: 320px;
                border-width: 5px;
                /* Bingkai sedikit lebih tipis di HP */
            }
        }

        /* Animasi agar bentuk belakang bergerak lambat */
        @keyframes morphing {
            0% {
                border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
            }

            50% {
                border-radius: 60% 40% 30% 70% / 60% 50% 40% 50%;
            }

            100% {
                border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
            }
        }

        /* Responsif di HP */
        @media (max-width: 768px) {
            .img-hero-wrapper {
                padding: 10px;
            }

            .instrument-blob-1 {
                width: 100%;
                height: 100%;
            }

            .main-hero-img {
                max-height: 400px;
            }
        }
    </style>
</head>

<body class="index-page">
    <header id="header" class="header d-flex align-items-center sticky-top bg-white shadow-sm">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center me-auto">
                <img src="assets/images/logo.png" alt="Logo Daar El-Muflihin" class="me-2"
                    style="max-height: 50px; width: auto;">

                <h1 class="sitename fw-bold text-success mb-0" style="font-size: 1.5rem; letter-spacing: 0.5px;">
                    SMPIT QUR'AN Daar El-Muflihin
                </h1>
            </a>
            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Beranda</a></li>
                    <li><a href="#visi-misi">Visi & Misi</a></li>
                    <li><a href="#program">Program</a></li>
                    <li><a href="#kegiatan">Kegiatan</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
            <a class="ms-4 btn-login rounded-pill px-4 py-2 shadow-sm" href="{{ route('login') }}">Pendaftaran</a>
        </div>
    </header>

    <main class="main">


        <section id="hero" class="hero section position-relative overflow-hidden py-5"
            style="background: linear-gradient(135deg, #f0f8ff 0%, #ffffff 100%);">

            <div
                style="position: absolute; top:0; left:0; width:100%; height:100%; opacity: 0.05; background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cpath d=\'M30 0l15 30-15 30L0 30z\' fill=\'%230d6efd\' fill-rule=\'evenodd\'/%3E%3C/svg%3E'); z-index: 0;">
            </div>

            <div class="position-relative z-2 container">
                <div class="row gy-5 align-items-center">
                    <div class="col-lg-6 order-lg-last" data-aos="zoom-out">
                        <div class="img-hero-wrapper animated">
                            <div class="instrument-blob-1"></div>
                            <div class="instrument-glow"></div>
                            <div class="instrument-dots"></div>

                            <div class="image-circle-frame">
                                <img src="{{ 'assets/images/jumbotron.jpg' }}" class="img-fluid main-hero-img"
                                    alt="Sosok Kyai Panutan">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 text-md-start text-center">
                        <h2 class="display-4 fw-bold mb-3" data-aos="fade-up">
                            Membentuk Generasi
                            <span class="text-primary" style="position: relative; display: inline-block;">
                                Berakhlak & Cerdas
                                <svg style="position: absolute; bottom: -10px; left: 0; width: 100%; height: 10px;" viewBox="0 0 200 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 15 Q 50 0 100 15 T 195 15" fill="none" stroke="#0d6efd" stroke-width="3" stroke-linecap="round" />
                                </svg>
                            </span>
                        </h2>

                        @if($hasOpen)
                            <div data-aos="fade-up" data-aos-delay="100">
                                <p class="lead text-muted mb-1">
                                    Penerimaan Peserta Didik Baru (PPDB) <br> SMP IT Daar El-Muflihin
                                </p>
                                <h4 class="fw-bold text-dark mb-1">
                                    Tahun Ajaran {{ $tahunAjaran->tahun_ajaran }} - {{ $gelombang->name }}
                                </h4>

                                <p class="text-primary fw-medium mb-3">
                                    <i class="bi bi-calendar-check me-1"></i>
                                    Periode: {{ \Carbon\Carbon::parse($gelombang->start_date)->translatedFormat('d F Y') }}
                                    s/d
                                    {{ \Carbon\Carbon::parse($gelombang->end_date)->translatedFormat('d F Y') }}
                                </p>

                                <p class="text-secondary mb-4">
                                    Pendaftaran telah dibuka! Mari tumbuh bersama kami di lingkungan yang Islami dan Qur'ani.
                                </p>
                            </div>

                            <div class="d-flex justify-content-center justify-content-md-start gap-3" data-aos="fade-up" data-aos-delay="200">
                                <a href="{{ route('register') }}" class="btn btn-primary btn-lg rounded-pill hover-lift px-5 shadow-lg">
                                    Daftar Sekarang <i class="bi bi-arrow-right ms-2"></i>
                                </a>
                            </div>
                        @else
                            <div data-aos="fade-up" data-aos-delay="100">
                                <p class="lead text-muted mb-4">
                                    Saat ini pendaftaran belum dibuka atau sudah berakhir. Silakan hubungi admin sekolah atau pantau terus halaman ini untuk informasi gelombang selanjutnya.
                                </p>
                                <div class="d-flex justify-content-center justify-content-md-start">
                                    <a href="https://wa.me/nomor-wa-sekolah" class="btn btn-outline-success btn-lg rounded-pill px-5">
                                        <i class="bi bi-whatsapp me-2"></i> Hubungi Admin
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        {{-- <section id="yayasan" class="section py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5" data-aos="fade-right">
                        <img src="{{ 'assets/images/gedung.jpeg' }}" class="img-fluid rounded-4 shadow"
                            alt="Gedung Yayasan">
                    </div>
                    <div class="col-lg-7 ps-lg-5" data-aos="fade-left">
                        <div class="section-title mb-4 text-start">
                            <span class="text-primary fw-bold text-uppercase">Profil Sekolah</span>
                            <h2 class="fw-bold">SMPIT Qur'an Daar El-Muflihin</h2>
                        </div>
                        <p class="text-secondary">Didirikan pada 16 Juli 2013, Yayasan TK Al-Hikmah merupakan lembaga
                            pendidikan yang berdedikasi tinggi di wilayah Kabupaten Tangerang. Di bawah kepemimpinan
                            <strong>Ibu HERYANI, S.Pd.</strong>, yayasan kami berkomitmen menciptakan lingkungan belajar
                            yang aman, nyaman, dan Islami untuk mendukung tumbuh kembang anak secara holistik.
                        </p>
                        <p class="text-secondary">Kami percaya bahwa fondasi karakter yang kuat di usia dini adalah
                            kunci kesuksesan anak di masa depan.</p>
                    </div>
                </div>
            </div>
        </section> --}}

        <section id="program" class="section py-5">
            <div class="container mb-5 text-center" data-aos="fade-up">
                <h2 class="fw-bold">Program Unggulan</h2>
                <div class="mx-auto underline" style="width: 50px; height: 3px; background: #007bff;"></div>
            </div>
            <div class="container">
                <div class="row g-4 justify-content-center">
                    <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                        <div class="program-card rounded-4 border p-4 text-center h-100 shadow-sm">
                            <div class="icon-wrapper mb-3 text-warning">
                                <i class="bi bi-journal-richtext fs-1"></i>
                            </div>
                            <h5 class="fw-bold">Tahfidz Qur'an</h5>
                            <p class="small text-muted">Program unggulan hafalan Al-Qur'an dengan target hafalan yang terukur dan bimbingan intensif.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                        <div class="program-card rounded-4 border p-4 text-center h-100 shadow-sm">
                            <div class="icon-wrapper mb-3 text-danger">
                                <i class="bi bi-megaphone-fill fs-1"></i>
                            </div>
                            <h5 class="fw-bold">Tahsin & Tartil Qur'an</h5>
                            <p class="small text-muted">Perbaikan bacaan (makhraj & tajwid) agar mampu melantunkan ayat suci dengan indah dan benar.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="300">
                        <div class="program-card rounded-4 border p-4 text-center h-100 shadow-sm">
                            <div class="icon-wrapper mb-3 text-primary">
                                <i class="bi  bi-journal-check fs-1"></i>
                            </div>
                            <h5 class="fw-bold">Tahfidz Hadist Arba'in</h5>
                            <p class="small text-muted">Menghafal 40 hadist pilihan sebagai fondasi pemahaman dasar hukum Islam dan pembentukan karakter.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="400">
                        <div class="program-card rounded-4 border p-4 text-center h-100 shadow-sm">
                            <div class="icon-wrapper mb-3 text-success">
                                <i class="bi bi-chat-left-quote-fill fs-1"></i>
                            </div>
                            <h5 class="fw-bold">Bilingual Conversation</h5>
                            <p class="small text-muted">Pembiasaan komunikasi sehari-hari (Daily Conversation) menggunakan Bahasa Arab dan Inggris.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="500">
                        <div class="program-card rounded-4 border p-4 text-center h-100 shadow-sm">
                            <div class="icon-wrapper mb-3 text-info">
                                <i class="bi bi-people-fill fs-1"></i>
                            </div>
                            <h5 class="fw-bold">Pidato 3 Bahasa</h5>
                            <p class="small text-muted">Melatih kepercayaan diri dan kemampuan orasi santri dalam Bahasa Arab, Inggris, dan Indonesia.</p>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </section>

        <section id="visi-misi" class="section bg-light py-5">
            <div class="container mb-5 text-center" data-aos="fade-up">
                <h2 class="fw-bold">Visi & Misi</h2>
                <p class="text-muted">Arah dan tujuan kami dalam mendidik putra-putri Anda.</p>
            </div>
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="card h-100 rounded-4 border-0 p-4 text-center shadow-sm">
                            <div class="icon-box bg-primary-subtle rounded-circle mx-auto mb-3 p-3"
                                style="width: 70px;">
                                <i class="bi bi-eye text-primary fs-3"></i>
                            </div>
                            <h4 class="fw-bold">Visi</h4>
                            <p class="text-muted small">Membentuk generasi Qur'an Berakhlak Mulia yang menghafal Al-Qur'an, Memahami hadist, dan Meneladani Nabi Muhammad  SAW, Menguasai ilmu Fiqh serta unggul dalam akademik untuk kehidupan Dunia Akhirat</p>
                        </div>
                    </div>
                    <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                        <div class="card h-100 rounded-4 border-0 p-4 shadow-sm">
                            <h4 class="fw-bold mb-3"><i class="bi bi-list-check text-primary me-2"></i>Misi Kami</h4>
                            <ul class="list-unstyled text-secondary">
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Membimbing siswa menghafal dan menjaga hafalan Al-Qur'an</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Mengajarkan Hadist serta menumbuhkan kecintaan kepada Nabi Muhammad SAW Melalui Keteladanan Beliau</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>
                                Membina akhlaq islami dalam keseharian dengan meneladani sunnah Nabi</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Mengajarkan fiqh dasar agar dapat beribadah sesuai syariat islam</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Menguatkan akademik agar seimbang antara ilmu agama dan umum</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <section id="kegiatan" class="section bg-light py-5">
            <div class="container mb-5 text-center" data-aos="fade-up">
                <h2 class="fw-bold">Kegiatan Sekolah</h2>
            </div>
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4" data-aos="fade-up">
                        <div class="activity-item position-relative rounded-4 overflow-hidden shadow">
                            <img src="assets/images/kegiatan-1.jpg" class="img-fluid" alt="Kegiatan Sholat">
                            <div class="activity-overlay p-3 text-white">
                                <h5 class="fw-bold">Sholat Berjamaah</h5>
                                <p class="small mb-0">Pembiasaan ibadah sejak usia dini.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="activity-item position-relative rounded-4 overflow-hidden shadow">
                            <img src="assets/images/kegiatan-2.jpg" class="img-fluid" alt="Market Day">
                            <div class="activity-overlay p-3 text-white">
                                <h5 class="fw-bold">Market Day</h5>
                                <p class="small mb-0">Melatih jiwa kewirausahaan dan interaksi sosial.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="activity-item position-relative rounded-4 overflow-hidden shadow">
                            <img src="assets/images/kegiatan-3.jpg" class="img-fluid" alt="Luar Kelas">
                            <div class="activity-overlay p-3 text-white">
                                <h5 class="fw-bold">Field Trip</h5>
                                <p class="small mb-0">Pembelajaran langsung di lingkungan luar sekolah.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="gallery" class="gallery section py-5">
            <div class="section-title container mb-5 text-center" data-aos="fade-up">
                <h2 class="fw-bold">Galeri Foto</h2>
            </div>
            <div class="container" data-aos="fade-up">
            </div>
        </section>

    </main>

    <style>
        /* Modern Enhancements */
        :root {
            --primary-color: #007bff;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: #444;
        }

        .section-title h2 {
            position: relative;
            padding-bottom: 20px;
        }

        .btn-login {
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            transition: 0.3s;
            font-weight: 500;
        }

        .program-card {
            background: #fff;
            transition: all 0.3s ease;
            cursor: default;
        }

        .program-card:hover {
            transform: translateY(-10px);
            border-color: var(--primary-color) !important;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }

        .activity-item img {
            transition: transform 0.5s ease;
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .activity-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
            transform: translateY(20px);
            opacity: 0;
            transition: all 0.4s ease;
        }

        .activity-item:hover .activity-overlay {
            transform: translateY(0);
            opacity: 1;
        }

        .activity-item:hover img {
            transform: scale(1.1);
        }

        .hero h2 span {
            color: var(--primary-color);
        }
    </style>

    <footer id="footer" class="footer">



        <div class="footer-top container">
            <div class="row gy-4 justify-content-center">
                <div class="col-lg-8 col-md-6 footer-about">
                    <a href="index.html" class="d-flex align-items-center">
                        <span class="sitename">SMPIT QUR'AN Daar El-Muflihin</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>Cikande Permai</p>
                        <p>Serang, Banten</p>

                    </div>
                </div>

                <div class="col-lg-3 col-md-3 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#hero">Beranda</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#about">Tentang</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#gallery">Galeri</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#faq">Terms of service</a></li>
                    </ul>
                </div>




            </div>
        </div>

        <div class="copyright container mt-4 text-center">
            <p>© <span>Copyright</span> <strong class="sitename px-1"></strong> <span>All Rights Reserved</span>
            </p>

        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
