<!-- resources/views/admin/petugas/edit.blade.php -->
@extends('layouts.app') <!-- Assuming you have a layout file -->

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Edit Petugas</h2>

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

        <!-- Edit Petugas Form -->
        <form action="{{ route('admin.petugas.update', $petugas) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="username" class="block text-gray-700">Username</label>
                <input type="text" name="username" id="username" value="{{ old('username', $petugas->username) }}" required class="w-full p-3 border border-gray-300 rounded">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password (Leave empty to keep current)</label>
                <input type="password" name="password" id="password" class="w-full p-3 border border-gray-300 rounded">
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full p-3 border border-gray-300 rounded">
            </div>

            <div class="flex space-x-2">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Petugas</button>
                <a href="{{ route('admin.petugas.index') }}" class="bg-red-500 text-white px-4 py-2 rounded">Cancel</a> <!-- Cancel button -->
            </div>
        </form>
    </div>
@endsection
