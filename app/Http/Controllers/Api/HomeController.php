<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Galery;
use App\Models\Profile;
use App\Models\Post;
use App\Models\Foto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Menampilkan data untuk halaman utama (welcome)
    public function welcome()
    {
        $agendaPosts = Post::with('kategori')
            ->whereHas('kategori', function($query) {
                $query->where('judul', 'Agenda Sekolah');
            })
            ->where('status', 'published')
            ->get();

        $informasiPosts = Post::with('kategori')
            ->whereHas('kategori', function($query) {
                $query->where('judul', 'Informasi Terkini');
            })
            ->where('status', 'published')
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'agenda_posts' => $agendaPosts,
                'informasi_posts' => $informasiPosts,
            ],
        ]);
    }

    // Menampilkan data profil
    public function profile()
    {
        $profiles = Profile::all();
        return response()->json([
            'success' => true,
            'data' => $profiles,
        ]);
    }

    // Menampilkan daftar galeri
    public function galeri()
    {
        $galeries = Foto::with(['galery.post' => function ($query) {            
            $query->where('status', 'published');
        }])->get()->groupBy('galery.post.judul');

        return response()->json([
            'success' => true,
            'data' => $galeries,
        ]);
    }

    // Menampilkan foto dalam galeri tertentu
    public function showGallery($galleryTitle)
    {
        $photos = Foto::whereHas('galery.post', function ($query) use ($galleryTitle) {
            $query->where('judul', $galleryTitle);
        })->get();

        return response()->json([
            'success' => true,
            'data' => [
                'gallery_title' => $galleryTitle,
                'photos' => $photos,
            ],
        ]);
    }

    // Menampilkan daftar agenda
    public function agenda()
    {
        $agendaPosts = Post::with('kategori')
            ->whereHas('kategori', function($query) {
                $query->where('judul', 'Agenda Sekolah');
            })
            ->where('status', 'published')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $agendaPosts,
        ]);
    }

    // Menampilkan detail agenda berdasarkan ID
    public function detailAgenda($id)
    {
        $agenda = Post::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $agenda,
        ]);
    }

    // Menampilkan daftar informasi
    public function informasi()
    {
        $informasiPosts = Post::with('kategori')
            ->whereHas('kategori', function($query) {
                $query->where('judul', 'Informasi Terkini');
            })
            ->where('status', 'published')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $informasiPosts,
        ]);
    }

    // Menampilkan detail informasi berdasarkan ID
    public function detailInformasi($id)
    {
        $informasi = Post::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $informasi,
        ]);
    }
}
