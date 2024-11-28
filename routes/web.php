<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KompetensiController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\GaleryController;
use App\Http\Controllers\Admin\FotoController;

Route::get('/', function () {
    return view('welcome');
});

// Route untuk homepage menggunakan HomeController
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/', [HomeController::class, 'welcome'])->name('welcome');

    // Profil sekolah
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');

    // Agenda sekolah
    Route::get('/agenda', [HomeController::class, 'agenda'])->name('agenda');
    Route::get('/agenda/{id}', [HomeController::class, 'detailAgenda'])->name('agenda.detail');

    // Informasi sekolah
    Route::get('/informasi', [HomeController::class, 'informasi'])->name('informasi');
    Route::get('/informasi/{id}', [HomeController::class, 'detailInformasi'])->name('informasi.detail');

    // Galeri sekolah
    Route::get('/galeri', [HomeController::class, 'galeri'])->name('galeri');
    Route::get('/galeri/{galleryTitle}', [HomeController::class, 'showGallery'])->name('galeri.show');
    
    // Halaman Jurusan
    Route::get('/kompetensi/pplg', [KompetensiController::class, 'pplg'])->name('kompetensi.pplg');
    Route::get('/kompetensi/tjkt', [KompetensiController::class, 'tjkt'])->name('kompetensi.tjkt');
    Route::get('/kompetensi/tkr', [KompetensiController::class, 'tkr'])->name('kompetensi.tkr');
    Route::get('/kompetensi/tflm', [KompetensiController::class, 'tflm'])->name('kompetensi.tflm');

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin routes that require authentication
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Petugas
    Route::get('/petugas', [PetugasController::class, 'index'])->name('petugas.index');
    Route::get('/petugas/create', [PetugasController::class, 'create'])->name('petugas.create');
    Route::post('/petugas', [PetugasController::class, 'store'])->name('petugas.store');
    Route::get('/petugas/{petugas}/edit', [PetugasController::class, 'edit'])->name('petugas.edit');
    Route::put('/petugas/{petugas}', [PetugasController::class, 'update'])->name('petugas.update');
    Route::delete('/petugas/{petugas}', [PetugasController::class, 'destroy'])->name('petugas.destroy');

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/create', [ProfileController::class, 'create'])->name('profile.create');
    Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
    Route::get('/profile/{profile}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{profile}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/{profile}', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Kategori
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{kategori}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{kategori}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

    // Posts
    Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostsController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostsController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostsController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostsController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostsController::class, 'destroy'])->name('posts.destroy');

    // Galery
    Route::get('/galery', [GaleryController::class, 'index'])->name('galery.index');
    Route::get('/galery/create', [GaleryController::class, 'create'])->name('galery.create');
    Route::post('/galery', [GaleryController::class, 'store'])->name('galery.store');
    Route::get('/galery/{galery}/edit', [GaleryController::class, 'edit'])->name('galery.edit');
    Route::put('/galery/{galery}', [GaleryController::class, 'update'])->name('galery.update');
    Route::delete('/galery/{galery}', [GaleryController::class, 'destroy'])->name('galery.destroy');

    // Foto
    Route::get('/foto', [FotoController::class, 'index'])->name('foto.index');
    Route::get('/foto/create', [FotoController::class, 'create'])->name('foto.create');
    Route::post('/foto', [FotoController::class, 'store'])->name('foto.store');
    Route::get('/foto/{foto}/edit', [FotoController::class, 'edit'])->name('foto.edit');
    Route::put('/foto/{foto}', [FotoController::class, 'update'])->name('foto.update');
    Route::delete('/foto/{foto}', [FotoController::class, 'destroy'])->name('foto.destroy');
});
