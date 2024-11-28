<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside id="sidebar" class="w-64 bg-gradient-to-b from-gray-800 to-gray-900 text-white shadow-lg flex flex-col fixed top-0 left-0 h-screen lg:block hidden z-40">
            <div class="p-6 flex items-center space-x-4">
                <h1 class="text-3xl font-bold tracking-wide">Admin Dashboard</h1>
            </div>
            <nav class="mt-6 flex-grow">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center py-3 px-4 rounded transition duration-200 hover:bg-gray-700 hover:shadow-md text-xl">
                    <i class="fas fa-tachometer-alt mr-3"></i>Dashboard
                </a>
                <a href="{{ route('admin.petugas.index') }}" class="flex items-center py-3 px-4 rounded transition duration-200 hover:bg-gray-700 hover:shadow-md text-xl">
                    <i class="fas fa-user-shield mr-3"></i>Petugas
                </a>
                <a href="{{ route('admin.profile.index') }}" class="flex items-center py-3 px-4 rounded transition duration-200 hover:bg-gray-700 hover:shadow-md text-xl">
                    <i class="fas fa-pager mr-3"></i>Profile
                </a>
                <a href="{{ route('admin.kategori.index') }}" class="flex items-center py-3 px-4 rounded transition duration-200 hover:bg-gray-700 hover:shadow-md text-xl">
                    <i class="fas fa-tags mr-3"></i>Kategori
                </a>
                <a href="{{ route('admin.posts.index') }}" class="flex items-center py-3 px-4 rounded transition duration-200 hover:bg-gray-700 hover:shadow-md text-xl">
                    <i class="fas fa-file-alt mr-3"></i>Posts
                </a>
                <a href="{{ route('admin.galery.index') }}" class="flex items-center py-3 px-4 rounded transition duration-200 hover:bg-gray-700 hover:shadow-md text-xl">
                    <i class="fas fa-images mr-3"></i>Galery
                </a>
                <a href="{{ route('admin.foto.index') }}" class="flex items-center py-3 px-4 rounded transition duration-200 hover:bg-gray-700 hover:shadow-md text-xl">
                    <i class="fas fa-camera mr-3"></i>Foto
                </a>
            </nav>
        </aside>

        <!-- Hamburger Button (for mobile) -->
        <button id="toggleSidebar" class="lg:hidden fixed top-4 left-4 z-50 text-black p-2 bg-white-800 rounded-full">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Main Content -->
        <div id="mainContent" class="flex-grow lg:ml-64 bg-white transition-all duration-300"> <!-- Using lg:ml-64 for large screens -->
            <!-- Navbar -->
            <header id="navbar" class="bg-white shadow z-30">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <!-- Dashboard Title -->
        <div class="p-6 flex items-center space-x-4">
        </div>
        <!-- Username and Settings -->
        <div class="relative flex items-center space-x-6">
            <!-- Username -->
            <h2 class="text-xl font-semibold text-gray-700">{{ Auth::user()->username ?? 'Admin' }}</h2>
            <!-- Settings -->
            <div class="relative">
                <button onclick="toggleDropdown()" class="bg-white-200 p-2 rounded-full hover:bg-white-300 focus:outline-none">
                    <i class="fas fa-cog"></i>
                </button>
                <div id="dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
                    <form action="{{ route('logout') }}" method="POST" class="block w-full">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-red-500 hover:bg-gray-100">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>


            <!-- Content Area -->
            <main class="p-6 bg-gray-100">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        // Toggle Sidebar on small screens
        document.getElementById("toggleSidebar").addEventListener("click", function() {
            var sidebar = document.getElementById("sidebar");
            var mainContent = document.getElementById("mainContent");
            sidebar.classList.toggle("hidden");
            // Adjust margin-left for mainContent when sidebar is open
            if (!sidebar.classList.contains("hidden")) {
                mainContent.classList.add("ml-64");
            } else {
                mainContent.classList.remove("ml-64");
            }
        });

        function toggleDropdown() {
            var dropdown = document.getElementById("dropdown");
            dropdown.classList.toggle("hidden");
        }

        // Close dropdown if clicked outside
        window.addEventListener("click", function(e) {
            var dropdown = document.getElementById("dropdown");
            var button = document.querySelector("[onclick='toggleDropdown()']");
            if (!dropdown.contains(e.target) && !button.contains(e.target)) {
                dropdown.classList.add("hidden");
            }
        });
    </script>
</body>
</html>
