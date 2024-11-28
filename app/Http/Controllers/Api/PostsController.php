<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Kategori;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    // Get all posts
    public function index()
    {
        $posts = Post::with('kategori', 'petugas')->get();

        return response()->json([
            'success' => true,
            'data' => $posts,
        ]);
    }

    // Store a new post
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'isi' => 'required',
            'status' => 'required|in:draft,published',
        ]);

        $post = Post::create([
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
            'isi' => $request->isi,
            'status' => $request->status,
            'petugas_id' => auth()->id(), // ID petugas yang sedang login
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Post berhasil ditambahkan.',
            'data' => $post,
        ]);
    }

    // Show a specific post
    public function show(Post $post)
    {
        $post->load('kategori', 'petugas'); // Load relationships

        return response()->json([
            'success' => true,
            'data' => $post,
        ]);
    }

    // Update a specific post
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'isi' => 'required',
            'status' => 'required|in:draft,published',
        ]);

        $post->update([
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
            'isi' => $request->isi,
            'status' => $request->status,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Post berhasil diperbarui.',
            'data' => $post,
        ]);
    }

    // Delete a specific post
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post berhasil dihapus.',
        ]);
    }
}
