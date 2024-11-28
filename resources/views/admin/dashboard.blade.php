@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Display Total Petugas -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold">Total Petugas</h3>
            <p class="mt-2 text-gray-600">{{ $totalPetugas }}</p>
        </div>
        <!-- Display Total Kategori -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold">Total Kategori</h3>
            <p class="mt-2 text-gray-600">{{ $totalKategori }}</p>
        </div>
        <!-- Display Total Posts -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold">Total Posts</h3>
            <p class="mt-2 text-gray-600">{{ $totalPosts }}</p>
        </div>
    </div>
</div>
@endsection
