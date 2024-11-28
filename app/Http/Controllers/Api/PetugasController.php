<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    // Get all petugas
    public function index()
    {
        $petugas = Petugas::all();
        return response()->json([
            'success' => true,
            'data' => $petugas,
        ]);
    }

    // Store a new petugas
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:petugas,username',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $petugas = Petugas::create([
            'username' => $request->username,
            'password' => Hash::make($request->password), // Password hashing
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Petugas berhasil ditambahkan.',
            'data' => $petugas,
        ]);
    }

    // Show a specific petugas
    public function show(Petugas $petugas)
    {
        return response()->json([
            'success' => true,
            'data' => $petugas,
        ]);
    }

    // Update an existing petugas
    public function update(Request $request, Petugas $petugas)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:petugas,username,' . $petugas->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $petugas->username = $request->username;

        if ($request->filled('password')) {
            $petugas->password = Hash::make($request->password); // Password hashing
        }

        $petugas->save();

        return response()->json([
            'success' => true,
            'message' => 'Petugas berhasil diperbarui.',
            'data' => $petugas,
        ]);
    }

    // Delete a petugas
    public function destroy(Petugas $petugas)
    {
        $petugas->delete();

        return response()->json([
            'success' => true,
            'message' => 'Petugas berhasil dihapus.',
        ]);
    }
}
