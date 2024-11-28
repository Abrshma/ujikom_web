<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $agenda->judul }} - Agenda SMKN 4 Bogor</title>
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
            color: white; /* Pastikan teks tetap terbaca */
            position: relative;
        }
        
        @keyframes slideInUp {
            0% {
                transform: translateY(100px);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .slide-in-up {
            animation: slideInUp 0.7s ease-out forwards;
            opacity: 0;
        }

        .content-card {
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            padding: 20px;
            position: relative; /* memastikan card tetap berada di atas */
            z-index: 1; /* memastikan card berada di atas background */
            background-color: #fff; /* Memberikan latar belakang penuh pada card */
        }

        h1 {
            font-size: 2rem;
            color: #333;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .content-card p {
            font-size: 1rem;
            color: #555;
            line-height: 1.6;
        }

        .btn-primary {
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container mt-5 slide-in-up">
        <button onclick="history.back()" class="btn btn-primary mb-4">Kembali</button>
        <div class="content-card">
            <h1>{{ $agenda->judul }}</h1>
            <p><strong>Tanggal Dibuat:</strong> {{ $agenda->created_at }}</p>
            <p>{!! nl2br(e($agenda->isi)) !!}</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
