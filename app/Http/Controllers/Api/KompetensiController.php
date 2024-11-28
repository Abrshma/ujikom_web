<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KompetensiController extends Controller
{
    // Menampilkan data untuk kompetensi PPLG
    public function pplg()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'kompetensi' => 'PPLG',
                'deskripsi' => 'Pengembangan Perangkat Lunak dan Gim (PPLG) bertujuan untuk membentuk siswa menjadi ahli dalam membangun aplikasi perangkat lunak.',
            ],
        ]);
    }

    // Menampilkan data untuk kompetensi TJKT
    public function tjkt()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'kompetensi' => 'TJKT',
                'deskripsi' => 'Teknik Jaringan Komputer dan Telekomunikasi (TJKT) berfokus pada pengelolaan jaringan dan telekomunikasi yang handal.',
            ],
        ]);
    }

    // Menampilkan data untuk kompetensi TKR
    public function tkr()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'kompetensi' => 'TKR',
                'deskripsi' => 'Teknik Kendaraan Ringan (TKR) adalah kompetensi di bidang otomotif untuk pemeliharaan kendaraan ringan.',
            ],
        ]);
    }

    // Menampilkan data untuk kompetensi TFLM
    public function tflm()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'kompetensi' => 'TFLM',
                'deskripsi' => 'Teknik Fabrikasi Logam dan Manufaktur (TFLM) mempelajari proses manufaktur dan pengelolaan bahan logam.',
            ],
        ]);
    }
}
