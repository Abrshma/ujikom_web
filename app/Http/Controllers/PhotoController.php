<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Comment;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    // Handle like request
    public function like($photoId)
    {
        $photo = Photo::findOrFail($photoId);

        // Menyimpan ID foto yang telah di-like dalam session
        $likes = session()->get('likes', []);

        if (!in_array($photoId, $likes)) {
            // Jika foto belum di-like, tambah 1 ke like
            $photo->increment('likes_count');
            $likes[] = $photoId;
            session()->put('likes', $likes);  // Simpan ID foto yang di-like di session
        }

        return back();  // Kembali ke halaman foto
    }

    // Handle comment request
    public function comment(Request $request, $photoId)
    {
        $photo = Photo::findOrFail($photoId);
    
        // Mendapatkan komentar dari request
        $newComment = [
            'name' => $request->name,
            'comment' => $request->comment,
            'created_at' => now(),
        ];
    
        // Menyimpan komentar ke dalam session
        $comments = session()->get("comments_$photoId", []);
        $comments[] = $newComment;
        session()->put("comments_$photoId", $comments);
    
        return back();  // Kembali ke halaman foto
    }    
}
