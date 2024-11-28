<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // Menampilkan daftar kategori
    public function index(Request $request)
    {
        $kategori = Kategori::all(); // Get all categories
        return view('admin.kategori.index', compact('kategori')); // Return to view with categories
    }

    // Menampilkan form untuk menambah kategori
    public function create()
    {
        return view('admin.kategori.create'); // Show create form
    }

    // Menyimpan kategori baru
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'judul' => 'required|string|max:255|unique:kategori,judul', // Ensure unique category title
        ]);

        // Create new kategori
        Kategori::create([
            'judul' => $request->judul,
        ]);

        return redirect()->route('admin.kategori.index')
                         ->with('success', 'Kategori berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit kategori
    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.edit', compact('kategori')); // Show edit form with category data
    }

    // Mengupdate kategori
    public function update(Request $request, Kategori $kategori)
    {
        // Validate input
        $request->validate([
            'judul' => 'required|string|max:255|unique:kategori,judul,' . $kategori->id, // Ensure unique category title, excluding the current one
        ]);

        // Update kategori data
        $kategori->update([
            'judul' => $request->judul,
        ]);

        return redirect()->route('admin.kategori.index')
                         ->with('success', 'Kategori berhasil diperbarui.');
    }

    // Menghapus kategori
    public function destroy(Kategori $kategori)
    {
        $kategori->delete(); // Delete category record
        return redirect()->route('admin.kategori.index')
                         ->with('success', 'Kategori berhasil dihapus.');
    }
}
