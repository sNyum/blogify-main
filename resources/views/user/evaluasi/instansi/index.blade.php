@extends('layouts.evaluasi')

@section('content')
<div class="p-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-xl font-bold text-[#1A237E]">Daftar Instansi/Dinas/Lembaga</h2>
            <p class="text-sm text-gray-500">Nama Instansi/Dinas/Lembaga diinput admin</p>
        </div>
        <div class="text-sm text-gray-500">
             Dashboard / Tabel
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 pb-0">
             <button class="bg-green-600 text-white px-4 py-2 rounded text-xs font-bold hover:bg-green-700 transition">TAMBAH</button>
             <button class="text-red-500 px-4 py-2 rounded text-xs font-bold hover:text-red-700 transition ml-2 uppercase">Batal</button>
        </div>
        
        <div class="p-6">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-orange-400 text-white text-xs uppercase font-semibold">
                        <th class="px-4 py-3 rounded-tl-lg">No</th>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Alamat</th>
                        <th class="px-4 py-3">PIC</th>
                        <th class="px-4 py-3 text-center">Status</th>
                        <th class="px-4 py-3 rounded-tr-lg">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-600">
                    @forelse($instansis as $index => $instansi)
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="px-4 py-4">{{ $index + 1 }}</td>
                        <td class="px-4 py-4 font-medium text-gray-800 uppercase">{{ $instansi->organization }}</td>
                        <td class="px-4 py-4">{{ $instansi->address ?? '-' }}</td>
                        <td class="px-4 py-4">{{ $instansi->name }}</td>
                        <td class="px-4 py-4 text-center">{{ $instansi->id }}</td> <!-- Mock Status -->
                        <td class="px-4 py-4 space-y-1">
                            <a href="#" class="block text-blue-600 hover:underline font-semibold text-xs">Edit Profil</a>
                            <a href="{{ route('evaluasi.instansi.nilai', $instansi->id) }}" class="block text-green-600 hover:underline font-bold text-xs uppercase">Nilai</a>
                            <a href="#" class="block text-red-500 hover:underline font-semibold text-xs">Hapus</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">Belum ada data instansi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
