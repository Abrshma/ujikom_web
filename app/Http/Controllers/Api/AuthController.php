<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // API Login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Proses otentikasi
        if (Auth::attempt($credentials)) {
            $user = Auth::user(); // Ambil data pengguna yang terautentikasi
            $token = $user->createToken('auth_token')->plainTextToken; // Buat token API

            return response()->json([
                'success' => true,
                'message' => 'Login berhasil.',
                'data' => [
                    'user' => $user,
                    'token' => $token,
                ],
            ]);
        }

        // Jika login gagal
        return response()->json([
            'success' => false,
            'message' => 'Username atau password salah.',
        ], 401);
    }

    // API Logout
    public function logout(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $user->tokens()->delete(); // Hapus semua token API pengguna
        }

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil.',
        ]);
    }
}
