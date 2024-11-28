<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Galery;
use App\Models\Post;
use Illuminate\Http\Request;

class GaleryController extends Controller
{
    // Get all galleries
    public function index()
    {
        $galleries = Galery::with('post')->get();
        return response()->json([
            'success' => true,
            'data' => $galleries,
        ]);
    }

    // Store a new gallery entry
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'position' => 'required|integer',
            'status' => 'required|integer',
        ]);

        $gallery = Galery::create([
            'post_id' => $request->post_id,
            'position' => $request->position,
            'status' => $request->status,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Gallery entry successfully added.',
            'data' => $gallery,
        ]);
    }

    // Show a specific gallery
    public function show(Galery $galery)
    {
        $galery->load('post');
        return response()->json([
            'success' => true,
            'data' => $galery,
        ]);
    }

    // Update an existing gallery entry
    public function update(Request $request, Galery $galery)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'position' => 'required|integer',
            'status' => 'required|integer',
        ]);

        $galery->update([
            'post_id' => $request->post_id,
            'position' => $request->position,
            'status' => $request->status,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Gallery entry successfully updated.',
            'data' => $galery,
        ]);
    }

    // Delete a gallery entry
    public function destroy(Galery $galery)
    {
        $galery->delete();
        return response()->json([
            'success' => true,
            'message' => 'Gallery entry successfully deleted.',
        ]);
    }
}
