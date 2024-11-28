<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Kategori;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    // Menampilkan daftar posts
    public function index()
    {
        $posts = Post::with('kategori', 'petugas')->get();
        return view('admin.posts.index', compact('posts'));
    }

    // Menampilkan form untuk membuat post baru
    public function create()
    {
        $kategori = Kategori::all(); // Mendapatkan semua kategori
        return view('admin.posts.create', compact('kategori'));
    }

    // Menyimpan post baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'isi' => 'required',
            'status' => 'required|in:draft,published',
        ]);

        // Simpan post baru
        Post::create([
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
            'isi' => $request->isi,
            'status' => $request->status,
            'petugas_id' => auth()->id(), // Petugas yang sedang login
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit post
    public function edit(Post $post)
    {
        $kategori = Kategori::all(); // Mendapatkan semua kategori
        return view('admin.posts.edit', compact('post', 'kategori'));
    }

    // Mengupdate post
    public function update(Request $request, Post $post)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'isi' => 'required',
            'status' => 'required|in:draft,published',
        ]);

        // Update post
        $post->update([
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
            'isi' => $request->isi,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil diperbarui.');
    }

    // Menghapus post
    public function destroy(Post $post)
    {
        $post->delete(); // Hapus post
        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil dihapus.');
    }
}
