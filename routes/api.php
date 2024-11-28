<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\KompetensiController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\FotoController;
use App\Http\Controllers\Api\GaleryController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\PetugasController;
use App\Http\Controllers\Api\PostsController;
use App\Http\Controllers\Api\ProfileController;

// Route::get('/user', function (Request $request) { //return $request->user();// })->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']); // Endpoint untuk login
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum'); // Endpoint untuk logout (hanya dapat diakses jika login)

Route::get('/welcome', [HomeController::class, 'welcome']);
Route::get('/profile', [HomeController::class, 'profile']);
Route::get('/galeri', [HomeController::class, 'galeri']);
Route::get('/galeri/{galleryTitle}', [HomeController::class, 'showGallery']);
Route::get('/agenda', [HomeController::class, 'agenda']);
Route::get('/agenda/{id}', [HomeController::class, 'detailAgenda']);
Route::get('/informasi', [HomeController::class, 'informasi']);
Route::get('/informasi/{id}', [HomeController::class, 'detailInformasi']);

Route::get('/kompetensi/pplg', [KompetensiController::class, 'pplg']);
Route::get('/kompetensi/tjkt', [KompetensiController::class, 'tjkt']);
Route::get('/kompetensi/tkr', [KompetensiController::class, 'tkr']);
Route::get('/kompetensi/tflm', [KompetensiController::class, 'tflm']);

Route::get('dashboard', [DashboardController::class, 'index']);

Route::prefix('foto')->group(function () {
    Route::get('/', [FotoController::class, 'index']); // Get all photos
    Route::post('/', [FotoController::class, 'store']); // Create a new photo
    Route::get('/{foto}', [FotoController::class, 'show']); // Get a specific photo
    Route::put('/{foto}', [FotoController::class, 'update']); // Update a photo
    Route::delete('/{foto}', [FotoController::class, 'destroy']); // Delete a photo
});

Route::prefix('galery')->group(function () {
    Route::get('/', [GaleryController::class, 'index']); // Get all galleries
    Route::post('/', [GaleryController::class, 'store']); // Add a new gallery
    Route::get('/{galery}', [GaleryController::class, 'show']); // Show a specific gallery
    Route::put('/{galery}', [GaleryController::class, 'update']); // Update an existing gallery
    Route::delete('/{galery}', [GaleryController::class, 'destroy']); // Delete a gallery
});

Route::prefix('posts')->group(function () {
    Route::get('/', [PostsController::class, 'index']); // Get all posts
    Route::post('/', [PostsController::class, 'store']); // Add a new post
    Route::get('/{post}', [PostsController::class, 'show']); // Show a specific post
    Route::put('/{post}', [PostsController::class, 'update']); // Update a specific post
    Route::delete('/{post}', [PostsController::class, 'destroy']); // Delete a specific post
});

Route::prefix('kategori')->group(function () {
    Route::get('/', [KategoriController::class, 'index']); // Get all categories
    Route::post('/', [KategoriController::class, 'store']); // Add a new category
    Route::get('/{kategori}', [KategoriController::class, 'show']); // Show a specific category
    Route::put('/{kategori}', [KategoriController::class, 'update']); // Update an existing category
    Route::delete('/{kategori}', [KategoriController::class, 'destroy']); // Delete a category
});

Route::prefix('petugas')->group(function () {
    Route::get('/', [PetugasController::class, 'index']); // Get all petugas
    Route::post('/', [PetugasController::class, 'store']); // Add a new petugas
    Route::get('/{petugas}', [PetugasController::class, 'show']); // Show a specific petugas
    Route::put('/{petugas}', [PetugasController::class, 'update']); // Update an existing petugas
    Route::delete('/{petugas}', [PetugasController::class, 'destroy']); // Delete a petugas
});

Route::prefix('profiles')->group(function () {
    Route::get('/', [ProfileController::class, 'index']); // Menampilkan semua profil
    Route::post('/', [ProfileController::class, 'store']); // Menambahkan profil baru
    Route::get('/{profile}', [ProfileController::class, 'show']); // Menampilkan detail profil tertentu
    Route::put('/{profile}', [ProfileController::class, 'update']); // Mengupdate profil
    Route::delete('/{profile}', [ProfileController::class, 'destroy']); // Menghapus profil
});