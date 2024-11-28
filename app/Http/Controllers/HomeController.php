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
        $galeries = Foto::with(['galery.post' => function ($query) {            
            $query->where('status', 'published');
        }])
        ->get()
        ->groupBy('galery.post.judul');  // Mengambil semua galeri
        return view('galeri', compact('galeries'));
    }

    // Menampilkan foto lebih banyak
    public function showGallery($galleryTitle)
    {
        // Ambil foto terkait berdasarkan judul galeri
        $photos = Foto::whereHas('galery.post', function ($query) use ($galleryTitle) {
            $query->where('judul', $galleryTitle);
        })->get();
    
        return view('galeri.detail', compact('galleryTitle', 'photos'));
    }

    // Menampilkan daftar posts (khusus untuk agenda yang published)
    public function agenda()
    {
        // Mendapatkan post dengan kategori 'agenda' dan status 'published'
        $agendaPosts = Post::with('kategori')
            ->whereHas('kategori', function($query) {
                $query->where('judul', 'Agenda Sekolah'); // Sesuaikan dengan kolom 'judul' di tabel kategori
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
        // Mendapatkan post dengan kategori 'Informasi Terkini' dan status 'published'
        $informasiPosts = Post::with('kategori')
            ->whereHas('kategori', function($query) {
                $query->where('judul', 'Informasi Terkini');  // Sesuaikan dengan nama kategori
            })
            ->where('status', 'published')  // Hanya mengambil post dengan status published
            ->get();
    
        // Mengirim variabel informasiPosts ke view
        return view('informasi', compact('informasiPosts'));
    }   
    
    public function detailInformasi($id)
    {
        // Ganti 'Post' dengan model yang sesuai jika berbeda
        $informasi = Post::findOrFail($id); // Mengambil data berdasarkan ID
        return view('informasi.detail', compact('informasi')); // Kirim variabel ke view
    }
}
