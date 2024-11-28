<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPLG</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Adjust the container to avoid overlap with the fixed navbar */
        body {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                          url('{{ asset("storage/images/lapangan2.jpg") }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            color: black; /* Pastikan teks tetap terbaca */
            position: relative;
        }

        /* Card Styling */
        .card {
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }

        .card-body h2 {
            font-size: 1.75rem;
            font-weight: 600;
            color: #333;
        }

        .card-body p {
            font-size: 1.1rem;
            color: #555;
            line-height: 1.6;
        }

        /* Styling for image next to title and text */
        .card-body {
            display: flex;
            align-items: center;
        }

        .card-body img {
            width: 200px; /* Gambar diperbesar */
            height: auto;
            border-radius: 8px;
            margin-right: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Media query untuk layar kecil */
        @media (max-width: 768px) {
            .card-body {
                flex-direction: column; /* Gambar berada di atas teks */
                align-items: center; /* Pusatkan gambar dan teks */
            }

            .card-body img {
                margin-right: 0; /* Menghilangkan margin kanan pada gambar */
                margin-bottom: 15px; /* Memberikan jarak antara gambar dan teks */
                width: 100%; /* Gambar akan mengambil lebar penuh pada layar kecil */
            }
        }
    </style>
</head>
<body>
    
<div class="container mt-5 text-left">
<button onclick="history.back()" class="btn btn-primary mb-4">Kembali</button>
    <div class="card mb-3">
        <div class="card-body">
            <img src="{{ asset('storage/images/TKR.jpg') }}" alt="Thumbnail">
            <div>
                <h5 class="card-title">Teknik Kendaraan Ringan</h5>
                <p class="card-text">Teknik Otomotif merupakan kompetensi keahlian yang berfokus untuk melakukan perbaikan pada berbagai kendaraan roda empat. Semula jurusan ini bernama Teknik Kendaraan Ringan (TKR), namun kini berganti nama seiring dengan perubahan kurikulum merdeka.</p>
            </div>
        </div>
    </div>
</div>

</body>
</html>
