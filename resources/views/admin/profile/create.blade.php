@extends('layouts.app') <!-- Assuming you have a layout file -->

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Tambah Profile</h2>

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

        <!-- Create Profile Form -->
        <form action="{{ route('admin.profile.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="judul" class="block text-gray-700">Judul Profile</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul') }}" required class="w-full p-3 border border-gray-300 rounded">
            </div>

            <div class="mb-4">
                <label for="isi" class="block text-gray-700">Isi Profile</label>
                <textarea name="isi" id="isi" rows="4" class="w-full p-3 border border-gray-300 rounded" required>{{ old('isi') }}</textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan Profile</button>
            <a href="{{ route('admin.profile.index') }}" class="bg-red-500 text-white px-4 py-2 rounded">Cancel</a> <!-- Cancel button -->
        </form>
    </div>
@endsection
