<?php

namespace App\Http\Controllers;

use App\Models\Galery;
use App\Models\Profile;
use App\Models\Post;
use App\Models\Foto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function welcome()
    {
        // Mendapatkan post dengan kategori 'Agenda Sekolah' dan status 'published'
        $agendaPosts = Post::with('kategori')
            ->whereHas('kategori', function($query) {
                $query->where('judul', 'Agenda Sekolah');
            })
            ->where('status', 'published')
            ->get();

        // Mendapatkan post dengan kategori 'Informasi Terkini' dan status 'published'
        $informasiPosts = Post::with('kategori')
            ->whereHas('kategori', function($query) {
                $query->where('judul', 'Informasi Terkini');
            })
            ->where('status', 'published')
            ->get();

        return view('welcome', compact('agendaPosts', 'informasiPosts'));
    }

    public function profile()
    {
        // Ambil data profil dari tabel Profile
        $profiles = Profile::all();
        return view('profile', compact('profiles'));
    }

    // Menampilkan daftar galeri
    public function galeri()
    {
        // Debug: Check for posts with Galeri Sekolah category
        $posts = Post::with(['kategori', 'galeries.fotos'])
            ->whereHas('kategori', function($query) {
                $query->where('judul', 'Galery Sekolah');
            })
            ->where('status', 'published')
            ->get();

        \Log::info('Debug Galeri:');
        \Log::info('1. Total posts found: ' . $posts->count());
        
        // Group the photos by post title
        $galeries = collect();
        foreach ($posts as $post) {
            \Log::info("2. Checking post: {$post->judul}");
            \Log::info("3. Galleries count: " . $post->galeries->count());
            
            if ($post->galeries->isNotEmpty()) {
                $photos = collect();
                foreach ($post->galeries as $gallery) {
                    \Log::info("4. Gallery ID: {$gallery->id}, Status: {$gallery->status}");
                    \Log::info("5. Photos in gallery: " . $gallery->fotos->count());
                    
                    if ($gallery->status == 1) {
                        $photos = $photos->concat($gallery->fotos);
                    }
                }
                if ($photos->isNotEmpty()) {
                    $galeries->put($post->judul, $photos);
                }
            }
        }

        \Log::info('6. Final galleries count: ' . $galeries->count());
        
        return view('galeri', compact('galeries'));
    }

    // Menampilkan foto lebih banyak
    public function showGallery($galleryTitle)
    {
        // Replace '+' with space and decode
        $decodedTitle = str_replace('+', ' ', urldecode($galleryTitle));
        
        // Debug
        \Log::info('Gallery Title: ' . $decodedTitle);
        
        $photos = Foto::whereHas('galery.post', function ($query) use ($decodedTitle) {
            $query->where('judul', $decodedTitle)
                  ->where('status', 'published');
        })
        ->whereHas('galery', function($query) {
            $query->where('status', 1);
        })
        ->get();
        
        // Debug
        \Log::info('Photos count: ' . $photos->count());
        
        return view('galeri.detail', compact('galleryTitle', 'photos'));
    }

    // Menampilkan daftar posts (khusus untuk agenda yang published)
    public function agenda()
    {
        $agendaPosts = Post::with(['kategori', 'galeries.fotos'])
            ->whereHas('kategori', function($query) {
                $query->where('judul', 'Agenda Sekolah');
            })
            ->where('status', 'published')
            ->get();

        return view('agenda', compact('agendaPosts'));
    }
    
    public function detailAgenda($id)
    {
        // Ganti 'Post' dengan model yang sesuai jika berbeda
        $agenda = Post::findOrFail($id); // Mengambil data berdasarkan ID
        return view('agenda.detail', compact('agenda')); // Kirim variabel ke view
    }

    // Menampilkan daftar posts (khusus untuk kategori Informasi yang published)
    public function informasi()
    {
        $informasiPosts = Post::with(['kategori', 'galeries.fotos'])
            ->whereHas('kategori', function($query) {
                $query->where('judul', 'Informasi Terkini');
            })
            ->where('status', 'published')
            ->get();

        return view('informasi', compact('informasiPosts'));
    }   
    
    public function detailInformasi($id)
    {
        // Ganti 'Post' dengan model yang sesuai jika berbeda
        $informasi = Post::findOrFail($id); // Mengambil data berdasarkan ID
        return view('informasi.detail', compact('informasi')); // Kirim variabel ke view
    }
}
