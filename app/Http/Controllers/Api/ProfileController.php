<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Menampilkan semua profil
    public function index()
    {
        $profiles = Profile::all();

        return response()->json([
            'success' => true,
            'data' => $profiles,
        ]);
    }

    // Menyimpan profil baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255|unique:profile,judul',
            'isi' => 'required|string',
        ]);

        $profile = Profile::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Profile berhasil ditambahkan.',
            'data' => $profile,
        ]);
    }

    // Menampilkan detail profil tertentu
    public function show(Profile $profile)
    {
        return response()->json([
            'success' => true,
            'data' => $profile,
        ]);
    }

    // Mengupdate profil
    public function update(Request $request, Profile $profile)
    {
        $request->validate([
            'judul' => 'required|string|max:255|unique:profile,judul,' . $profile->id,
            'isi' => 'required|string',
        ]);

        $profile->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Profile berhasil diperbarui.',
            'data' => $profile,
        ]);
    }

    // Menghapus profil
    public function destroy(Profile $profile)
    {
        $profile->delete();

        return response()->json([
            'success' => true,
            'message' => 'Profile berhasil dihapus.',
        ]);
    }
}
