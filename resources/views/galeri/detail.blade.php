<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $galleryTitle }} - Galeri SMKN 4 Bogor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- Font Awesome -->
    <style>
        body {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                          url('{{ asset("storage/images/lapangan2.jpg") }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            color: white;
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
            position: relative;
            z-index: 1;
            background-color: #fff;
        }

        h1 {
            font-size: 2rem;
            color: white;
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

        .card-title {
            color: black;
            display: inline-block;
            width: 80%;
        }

        .action-btn {
            background-color: transparent;
            border: none;
            color: gray;
            cursor: pointer;
            font-size: 1.5rem;
            margin-left: 10px;
        }

        .action-btn.liked {
            color: red;
        }

        .action-btn:hover {
            color: #0056b3;
        }

        .card-body {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .action-container {
            display: flex;
            align-items: center;
        }

        .card-img-top {
            cursor: pointer;
        }

        /* Modal Styles */
        .modal-body {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="container mt-5 slide-in-up">
        <button onclick="history.back()" class="btn btn-primary mb-4">Kembali</button>
        <h1>{{ $galleryTitle }}</h1>

        @if($photos->isEmpty())
            <p>Tidak ada foto di galeri ini.</p>
        @else
            <div class="row">
                @foreach($photos as $photo)
                    <div class="col-md-4">
                        <div class="card mb-3 slide-in-up">
                            <img src="{{ asset('storage/' . $photo->file) }}" alt="{{ $photo->judul }}" class="card-img-top" style="object-fit: cover; width: 100%; height: 200px;" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage('{{ asset('storage/' . $photo->file) }}', '{{ $photo->judul }}')">
                            <div class="card-body">
                                <h5 class="card-title">{{ $photo->judul }}</h5>
                                <div class="action-container">
                                    <button class="action-btn" onclick="toggleLike(this)">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Modal for Image Pop-up -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Gambar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Display Image in the modal -->
                    <img id="modalImage" src="" alt="Image" class="img-fluid" />
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Function to toggle like button color from gray to red
        function toggleLike(button) {
            button.classList.toggle('liked'); // Toggle the 'liked' class to change color to red
        }

        // Function to open the image in the modal
        function showImage(imageSrc, imageTitle) {
            // Set the source of the modal image to the clicked image
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imageModalLabel').innerText = imageTitle;
        }
    </script>
</body>
</html>
