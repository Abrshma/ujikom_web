<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galery;
use App\Models\Post;
use Illuminate\Http\Request;

class GaleryController extends Controller
{
    // Display a listing of galleries
    public function index()
    {
        $galleries = Galery::with('post')->get();
        return view('admin.galery.index', compact('galleries'));
    }

    // Show form to create a new gallery entry
    public function create()
    {
        $posts = Post::all(); // Retrieve all posts
        return view('admin.galery.create', compact('posts'));
    }

    // Store a new gallery entry
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'position' => 'required|integer',
            'status' => 'required|integer',
        ]);

        // Save gallery entry
        Galery::create([
            'post_id' => $request->post_id,
            'position' => $request->position,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.galery.index')->with('success', 'Gallery entry successfully added.');
    }

    // Show form to edit an existing gallery entry
    public function edit(Galery $galery)
    {
        $posts = Post::all(); // Retrieve all posts
        return view('admin.galery.edit', compact('galery', 'posts'));
    }

    // Update an existing gallery entry
    public function update(Request $request, Galery $galery)
    {
        // Validate input
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'position' => 'required|integer',
            'status' => 'required|integer',
        ]);

        // Update gallery entry
        $galery->update([
            'post_id' => $request->post_id,
            'position' => $request->position,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.galery.index')->with('success', 'Gallery entry successfully updated.');
    }

    // Delete a gallery entry
    public function destroy(Galery $galery)
    {
        $galery->delete();
        return redirect()->route('admin.galery.index')->with('success', 'Gallery entry successfully deleted.');
    }
}
