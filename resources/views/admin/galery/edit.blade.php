<!-- resources/views/admin/galery/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Edit Galeri</h2>

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

        <!-- Edit Gallery Form -->
        <form action="{{ route('admin.galery.update', $galery) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="post_id" class="block text-gray-700">Pilih Post</label>
                <select name="post_id" id="post_id" class="w-full p-3 border border-gray-300 rounded" required>
                    @foreach($posts as $post)
                        <option value="{{ $post->id }}" {{ old('post_id', $galery->post_id) == $post->id ? 'selected' : '' }}>{{ $post->judul }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="position" class="block text-gray-700">Position</label>
                <input type="number" name="position" id="position" value="{{ old('position', $galery->position) }}" required class="w-full p-3 border border-gray-300 rounded">
            </div>

            <div class="mb-4">
                <label for="status" class="block text-gray-700">Status</label>
                <select name="status" id="status" class="w-full p-3 border border-gray-300 rounded">
                    <option value="0" {{ old('status', $galery->status) == '0' ? 'selected' : '' }}>Inactive</option>
                    <option value="1" {{ old('status', $galery->status) == '1' ? 'selected' : '' }}>Active</option>
                </select>
            </div>

            <div class="flex space-x-2">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Galeri</button>
                <a href="{{ route('admin.galery.index') }}" class="bg-red-500 text-white px-4 py-2 rounded">Cancel</a> <!-- Cancel button -->
            </div>
        </form>
    </div>
@endsection
