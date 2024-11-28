<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMKN 4 Bogor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        /* Keyframes for the slide-in-up animation */
        @keyframes slideInUp {
            0% {
                transform: translateY(100px);  /* Starts from below */
                opacity: 0;
            }
            100% {
                transform: translateY(0);  /* Ends at its original position */
                opacity: 1;
            }
        }

        /* Apply animation to the elements except the navbar */
        .slide-in-up {
            animation: slideInUp 0.7s ease-out forwards;
            opacity: 0;  /* Initially hidden */
        }

        /* Custom Button */
        .btn-custom {
            background-color: #6495ED;
            color: black;
            padding: 12px 24px;
            font-weight: bold;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #4169E1;
            color: white;
        }

        /* Navbar Styling */
        .navbar {
            position: fixed; /* Fix the navbar at the top */
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1030; /* Ensure the navbar stays on top of other content */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #fff; /* Set background color */
            padding: 10px 0; /* Optional: Adjust the padding */
        }

        /* Adjust the container to avoid overlap with the fixed navbar */
        body {
            padding-top: 70px; /* Adjust this value based on your navbar height */
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                          url('{{ asset("storage/images/lapangan2.jpg") }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            color: white; /* Pastikan teks tetap terbaca */
        }

        .navbar-light .navbar-nav .nav-link {
            font-size: 1.1rem;
            font-weight: 500;
            text-transform: uppercase;
            transition: color 0.3s ease;
        }

        .navbar-light .navbar-nav .nav-link:hover {
            color: #6495ED;
        }

        .navbar-light .navbar-nav .nav-item.active .nav-link {
            color: #4169E1 !important;
        }

        /* Card Styling */
        .card {
            border-radius: 10px;
            overflow: hidden; /* Menghindari konten keluar dari card */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            padding: 20px; /* Optional: menambahkan padding agar konten terlihat lebih rapi */
        }

        .card:hover {
            transform: scale(1.05); /* Sedikit membesarkan ukuran card saat dihover */
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }

        /* Styling untuk judul dan teks di dalam card */
        .card-body h5 {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
        }

        .card-body p {
            font-size: 1rem;
            color: #555;
            line-height: 1.6;
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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
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

    <div class="container mt-5 slide-in-up">
        <h1 class="text-center">Informasi Terkini</h1>
        <br>

        @if($informasiPosts->isEmpty())
            <p>Tidak ada informasi yang tersedia.</p>
        @else
            <div class="row">
                @foreach ($informasiPosts as $post)
                    <div class="col-md-4">
                        <div class="card mb-3 slide-in-up">
                            @if($post->galeries->isNotEmpty() && $post->galeries->first()->fotos->isNotEmpty())
                                <img src="{{ asset('storage/' . $post->galeries->first()->fotos->first()->file) }}" 
                                     class="card-img-top" 
                                     alt="{{ $post->judul }}"
                                     style="height: 200px; object-fit: cover;">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->judul }}</h5>
                                <p class="card-text">{{ Str::limit($post->isi, 100) }}</p>
                                <p class="card-text"><small class="text-muted">{{ $post->created_at->format('d M Y') }}</small></p>
                                <a href="{{ route('informasi.detail', $post->id) }}" class="btn btn-primary">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
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
            <p class="mb-0 text-secondary">&copy; Muhammad Abrisham Abdullah. All Rights Reserved.</p>
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
    </script>
</body>
</html>
