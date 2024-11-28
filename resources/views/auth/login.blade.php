<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/css/app.css')
    <style>
        body {
            background-image: url('{{ asset('storage/images/lapangan.jpg') }}');
            background-size: cover;
            background-position: center center;
            position: relative;
            height: 100vh;
        }

        /* Menambahkan overlay gelap dengan transparansi */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Warna hitam dengan transparansi */
            z-index: 1; /* Memastikan overlay berada di atas gambar */
        }

        .login-container {
            position: relative;
            z-index: 2; /* Memastikan form login berada di atas overlay */
            transition: transform 0.3s ease, box-shadow 0.3s ease; /* Menambahkan transisi untuk animasi */
        }

        /* Efek pop-up dan pembesaran saat hover */
        .login-container:hover {
            transform: scale(1.05); /* Membesarkan kotak login sebesar 5% */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); /* Menambahkan bayangan untuk efek pop-up */
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-8 space-y-8 bg-white shadow-md rounded-lg login-container">
        <h2 class="text-2xl font-bold text-center text-gray-700">Login to Admin Dashboard</h2>
        
        <!-- Display error alert -->
        @if ($errors->has('username'))
            <div class="mb-4 p-4 rounded-md" style="color: #B91C1C !important; background-color: #FECACA !important; border: 1px solid #F87171;">
                {{ $errors->first('username') }}
            </div>
        @endif

        <form class="mt-6" method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-600">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" required
                       class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
                <input type="password" id="password" name="password" required
                       class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            
            <button type="submit"
                    class="w-full px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Login
            </button>
        </form>
    </div>
</body>
</html>
