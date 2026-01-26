@extends('layouts.evaluasi')

@section('content')
    <div class="p-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-[#1A237E]">Daftar Pengguna</h2>
            <div class="text-sm text-gray-400">
                <a href="{{ route('evaluasi.dashboard') }}" class="hover:text-[#E65100]">Dashboard</a> / <span class="text-gray-600">Tabel</span>
            </div>
        </div>
        <p class="text-sm text-blue-400 mb-6">Nama operator diinput admin</p>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mb-6">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-orange-400 text-white font-bold">
                        <tr>
                            <th class="px-4 py-3 border-r border-orange-300">No</th>
                            <th class="px-4 py-3 border-r border-orange-300">Nama</th>
                            <th class="px-4 py-3 border-r border-orange-300">User</th>
                            <th class="px-4 py-3 border-r border-orange-300">Instansi</th>
                            <th class="px-4 py-3 border-r border-orange-300">Email</th>
                            <th class="px-4 py-3 border-r border-orange-300 text-center">Akses</th>
                            <th class="px-4 py-3 border-r border-orange-300 text-center">Status</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($users as $index => $u)
                        <tr class="hover:bg-orange-50 transition">
                            <td class="px-4 py-3 font-medium text-gray-900 border-r border-gray-100">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 text-gray-800 border-r border-gray-100">{{ $u->name }}</td>
                            <td class="px-4 py-3 text-gray-600 border-r border-gray-100">{{ explode('@', $u->email)[0] }}</td> <!-- Mock User -->
                            <td class="px-4 py-3 text-gray-600 border-r border-gray-100">{{ $u->organization ?? '-' }}</td>
                            <td class="px-4 py-3 text-gray-600 border-r border-gray-100">{{ $u->email }}</td>
                            <td class="px-4 py-3 text-center text-gray-600 border-r border-gray-100">{{ rand(1,3) }}</td> <!-- Mock Akses -->
                            <td class="px-4 py-3 text-center text-gray-600 border-r border-gray-100">{{ rand(1,4) }}</td> <!-- Mock Status -->
                            <td class="px-4 py-3 text-center">
                                <a href="#" class="block text-blue-600 hover:underline mb-1 font-bold text-xs">Edit</a>
                                <a href="#" class="block text-red-600 hover:underline font-bold text-xs">Hapus</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex gap-3">
            <button class="bg-[#2E7D32] text-white font-bold py-2 px-6 rounded shadow-sm hover:bg-green-700 transition uppercase text-sm">
                Tambah
            </button>
            <button class="bg-white border border-red-500 text-red-500 font-bold py-2 px-6 rounded shadow-sm hover:bg-red-50 transition uppercase text-sm">
                Batal
            </button>
        </div>

    </div>
@endsection
