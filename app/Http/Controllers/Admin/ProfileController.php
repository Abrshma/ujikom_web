<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Menampilkan daftar profil
    public function index()
    {
        $profiles = Profile::all();
        return view('admin.profile.index', compact('profiles'));
    }

    // Menampilkan form untuk menambah profil
    public function create()
    {
        return view('admin.profile.create');
    }

    // Menyimpan profil baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255|unique:profile,judul',
            'isi' => 'required|string',
        ]);

        Profile::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
        ]);

        return redirect()->route('admin.profile.index')
                         ->with('success', 'Profile berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit profil
    public function edit(Profile $profile)
    {
        return view('admin.profile.edit', compact('profile'));
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

        return redirect()->route('admin.profile.index')
                         ->with('success', 'Profile berhasil diperbarui.');
    }

    // Menghapus profil
    public function destroy(Profile $profile)
    {
        $profile->delete();
        return redirect()->route('admin.profile.index')
                         ->with('success', 'Profile berhasil dihapus.');
    }
}
