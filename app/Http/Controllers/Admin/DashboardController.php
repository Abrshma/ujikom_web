<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use App\Models\Kategori;
use App\Models\Post;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch total counts for each model
        $totalPetugas = Petugas::count();
        $totalKategori = Kategori::count();
        $totalPosts = Post::count();

        // Pass these counts to the view
        return view('admin.dashboard', compact('totalPetugas', 'totalKategori', 'totalPosts'));
    }
}
