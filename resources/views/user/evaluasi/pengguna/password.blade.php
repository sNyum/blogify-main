@extends('layouts.evaluasi')

@section('content')
    <div class="p-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-[#1A237E]">Ubah Password</h2>
            <div class="text-sm text-gray-400">
                <a href="{{ route('evaluasi.dashboard') }}" class="hover:text-[#E65100]">Dashboard</a> / <span class="text-gray-600">Ubah</span>
            </div>
        </div>

        <div class="bg-blue-400 text-white p-3 rounded-md mb-6 font-medium text-sm">
            Silakan ubah password Anda Apabila Belum Pernah Diubah Sejak Akun Diterima
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <strong class="font-bold">Berhasil!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif


        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 max-w-4xl mx-auto">
            
            <form action="{{ route('evaluasi.pengguna.update-password') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 gap-6 mb-8">
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Nama Lengkap</label>
                        <input type="text" value="{{ $user->name }}" readonly class="w-full border-gray-200 bg-gray-100 rounded-lg shadow-sm text-gray-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Username</label>
                        <input type="text" value="{{ explode('@', $user->email)[0] }}" readonly class="w-full border-gray-200 bg-gray-100 rounded-lg shadow-sm text-gray-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Password</label>
                        <input type="password" name="password" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#E65100] focus:ring-[#E65100]">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Email</label>
                        <input type="text" value="{{ $user->email }}" readonly class="w-full border-gray-200 bg-gray-100 rounded-lg shadow-sm text-gray-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Instansi/Dinas/Lembaga</label>
                        <input type="text" value="{{ $user->organization ?? '-' }}" readonly class="w-full border-gray-200 bg-gray-100 rounded-lg shadow-sm text-gray-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Hak Akses</label>
                        <input type="text" value="User OPD" readonly class="w-full border-gray-200 bg-gray-100 rounded-lg shadow-sm text-gray-500">
                    </div>

                     <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Status Penyelenggara</label>
                        <input type="text" value="Produsen Data" readonly class="w-full border-gray-200 bg-gray-100 rounded-lg shadow-sm text-gray-500">
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="bg-white border border-green-500 text-green-500 font-bold py-2 px-6 rounded shadow-sm hover:bg-green-50 transition uppercase text-sm">
                        Simpan
                    </button>
                    <a href="{{ route('evaluasi.dashboard') }}" class="bg-white border border-red-500 text-red-500 font-bold py-2 px-6 rounded shadow-sm hover:bg-red-50 transition uppercase text-sm text-center">
                        Batal
                    </a>
                </div>

            </form>

        </div>
    </div>
@endsection
