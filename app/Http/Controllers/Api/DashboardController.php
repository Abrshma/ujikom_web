<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use App\Models\Kategori;
use App\Models\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch total counts for each model
        $totalPetugas = Petugas::count();
        $totalKategori = Kategori::count();
        $totalPosts = Post::count();

        // Return data as JSON response
        return response()->json([
            'totalPetugas' => $totalPetugas,
            'totalKategori' => $totalKategori,
            'totalPosts' => $totalPosts,
        ]);
    }
}
