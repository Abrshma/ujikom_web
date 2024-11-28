<!-- resources/views/admin/posts/create.blade.php -->
@extends('layouts.app') <!-- Assuming you have a layout file -->

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Tambah Post</h2>

        <!-- Display Validation Errors -->
        @if($errors->any())
            <div class="mb-4 text-red-500">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Create Post Form -->
        <form action="{{ route('admin.posts.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="judul" class="block text-gray-700">Judul Post</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul') }}" required class="w-full p-3 border border-gray-300 rounded">
            </div>

            <div class="mb-4">
                <label for="kategori_id" class="block text-gray-700">Kategori</label>
                <select name="kategori_id" id="kategori_id" class="w-full p-3 border border-gray-300 rounded" required>
                    @foreach($kategori as $cat)
                        <option value="{{ $cat->id }}" {{ old('kategori_id') == $cat->id ? 'selected' : '' }}>{{ $cat->judul }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="isi" class="block text-gray-700">Isi Post</label>
                <textarea name="isi" id="isi" rows="4" class="w-full p-3 border border-gray-300 rounded" required>{{ old('isi') }}</textarea>
            </div>

            <div class="mb-4">
                <label for="status" class="block text-gray-700">Status</label>
                <select name="status" id="status" class="w-full p-3 border border-gray-300 rounded">
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan Post</button>
            <a href="{{ route('admin.posts.index') }}" class="bg-red-500 text-white px-4 py-2 rounded">Cancel</a> <!-- Cancel button -->
        </form>
    </div>
@endsection
