@extends('layouts.evaluasi')

@section('content')
    <div class="p-8" x-data="{ 
        showModal: false, 
        modalMode: 'create', 
        formAction: '{{ route('evaluasi.pengguna.store') }}', 
        formData: { name: '', email: '', organization: '', is_active: true },
        userId: null
    }">
    
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-[#1A237E]">Daftar Pengguna</h2>
            <div class="text-sm text-gray-400">
                <a href="{{ route('evaluasi.dashboard') }}" class="hover:text-[#E65100]">Dashboard</a> / <span class="text-gray-600">Tabel</span>
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
                            <td class="px-4 py-3 text-gray-600 border-r border-gray-100">{{ explode('@', $u->email)[0] }}</td>
                            <td class="px-4 py-3 text-gray-600 border-r border-gray-100">{{ $u->organization ?? '-' }}</td>
                            <td class="px-4 py-3 text-gray-600 border-r border-gray-100">{{ $u->email }}</td>
                            <td class="px-4 py-3 text-center text-gray-600 border-r border-gray-100">1</td>
                            <td class="px-4 py-3 text-center border-r border-gray-100">
                                @if($u->is_active)
                                    <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">Aktif</span>
                                @else
                                    <span class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded">Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center">
                                <button @click="
                                    showModal = true; 
                                    modalMode = 'edit'; 
                                    userId = {{ $u->id }};
                                    formAction = '{{ route('evaluasi.pengguna.update', $u->id) }}';
                                    formData = { 
                                        name: '{{ addslashes($u->name) }}', 
                                        email: '{{ $u->email }}', 
                                        organization: '{{ addslashes($u->organization) }}',
                                        is_active: {{ $u->is_active ? 'true' : 'false' }}
                                    }
                                " class="block text-blue-600 hover:underline mb-1 font-bold text-xs cursor-pointer w-full text-center">Edit</button>
                                
                                <form action="{{ route('evaluasi.pengguna.destroy', $u->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?');" class="inline-block w-full">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="block text-red-600 hover:underline font-bold text-xs cursor-pointer w-full text-center">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex gap-3">
            <button @click="
                showModal = true; 
                modalMode = 'create'; 
                userId = null;
                formAction = '{{ route('evaluasi.pengguna.store') }}';
                formData = { name: '', email: '', organization: '', is_active: true }
            " class="bg-[#2E7D32] text-white font-bold py-2 px-6 rounded shadow-sm hover:bg-green-700 transition uppercase text-sm">
                Tambah
            </button>
            <a href="{{ route('evaluasi.dashboard') }}" class="bg-white border border-red-500 text-red-500 font-bold py-2 px-6 rounded shadow-sm hover:bg-red-50 transition uppercase text-sm inline-block text-center">
                Batal
            </a>
        </div>

        <!-- Modal -->
        <div x-show="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 px-4" style="display: none;" x-transition>
            <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-xl transform transition-all" @click.away="showModal = false">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-800" x-text="modalMode === 'create' ? 'Tambah Pengguna' : 'Edit Pengguna'"></h3>
                    <button @click="showModal = false" class="text-gray-400 hover:text-gray-600">&times;</button>
                </div>
                
                <form :action="formAction" method="POST">
                    @csrf
                    <template x-if="modalMode === 'edit'">
                        <input type="hidden" name="_method" value="PUT">
                    </template>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Nama</label>
                        <input type="text" name="name" x-model="formData.name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Email (Username)</label>
                        <input type="email" name="email" x-model="formData.email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Instansi</label>
                        <input type="text" name="organization" x-model="formData.organization" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                        <input type="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" :required="modalMode === 'create'">
                        <p x-show="modalMode === 'edit'" class="text-xs text-gray-500 mt-1">*Kosongkan jika tidak ingin mengubah password</p>
                    </div>
                    
                    <div class="mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1" x-model="formData.is_active" class="form-checkbox h-4 w-4 text-orange-600">
                            <span class="ml-2 text-gray-700 text-sm">Status Aktif</span>
                        </label>
                    </div>

                    <div class="flex justify-end gap-2">
                        <button type="button" @click="showModal = false" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded text-sm">
                            Batal
                        </button>
                        <button type="submit" class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded text-sm">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
