<?php

// app/Models/Photo.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    // Tentukan atribut yang boleh diisi (mass assignable)
    protected $fillable = ['judul', 'file', 'likes_count'];

    // Jika Anda menggunakan timestamp
    public $timestamps = true;
}

