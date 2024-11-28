<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Foto;
use App\Models\Galery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
{
    // Display a listing of the photos
    public function index()
    {
        $fotos = Foto::with('galery')->get();  // Uses the 'galery' table
        return view('admin.foto.index', compact('fotos'));
    }

    // Show form to create a new photo entry
    public function create()
    {
        $galeries = Galery::all();  // Retrieve all galleries
        return view('admin.foto.create', compact('galeries'));
    }

    // Store a new photo entry
    public function store(Request $request)
    {
        $request->validate([
            'galery_id' => 'required|exists:galery,id', // Corrected to 'galery'
            'file' => 'required|image',
            'judul' => 'required|string|max:255',
        ]);

        // Store the file
        $filePath = $request->file('file')->store('photos', 'public');

        // Save photo entry
        Foto::create([
            'galery_id' => $request->galery_id,
            'file' => $filePath,
            'judul' => $request->judul,
        ]);

        return redirect()->route('admin.foto.index')->with('success', 'Photo successfully added.');
    }

    // Show form to edit an existing photo entry
    public function edit(Foto $foto)
    {
        $galeries = Galery::all();
        return view('admin.foto.edit', compact('foto', 'galeries'));
    }

    // Update an existing photo entry
    public function update(Request $request, Foto $foto)
    {
        $request->validate([
            'galery_id' => 'required|exists:galery,id', // Corrected to 'galery'
            'file' => 'nullable|image',
            'judul' => 'required|string|max:255',
        ]);

        // Update the file if a new one is uploaded
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('photos', 'public');
            $foto->file = $filePath;
        }

        // Update photo entry
        $foto->update([
            'galery_id' => $request->galery_id,
            'judul' => $request->judul,
        ]);

        return redirect()->route('admin.foto.index')->with('success', 'Photo successfully updated.');
    }

    // Delete a photo entry
    public function destroy(Foto $foto)
    {
        // Optionally delete the file from storage if needed
        if ($foto->file) {
            Storage::disk('public')->delete($foto->file);
        }

        $foto->delete();

        return redirect()->route('admin.foto.index')->with('success', 'Photo successfully deleted.');
    }
}

