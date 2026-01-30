@extends('layouts.evaluasi')

@section('content')
<div class="p-8" x-data="{ 
    showModal: false, 
    modalMode: 'create', 
    formAction: '{{ route('evaluasi.instansi.store') }}', 
    formData: { organization: '', name: '', email: '', address: '' },
    instansiId: null
}">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-xl font-bold text-[#1A237E]">Daftar Instansi/Dinas/Lembaga</h2>
            <p class="text-sm text-gray-500">Nama Instansi/Dinas/Lembaga diinput admin</p>
        </div>
        <div class="text-sm text-gray-500">
             <a href="{{ route('evaluasi.dashboard') }}" class="hover:text-[#E65100]">Dashboard</a> / Tabel
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Sukses!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    @if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Error!</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 pb-0">
             <button @click="
                showModal = true; 
                modalMode = 'create'; 
                instansiId = null;
                formAction = '{{ route('evaluasi.instansi.store') }}';
                formData = { organization: '', name: '', email: '', address: '' }
             " class="bg-green-600 text-white px-4 py-2 rounded text-xs font-bold hover:bg-green-700 transition uppercase">TAMBAH</button>
             <button @click="showModal = false" class="text-red-500 px-4 py-2 rounded text-xs font-bold hover:text-red-700 transition ml-2 uppercase">Batal</button>
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
                        <td class="px-4 py-4 text-center">
                            @if($instansi->is_active)
                                <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">Aktif</span>
                            @else
                                <span class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded">Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-4 py-4 space-y-1">
                            <button @click="
                                showModal = true; 
                                modalMode = 'edit'; 
                                instansiId = {{ $instansi->id }};
                                formAction = '{{ route('evaluasi.instansi.update', $instansi->id) }}';
                                formData = { 
                                    organization: '{{ addslashes($instansi->organization) }}', 
                                    name: '{{ addslashes($instansi->name) }}',
                                    email: '{{ $instansi->email }}',
                                    address: '{{ addslashes($instansi->address ?? '') }}'
                                }
                            " class="block text-blue-600 hover:underline font-semibold text-xs text-left w-full">Edit Profil</button>
                            
                            <a href="{{ route('evaluasi.instansi.nilai', $instansi->id) }}" class="block text-green-600 hover:underline font-bold text-xs uppercase">Nilai</a>
                            
                            <form action="{{ route('evaluasi.instansi.destroy', $instansi->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus instansi ini?');" class="block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline font-semibold text-xs text-left w-full">Hapus</button>
                            </form>
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

    <!-- Modal -->
    <div x-show="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 px-4" style="display: none;" x-transition>
        <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-xl transform transition-all" @click.away="showModal = false">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-gray-800" x-text="modalMode === 'create' ? 'Tambah Instansi' : 'Edit Profil Instansi'"></h3>
                <button @click="showModal = false" class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>
            
            <form :action="formAction" method="POST">
                @csrf
                <template x-if="modalMode === 'edit'">
                    <input type="hidden" name="_method" value="PUT">
                </template>
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Nama Instansi/OPD</label>
                    <input type="text" name="organization" x-model="formData.organization" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline uppercase" required>
                </div>

                <div class="mb-4" x-show="modalMode === 'create'">
                    <label class="block text-gray-700 text-sm font-bold mb-2">PIC (Nama User)</label>
                    <input type="text" name="name" x-model="formData.name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" :required="modalMode === 'create'">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Alamat</label>
                    <textarea name="address" x-model="formData.address" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="2"></textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Email (Username)</label>
                    <input type="email" name="email" x-model="formData.email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>

                <div class="mb-4" x-show="modalMode === 'create'">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                    <input type="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" :required="modalMode === 'create'">
                    <p x-show="modalMode === 'edit'" class="text-xs text-gray-500 mt-1">*Kosongkan jika tidak ingin mengubah password</p>
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" @click="showModal = false" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded text-sm">
                        Batal
                    </button>
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-sm">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
