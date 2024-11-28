@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Daftar Post</h2>

        <!-- Success message -->
        @if(session('success'))
            <div class="mb-4 text-green-500">{{ session('success') }}</div>
        @endif

        <?php
        $i = 1;
        ?>

        <a href="{{ route('admin.posts.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Post</a>

        <table class="min-w-full bg-white border border-gray-300 divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="py-2 px-4 border border-gray-300 text-left">No</th>
                    <th class="py-2 px-4 border border-gray-300 text-left">ID Post</th>
                    <th class="py-2 px-4 border border-gray-300 text-left">Judul Post</th>
                    <th class="py-2 px-4 border border-gray-300 text-left">Judul Kategori</th>
                    <th class="py-2 px-4 border border-gray-300 text-left">Isi Post</th> <!-- Added Isi Column -->
                    <th class="py-2 px-4 border border-gray-300 text-left">ID Petugas</th> <!-- Added Petugas ID Column -->
                    <th class="py-2 px-4 border border-gray-300 text-left">Status</th>
                    <th class="py-2 px-4 border border-gray-300 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($posts as $post)
                    <tr>
                        <td class="py-2 px-4 border border-gray-300"><?php echo $i++; ?></td>
                        <td class="py-2 px-4 border border-gray-300">{{ $post->id }}</td>
                        <td class="py-2 px-4 border border-gray-300">{{ $post->judul }}</td>
                        <td class="py-2 px-4 border border-gray-300">{{ $post->kategori->judul }}</td> <!-- Display category name -->
                        <td class="py-2 px-4 border border-gray-300">{{ Str::limit($post->isi, 50) }}</td> <!-- Display isi -->
                        <td class="py-2 px-4 border border-gray-300">{{ $post->petugas_id }}</td> <!-- Display petugas ID -->
                        <td class="py-2 px-4 border border-gray-300">{{ $post->status }}</td> <!-- Display status -->
                        <td class="py-2 px-4 border border-gray-300">
                            <div class="flex justify-start space-x-2">
                                <a href="{{ route('admin.posts.edit', $post) }}" class="bg-yellow-500 text-white px-3 py-1 rounded">Edit</a>
                                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure?');">
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
