<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
{
    // Fetch all photos with their associated gallery
    public function index()
    {
        $fotos = Foto::with('galery')->get();

        // Set base URL
        $baseUrl = url('/'); // This will give you "http://127.0.0.1:8000"

        // Transform file column to API link
        foreach ($fotos as $foto) {
            $foto->file = $baseUrl . Storage::url($foto->file);
        }

        return response()->json([
            'success' => true,
            'data' => $fotos,
        ]);
    }

    // Create a new photo entry
    public function store(Request $request)
    {
        $request->validate([
            'galery_id' => 'required|exists:galery,id',
            'file' => 'required|image',
            'judul' => 'required|string|max:255',
        ]);

        // Store the file
        $filePath = $request->file('file')->store('photos', 'public');

        // Save photo entry
        $foto = Foto::create([
            'galery_id' => $request->galery_id,
            'file' => $filePath,
            'judul' => $request->judul,
        ]);

        // Set base URL
        $baseUrl = url('/'); // This will give you "http://127.0.0.1:8000"

        // Convert file path to API URL
        $foto->file = $baseUrl . Storage::url($foto->file);

        return response()->json([
            'success' => true,
            'message' => 'Photo successfully added.',
            'data' => $foto,
        ]);
    }

    // Show details of a specific photo
    public function show(Foto $foto)
    {
        $foto->load('galery'); // Load related gallery

        // Set base URL
        $baseUrl = url('/'); // This will give you "http://127.0.0.1:8000"

        // Convert file path to API URL
        $foto->file = $baseUrl . Storage::url($foto->file);

        return response()->json([
            'success' => true,
            'data' => $foto,
        ]);
    }

    // Update an existing photo entry
    public function update(Request $request, Foto $foto)
    {
        $request->validate([
            'galery_id' => 'required|exists:galery,id',
            'file' => 'nullable|image',
            'judul' => 'required|string|max:255',
        ]);

        // Update the file if a new one is uploaded
        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($foto->file) {
                Storage::disk('public')->delete($foto->file);
            }

            $filePath = $request->file('file')->store('photos', 'public');
            $foto->file = $filePath;
        }

        // Update other fields
        $foto->update([
            'galery_id' => $request->galery_id,
            'judul' => $request->judul,
        ]);

        // Set base URL
        $baseUrl = url('/'); // This will give you "http://127.0.0.1:8000"

        // Convert file path to API URL
        $foto->file = $baseUrl . Storage::url($foto->file);

        return response()->json([
            'success' => true,
            'message' => 'Photo successfully updated.',
            'data' => $foto,
        ]);
    }

    // Delete a photo entry
    public function destroy(Foto $foto)
    {
        // Optionally delete the file from storage
        if ($foto->file) {
            Storage::disk('public')->delete($foto->file);
        }

        $foto->delete();

        return response()->json([
            'success' => true,
            'message' => 'Photo successfully deleted.',
        ]);
    }
}
