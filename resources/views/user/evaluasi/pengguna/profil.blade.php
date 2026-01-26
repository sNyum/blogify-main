@extends('layouts.evaluasi')

@section('content')
    <div class="p-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-[#1A237E]">Profil Saya</h2>
            <div class="text-sm text-gray-400">
                <a href="{{ route('evaluasi.dashboard') }}" class="hover:text-[#E65100]">Dashboard</a> / <span class="text-gray-600">Profil</span>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 max-w-4xl mx-auto">
            
            <form action="{{ route('evaluasi.pengguna.update-profil') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Avatar -->
                <div class="flex flex-col items-center mb-8">
                    <div class="w-32 h-32 bg-orange-100 rounded-full flex items-center justify-center text-orange-300 mb-4 overflow-hidden border-4 border-orange-50">
                        @if($user->avatar_url)
                            <img src="{{ $user->avatar_url }}" class="w-full h-full object-cover">
                        @else
                            <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                        @endif
                    </div>
                </div>

                <!-- Fields -->
                <div class="grid grid-cols-1 gap-6">
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Choose File</label>
                        <input type="file" name="avatar" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 border border-gray-300 rounded-lg p-1">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#E65100] focus:ring-[#E65100] bg-white">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Instansi</label>
                        <input type="text" value="{{ $user->organization ?? '-' }}" readonly class="w-full border-gray-300 rounded-lg shadow-sm bg-gray-100 text-gray-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="text" value="{{ $user->email }}" readonly class="w-full border-gray-300 rounded-lg shadow-sm bg-gray-100 text-gray-500">
                    </div>

                </div>

                <div class="mt-8 flex gap-3">
                    <button type="submit" class="bg-[#3F51B5] text-white font-bold py-2 px-6 rounded shadow-sm hover:bg-[#303F9F] transition">
                        Simpan
                    </button>
                    <a href="{{ route('evaluasi.dashboard') }}" class="bg-gray-500 text-white font-bold py-2 px-6 rounded shadow-sm hover:bg-gray-600 transition">
                        Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>
@endsection
