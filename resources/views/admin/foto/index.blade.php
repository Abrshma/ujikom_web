<!-- resources/views/admin/foto/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Daftar Foto</h2>

        <!-- Success message -->
        @if(session('success'))
            <div class="mb-4 text-green-500">{{ session('success') }}</div>
        @endif

        <?php $i = 1; ?>

        <a href="{{ route('admin.foto.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Foto</a>

        <table class="min-w-full bg-white border border-gray-300 divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="py-2 px-4 border border-gray-300 text-left">No</th>
                    <th class="py-2 px-4 border border-gray-300 text-left">ID Foto</th>
                    <th class="py-2 px-4 border border-gray-300 text-left">Judul Foto</th>
                    <th class="py-2 px-4 border border-gray-300 text-left">ID Galeri</th>
                    <th class="py-2 px-4 border border-gray-300 text-left">File</th>
                    <th class="py-2 px-4 border border-gray-300 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($fotos as $foto)  <!-- Use $fotos here -->
                    <tr>
                        <td class="py-2 px-4 border border-gray-300">{{ $i++ }}</td>
                        <td class="py-2 px-4 border border-gray-300">{{ $foto->id }}</td>
                        <td class="py-2 px-4 border border-gray-300">{{ $foto->judul }}</td>  <!-- Display foto title -->
                        <td class="py-2 px-4 border border-gray-300">{{ $foto->galery->id }}</td> <!-- Display associated galery title -->
                        <td class="py-2 px-4 border border-gray-300"><img src="{{ asset('storage/' . $foto->file) }}" alt="{{ $foto->judul }}" width="100"></td> <!-- Display image -->
                        <td class="py-2 px-4 border border-gray-300">
                            <div class="flex justify-start space-x-2">
                                <a href="{{ route('admin.foto.edit', $foto) }}" class="bg-yellow-500 text-white px-3 py-1 rounded">Edit</a>
                                <form action="{{ route('admin.foto.destroy', $foto) }}" method="POST" onsubmit="return confirm('Are you sure?');">
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
