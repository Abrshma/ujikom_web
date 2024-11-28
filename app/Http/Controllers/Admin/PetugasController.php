<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    // Menampilkan daftar petugas
    public function index()
    {
        $petugas = Petugas::all(); // Mendapatkan semua data petugas
        return view('admin.petugas.index', compact('petugas'));
    }

    // Menampilkan form untuk menambah petugas
    public function create()
    {
        return view('admin.petugas.create'); // Menampilkan form create
    }

    // Menyimpan petugas baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string|max:255|unique:petugas,username',
            'password' => 'required|string|min:8|confirmed', // password confirmation rule
        ]);

        // Membuat petugas baru
        Petugas::create([
            'username' => $request->username,
            'password' => $request->password, // Password akan otomatis ter-hash oleh model
        ]);

        return redirect()->route('admin.petugas.index')
                         ->with('success', 'Petugas berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit petugas
    public function edit(Petugas $petugas)
    {
        return view('admin.petugas.edit', compact('petugas')); // Menampilkan form edit dengan data petugas
    }

    // Mengupdate petugas
    public function update(Request $request, Petugas $petugas)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string|max:255|unique:petugas,username,' . $petugas->id,
            'password' => 'nullable|string|min:8|confirmed', // password confirmation rule
        ]);

        // Update data petugas
        $petugas->username = $request->username;

        // Update password jika diberikan
        if ($request->filled('password')) {
            $petugas->password = $request->password; // Password akan otomatis ter-hash oleh model
        }

        $petugas->save();

        return redirect()->route('admin.petugas.index')
                         ->with('success', 'Petugas berhasil diperbarui.');
    }

    // Menghapus petugas
    public function destroy(Petugas $petugas)
    {
        $petugas->delete(); // Menghapus data petugas
        return redirect()->route('admin.petugas.index')
                         ->with('success', 'Petugas berhasil dihapus.');
    }
}
