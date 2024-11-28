<!-- resources/views/admin/foto/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Edit Foto</h2>

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

        <!-- Edit Photo Form -->
        <form action="{{ route('admin.foto.update', $foto) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="galery_id" class="block text-gray-700">Pilih Galeri</label>
                <select name="galery_id" id="galery_id" class="w-full p-3 border border-gray-300 rounded" required>
                    @foreach($galeries as $galery)
                        <option value="{{ $galery->id }}" {{ old('galery_id', $foto->galery_id) == $galery->id ? 'selected' : '' }}>{{ $galery->post->judul }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="file" class="block text-gray-700">Pilih Foto</label>
                <input type="file" name="file" id="file" accept="image/*" class="w-full p-3 border border-gray-300 rounded">
                <small class="text-gray-500">Leave blank to keep the current image.</small>
            </div>

            <div class="mb-4">
                <label for="judul" class="block text-gray-700">Judul Foto</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul', $foto->judul) }}" required class="w-full p-3 border border-gray-300 rounded">
            </div>

            <div class="flex space-x-2">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Foto</button>
                <a href="{{ route('admin.foto.index') }}" class="bg-red-500 text-white px-4 py-2 rounded">Cancel</a> <!-- Cancel button -->
            </div>
        </form>
    </div>
@endsection
