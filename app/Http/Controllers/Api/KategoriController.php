<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // Get all categories
    public function index()
    {
        $kategori = Kategori::all();
        return response()->json([
            'success' => true,
            'data' => $kategori,
        ]);
    }

    // Store a new category
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255|unique:kategori,judul',
        ]);

        $kategori = Kategori::create([
            'judul' => $request->judul,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil ditambahkan.',
            'data' => $kategori,
        ]);
    }

    // Show a specific category
    public function show(Kategori $kategori)
    {
        return response()->json([
            'success' => true,
            'data' => $kategori,
        ]);
    }

    // Update a category
    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'judul' => 'required|string|max:255|unique:kategori,judul,' . $kategori->id,
        ]);

        $kategori->update([
            'judul' => $request->judul,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil diperbarui.',
            'data' => $kategori,
        ]);
    }

    // Delete a category
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil dihapus.',
        ]);
    }
}
