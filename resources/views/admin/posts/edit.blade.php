<!-- resources/views/admin/posts/edit.blade.php -->
@extends('layouts.app') <!-- Assuming you have a layout file -->

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Edit Post</h2>

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

        <!-- Edit Post Form -->
        <form action="{{ route('admin.posts.update', $post) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="judul" class="block text-gray-700">Judul Post</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul', $post->judul) }}" required class="w-full p-3 border border-gray-300 rounded">
            </div>

            <div class="mb-4">
                <label for="kategori_id" class="block text-gray-700">Kategori</label>
                <select name="kategori_id" id="kategori_id" class="w-full p-3 border border-gray-300 rounded" required>
                    @foreach($kategori as $cat)
                        <option value="{{ $cat->id }}" {{ old('kategori_id', $post->kategori_id) == $cat->id ? 'selected' : '' }}>{{ $cat->judul }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="isi" class="block text-gray-700">Isi Post</label>
                <textarea name="isi" id="isi" rows="4" class="w-full p-3 border border-gray-300 rounded" required>{{ old('isi', $post->isi) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="status" class="block text-gray-700">Status</label>
                <select name="status" id="status" class="w-full p-3 border border-gray-300 rounded">
                    <option value="draft" {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>Published</option>
                </select>
            </div>

            <div class="flex space-x-2">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Post</button>
                <a href="{{ route('admin.posts.index') }}" class="bg-red-500 text-white px-4 py-2 rounded">Cancel</a> <!-- Cancel button -->
            </div>
        </form>
    </div>
@endsection
