<!-- resources/views/admin/galery/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Daftar Galeri</h2>

        <!-- Success message -->
        @if(session('success'))
            <div class="mb-4 text-green-500">{{ session('success') }}</div>
        @endif

        <?php $i = 1; ?>

        <a href="{{ route('admin.galery.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Galeri</a>

        <table class="min-w-full bg-white border border-gray-300 divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="py-2 px-4 border border-gray-300 text-left">No</th>
                    <th class="py-2 px-4 border border-gray-300 text-left">ID Galery</th>
                    <th class="py-2 px-4 border border-gray-300 text-left">Judul Post</th>
                    <th class="py-2 px-4 border border-gray-300 text-left">Position</th>
                    <th class="py-2 px-4 border border-gray-300 text-left">Status</th>
                    <th class="py-2 px-4 border border-gray-300 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($galleries as $gallery)
                    <tr>
                        <td class="py-2 px-4 border border-gray-300">{{ $i++ }}</td>
                        <td class="py-2 px-4 border border-gray-300">{{ $gallery->id }}</td> <!-- Display id -->
                        <td class="py-2 px-4 border border-gray-300">{{ $gallery->post->judul }}</td> <!-- Display post title -->
                        <td class="py-2 px-4 border border-gray-300">{{ $gallery->position }}</td> <!-- Display position -->
                        <td class="py-2 px-4 border border-gray-300">{{ $gallery->status }}</td> <!-- Display status -->
                        <td class="py-2 px-4 border border-gray-300">
                            <div class="flex justify-start space-x-2">
                                <a href="{{ route('admin.galery.edit', $gallery) }}" class="bg-yellow-500 text-white px-3 py-1 rounded">Edit</a>
                                <form action="{{ route('admin.galery.destroy', $gallery) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
