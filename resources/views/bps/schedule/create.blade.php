@extends('layouts.bps-staff-dashboard')

@php
    $header = 'Tambah Jadwal Pembinaan';
@endphp

@section('content')

    <!-- Breadcrumb & Title -->
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 uppercase tracking-wide">TAMBAH JADWAL PEMBINAAN</h2>
        </div>
        <a href="{{ route('bps.schedule.index') }}" class="text-gray-500 hover:text-[#E65100] font-medium flex items-center gap-1 transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-[#FFF8E1] rounded-xl shadow p-8 max-w-2xl mx-auto border border-[#FFE0B2]">
        
        <form action="{{ route('bps.schedule.store') }}" method="POST">
            @csrf

            <!-- Tanggal -->
            <div class="mb-4">
                <label for="date" class="block text-sm font-bold text-gray-700 mb-1">Tanggal:</label>
                <div class="relative">
                    <input type="date" name="date" id="date" required 
                           class="w-full rounded border-gray-300 shadow-sm focus:border-[#E65100] focus:ring-[#E65100] px-4 py-2"
                           value="{{ old('date') }}">
                    <span class="absolute right-3 top-2 text-gray-400 pointer-events-none">
                       <!-- Calendar Icon done by input type date usually, simplified -->
                    </span>
                </div>
                @error('date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Jam -->
            <div class="mb-4">
                <label for="time" class="block text-sm font-bold text-gray-700 mb-1">Jam:</label>
                <div class="relative">
                    <input type="time" name="time" id="time" required 
                           class="w-full rounded border-gray-300 shadow-sm focus:border-[#E65100] focus:ring-[#E65100] px-4 py-2"
                           value="{{ old('time') }}">
                     <span class="absolute right-3 top-2 text-gray-400 pointer-events-none">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </span>
                </div>
                @error('time') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Materi -->
            <div class="mb-4">
                <label for="topic" class="block text-sm font-bold text-gray-700 mb-1">Materi:</label>
                <textarea name="topic" id="topic" rows="2" required placeholder="Contoh: Prinsip Satu Data Indonesia"
                          class="w-full rounded border-gray-300 shadow-sm focus:border-[#E65100] focus:ring-[#E65100] px-4 py-2">{{ old('topic') }}</textarea>
                @error('topic') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Tempat -->
            <div class="mb-4">
                <label for="location" class="block text-sm font-bold text-gray-700 mb-1">Tempat:</label>
                <input type="text" name="location" id="location" required placeholder="Contoh: Aula BPS Kabupaten Batang Hari"
                       class="w-full rounded border-gray-300 shadow-sm focus:border-[#E65100] focus:ring-[#E65100] px-4 py-2 bg-gray-50"
                       value="{{ old('location') }}">
                @error('location') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Peserta -->
            <div class="mb-4">
                <label for="participants" class="block text-sm font-bold text-gray-700 mb-1">Peserta:</label>
                <textarea name="participants" id="participants" rows="2" required placeholder="Contoh: 1. Dinas Pertanian 2. Dinas Pendidikan"
                          class="w-full rounded border-gray-300 shadow-sm focus:border-[#E65100] focus:ring-[#E65100] px-4 py-2 whitespace-pre-wrap">{{ old('participants') }}</textarea>
                @error('participants') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Status -->
            <div class="mb-6">
                <label for="status" class="block text-sm font-bold text-gray-700 mb-1">Status:</label>
                <select name="status" id="status" required
                        class="w-full rounded border-gray-300 shadow-sm focus:border-[#E65100] focus:ring-[#E65100] px-4 py-2">
                    <option value="upcoming" {{ old('status') == 'upcoming' ? 'selected' : '' }}>Segera</option>
                    <option value="postponed" {{ old('status') == 'postponed' ? 'selected' : '' }}>Ditunda</option>
                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Sudah Selesai</option>
                </select>
                @error('status') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="w-full bg-[#E65100] hover:bg-[#BF360C] text-white font-bold py-3 px-4 rounded-lg shadow transition transform hover:-translate-y-1">
                Simpan
            </button>
        </form>
    </div>
@endsection
