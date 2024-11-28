<!-- resources/views/admin/petugas/index.blade.php -->
@extends('layouts.app') <!-- Assuming you have a layout file -->

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Daftar Petugas</h2>

        <!-- Success message -->
        @if(session('success'))
            <div class="mb-4 text-green-500">{{ session('success') }}</div>
        @endif

        <?php
        $i = 1;
        ?>

        <a href="{{ route('admin.petugas.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Petugas</a>

        <table class="min-w-full bg-white border border-gray-300 divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="py-2 px-4 border border-gray-300 text-left">No</th>
                    <th class="py-2 px-4 border border-gray-300 text-left">ID Petugas</th> <!-- New ID column -->
                    <th class="py-2 px-4 border border-gray-300 text-left">Username</th>
                    <th class="py-2 px-4 border border-gray-300 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($petugas as $petugas)
                    <tr>
                        <td class="py-2 px-4 border border-gray-300"><?php echo $i++; ?></td>
                        <td class="py-2 px-4 border border-gray-300">{{ $petugas->id }}</td>
                        <td class="py-2 px-4 border border-gray-300">{{ $petugas->username }}</td>
                        <td class="py-2 px-4 border border-gray-300">
                            <div class="flex justify-start space-x-2">
                                <a href="{{ route('admin.petugas.edit', $petugas) }}" class="bg-yellow-500 text-white px-3 py-1 rounded">Edit</a>

                                <!-- Delete Form -->
                                <form action="{{ route('admin.petugas.destroy', $petugas) }}" method="POST" onsubmit="return confirm('Are you sure?');">
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
