<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMKN 4 Bogor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Signika:wght@400;600&display=swap" rel="stylesheet">
<style>
        /* Custom CSS for the hero section */
        .hero {
            background-image: url('{{ asset('storage/images/lapangan2.jpg') }}'), 
                            linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0));
            background-size: cover;
            background-position: center;
            height: 102vh;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            text-align: center;
        }

        /* Overlay untuk efek lebih gelap */
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        /* Gradasi di bawah hero menuju agenda */
        .hero:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 90px; /* Tinggi gradasi */
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0), rgba(255, 255, 255, 1));
        }

        /* Padding pada agenda untuk memberi ruang */
        .container.mt-5 {
            padding-top: 30px;
        }

        /* Hero Section Content (visible by default) */
        .hero-content {
            position: relative;
            z-index: 1;
            opacity: 1; /* Make it visible initially */
            transition: opacity 1s ease; /* Fade-in animation */
            font-family: 'Signika', sans-serif; /* Apply the Signika font to text */
        }

        .hero-content h1 {
            font-family: 'Anton', sans-serif; /* Ensure h1 uses Anton */
            font-size: 4rem; /* Increase the font size */
            line-height: 1.2; /* Optional: Adjust line-height for better spacing */
            margin: 0; /* Remove default margin */
        }

        .hero-content a {
            font-family: inherit; /* Keep the button font unchanged */
            text-decoration: none; /* Remove underline from the link */
            border: none; /* Ensure no border initially */
            transition: all 0.3s ease; /* Smooth transition on hover */
        }

        /* Remove border on hover */
        .hero-content a:hover {
            border: none; /* Ensure border is removed on hover */
            outline: none; /* Remove outline if any */
            box-shadow: none; /* Optional: remove any box-shadow */
        }

        .hero-content.active {
            opacity: 1; /* Keep it visible */
        }

        /* Optional: If you want the hero content to fade in after some delay */
        .hero-content {
            opacity: 0; /* Start as invisible */
            visibility: hidden; /* Ensure it is not interactable */
        }

        .hero-content.active {
            opacity: 1; /* Fully visible */
            visibility: visible; /* Make it interactable */
        }

        /* Button Custom */
        .btn-custom {
            background-color: #6495ED;  /* Warna biru */
            color: black;               /* Teks hitam */
            padding: 12px 24px;
            font-weight: bold;
            border-radius: 8px;
            border: 2px solid transparent;  /* Border transparan */
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease; /* Transisi */
        }

        /* Hover State for Button */
        .btn-custom:hover {
            background-color: transparent;  /* Background transparan */
            color: white;                   /* Teks putih */
            border-color: #6495ED;          /* Border biru */
        }

        /* Button Custom 2 */
        .btn-custom2 {
            background-color: #6495ED;  /* Warna biru */
            color: white;               /* Teks hitam */
            padding: 12px 24px;
            font-weight: bold;
            border-radius: 8px;
            border: 2px solid transparent;  /* Border transparan */
            transition: background-color 0.3s ease, color 0.3s ease; /* Transisi */
            outline: none; /* Remove outline */
        }

        /* Hover State for Button */
        .btn-custom2:hover {
            background-color: transparent;  /* Background transparan */
            color: black;                   /* Teks putih */
            border-color: transparent;      /* Remove border on hover */
            outline: none;                  /* Remove outline on hover */
        }

        /* Navbar Styling */
        .navbar-light .navbar-nav .nav-link {
            font-size: 1.1rem;
            font-weight: 500;
            text-transform: uppercase;
        }

        .navbar-light .navbar-nav .nav-link:hover {
            color: #6495ED;
        }

        .navbar-light .navbar-nav .nav-item.active .nav-link {
            color: #4169E1 !important;  /* Highlight active link */
        }

        .navbar {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Slide-in animation */
        .slide-in {
            opacity: 0;
            transform: translateY(50px); /* Start from 50px below */
            transition: opacity 1s ease, transform 1s ease;
        }

        /* Active class for slide-up animation */
        .slide-in.active {
            opacity: 1;
            transform: translateY(0); /* Move to original position */
        }

        /* Hover effect for the Footer list items */
        .kompetensi-list a:hover,
        .navbar-list a:hover {
            color: #5bc0de !important;  /* Blue color on hover */
            text-decoration: underline;
        }
    </style>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light position-fixed w-100" style="top: 0; z-index: 999;">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('storage/images/logo-smk4-tp.png') }}" alt="Logo" style="width: 50px; height: 50px; margin-right: 10px;">
            SMK Negeri 4 Bogor
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/profile') }}">Profil Sekolah</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/agenda') }}">Agenda Sekolah</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/informasi') }}">Informasi Terkini</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/galeri') }}">Galeri Sekolah</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<div class="hero" style="margin-top: 60px;"> <!-- Add margin-top to offset fixed navbar -->
    <div class="overlay"></div>
    <div class="hero-content">
        <h1>SMKN 4 BOGOR</h1>
        <a href="{{ url('/profile') }}" class="btn btn-custom mt-3">TENTANG KAMI</a>
    </div>
</div>

<!-- Rest of your content -->


    <!-- Agenda Sekolah Section with Image -->
    <div class="container mt-5">
        <div class="card mb-3 slide-in">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <!-- Image for Agenda -->
                    <img id="agendaImage" src="{{ asset('storage/images/transforkr4b.jpg') }}" class="card-img" alt="Agenda Image">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Agenda Sekolah</h5>
                        <p class="card-text mb-4">Agenda Sekolah kami berisi jadwal lengkap mengenai berbagai kegiatan yang akan datang, mulai dari acara penting, ujian, hingga pertemuan siswa dan guru. Di sini, Anda dapat menemukan rincian kegiatan yang diselenggarakan oleh sekolah.</p>
                        <a href="{{ url('/agenda') }}" class="btn btn-custom2">Lihat Agenda</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Informasi Terkini Section with Image -->
    <div class="container mt-3">
        <div class="card mb-3 slide-in">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <!-- Image for Informasi -->
                    <img id="informasiImage" src="{{ asset('storage/images/informasi1.jpg') }}" class="card-img" alt="Informasi Image">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Informasi Terkini</h5>
                        <p class="card-text">Dapatkan informasi terkini mengenai aktivitas dan perkembangan di sekolah. Kami selalu memperbarui data mengenai berbagai kegiatan yang sedang berlangsung maupun yang akan datang, sehingga Anda selalu terhubung dengan apa yang terjadi di sekolah. Pastikan untuk mengecek halaman ini secara rutin agar tetap mendapat informasi terbaru.</p>
                        <a href="{{ url('/informasi') }}" class="btn btn-custom2">Lihat Informasi</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Galeri Sekolah Section with Image Beside Text -->
    <div class="container mt-3">
        <div class="card mb-3 slide-in">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <!-- Image for Gallery beside the text -->
                    <img id="galeriImage" src="{{ asset('storage/images/galeri1.jpg') }}" class="card-img" alt="Galeri Image">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Galeri Sekolah</h5>
                        <p class="card-text mb-4">Galeri ini menampilkan berbagai foto dan video kegiatan di sekolah, termasuk acara penting, kegiatan siswa, dan lainnya. Lihat koleksi lengkapnya di halaman galeri kami.</p>
                        <a href="{{ url('/galeri') }}" class="btn btn-custom2">Lihat Galeri</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Footer Section -->
<footer class="bg-dark text-white py-5 mt-5">
    <div class="container">
        <div class="row">
            <!-- About Section -->
            <div class="col-md-3 mb-4 mb-md-0">
                <h5 class="font-weight-bold mb-3 text-uppercase text-info">SMK Negeri 4 Bogor</h5>
                <p>
                    SMK Negeri 4 Bogor adalah institusi pendidikan yang berfokus pada pengembangan keterampilan teknis dan profesional siswa untuk menghadapi dunia kerja.
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="https://www.facebook.com/people/SMK-NEGERI-4-KOTA-BOGOR/100054636630766/" target="_blank" class="btn btn-outline-light btn-floating rounded-circle">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://api.whatsapp.com/send/?phone=6282260168886" target="_blank" class="btn btn-outline-light btn-floating rounded-circle">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="https://www.instagram.com/smkn4kotabogor/" target="_blank" class="btn btn-outline-light btn-floating rounded-circle">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://www.youtube.com/channel/UC4M-6Oc1ZvECz00MlMa4v_A/videos?app=desktop" target="_blank" class="btn btn-outline-light btn-floating rounded-circle">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="mailto:smkn4@smkn4bogor.sch.id" target="_blank" class="btn btn-outline-light btn-floating rounded-circle">
                        <i class="fas fa-envelope"></i>
                    </a>
                </div>
            </div>

            <!-- Kompetensi Keahlian Section -->
            <div class="col-md-3 mb-4 mb-md-0">
                <h5 class="font-weight-bold mb-3 text-uppercase text-info">Kompetensi Keahlian</h5>
                <ul class="list-unstyled kompetensi-list">
                    <li class="mb-2">
                        <a href="{{ url('/kompetensi/pplg') }}" class="text-white text-decoration-none">
                            Pengembangan Perangkat Lunak
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ url('/kompetensi/tjkt') }}" class="text-white text-decoration-none">
                            Teknik Jaringan Komputer dan Telekomunikasi
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ url('/kompetensi/tkr') }}" class="text-white text-decoration-none">
                            Teknik Kendaraan Ringan
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ url('/kompetensi/tflm') }}" class="text-white text-decoration-none">
                            Teknik Fabrikasi Logam dan Manufaktur
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Navbar Quick Links Section -->
            <div class="col-md-3 mb-4 mb-md-0">
                <h5 class="font-weight-bold mb-3 text-uppercase text-info">Navbar</h5>
                <ul class="list-unstyled navbar-list">
                    <li class="mb-2">
                        <a href="{{ url('/') }}" class="text-white text-decoration-none">
                            Beranda
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ url('/profile') }}" class="text-white text-decoration-none">
                            Profil Sekolah
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ url('/agenda') }}" class="text-white text-decoration-none">
                            Agenda Sekolah
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ url('/informasi') }}" class="text-white text-decoration-none">
                            Informasi Terkini
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/galeri') }}" class="text-white text-decoration-none">
                            Galeri Sekolah
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Lokasi Section -->
            <div class="col-md-3 mb-4 mb-md-0">
                <h5 class="font-weight-bold mb-3 text-uppercase text-info">Lokasi</h5>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3978.8072871543317!2d106.822119!3d-6.6407334!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c8b16ee07ef5%3A0x14ab253dd267de49!2sSMK%20Negeri%204%20Bogor%20(Nebrazka)!5e0!3m2!1sid!2sid!4v1699850000000!5m2!1sid!2sid" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" class="rounded"></iframe>
                <p class="mt-3">
                    Jl. Raya Tajur, Kp. Buntar RT.02/RW.08, Kel. Muara sari, Kec. Bogor Selatan, RT.03/RW.08, Muarasari, Kec. Bogor Sel., Kota Bogor, Jawa Barat 16137
                </p>
            </div>
        </div>

        <hr class="my-4" style="border-top: 1px solid #fff;">

        <!-- Copyright Section -->
        <div class="text-center">
            <p class="mb-0 text-secondary">&copy; 2024 SMK Negeri 4 Bogor. All Rights Reserved.</p>
        </div>
    </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript to highlight active link in navbar
        document.addEventListener("DOMContentLoaded", function () {
            const currentUrl = window.location.href;
            const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
            
            navLinks.forEach(link => {
                if (link.href === currentUrl) {
                    link.closest('.nav-item').classList.add('active');
                }
            });
        });

        // JavaScript to add "active" class when the element is in viewport for slide-up
        const heroContent = document.querySelector('.hero-content');
        const slideElements = document.querySelectorAll('.slide-in');

        const handleScroll = () => {
            const viewportHeight = window.innerHeight;

            // Fade-in for hero content (triggered as it comes into view)
            const heroPosition = heroContent.getBoundingClientRect().top;
            if (heroPosition < viewportHeight - 100) {
                heroContent.classList.add('active');
            }

            // Slide-up for agenda, informasi, and galeri sections
            slideElements.forEach(element => {
                const elementPosition = element.getBoundingClientRect().top;
                if (elementPosition < viewportHeight - 100) {
                    element.classList.add('active');
                }
            });
        };

        window.addEventListener('scroll', handleScroll);
        handleScroll();  // Initial check in case elements are already in view

            // Function to change images at intervals
            function changeImage(imageId, imagesArray) {
                let currentIndex = 0;
                const imageElement = document.getElementById(imageId);

                setInterval(() => {
                    currentIndex = (currentIndex + 1) % imagesArray.length; // Loop back to the first image
                    imageElement.src = imagesArray[currentIndex]; // Change image
                }, 3000); // Change image every 3 seconds (3000 ms)
            }

    // List of images for Agenda
    const agendaImages = [
        '{{ asset('storage/images/transforkr4b.jpg') }}',
        '{{ asset('storage/images/transforkr4b2.jpg') }}',
        '{{ asset('storage/images/transforkr4b3.jpg') }}'
    ];

    // List of images for Informasi
    const informasiImages = [
        '{{ asset('storage/images/informasi1.jpg') }}',
        '{{ asset('storage/images/informasi2.jpg') }}',
        '{{ asset('storage/images/informasi3.jpg') }}'
    ];

    // List of images for Gallery
    const galeriImages = [
        '{{ asset('storage/images/galeri1.jpg') }}',
        '{{ asset('storage/images/galeri2.jpg') }}',
        '{{ asset('storage/images/galeri3.jpg') }}'
    ];

    // Start changing images for both cards
    changeImage('agendaImage', agendaImages);
    changeImage('informasiImage', informasiImages);
    changeImage('galeriImage', galeriImages);
    </script>
</body>
</html>
