@extends('layouts.bps-staff-dashboard')

@php
    $header = 'Edit Jadwal Pembinaan';
@endphp

@section('content')

    <!-- Breadcrumb & Title -->
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 uppercase tracking-wide">EDIT JADWAL PEMBINAAN</h2>
        </div>
        <a href="{{ route('bps.schedule.index') }}" class="text-gray-500 hover:text-[#E65100] font-medium flex items-center gap-1 transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-[#FFF8E1] rounded-xl shadow p-8 max-w-2xl mx-auto border border-[#FFE0B2]">
        
        <form action="{{ route('bps.schedule.update', $schedule->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Tanggal -->
            <div class="mb-4">
                <label for="date" class="block text-sm font-bold text-gray-700 mb-1">Tanggal:</label>
                <input type="date" name="date" id="date" required 
                       class="w-full rounded border-gray-300 shadow-sm focus:border-[#E65100] focus:ring-[#E65100] px-4 py-2"
                       value="{{ old('date', $schedule->date->format('Y-m-d')) }}">
                @error('date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Jam -->
            <div class="mb-4">
                <label for="time" class="block text-sm font-bold text-gray-700 mb-1">Jam:</label>
                <input type="time" name="time" id="time" required 
                       class="w-full rounded border-gray-300 shadow-sm focus:border-[#E65100] focus:ring-[#E65100] px-4 py-2"
                       value="{{ old('time', \Carbon\Carbon::parse($schedule->time)->format('H:i')) }}">
                @error('time') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Materi -->
            <div class="mb-4">
                <label for="topic" class="block text-sm font-bold text-gray-700 mb-1">Materi:</label>
                <textarea name="topic" id="topic" rows="2" required 
                          class="w-full rounded border-gray-300 shadow-sm focus:border-[#E65100] focus:ring-[#E65100] px-4 py-2">{{ old('topic', $schedule->topic) }}</textarea>
                @error('topic') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Tempat -->
            <div class="mb-4">
                <label for="location" class="block text-sm font-bold text-gray-700 mb-1">Tempat:</label>
                <input type="text" name="location" id="location" required 
                       class="w-full rounded border-gray-300 shadow-sm focus:border-[#E65100] focus:ring-[#E65100] px-4 py-2 bg-gray-50"
                       value="{{ old('location', $schedule->location) }}">
                @error('location') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Peserta -->
            <div class="mb-4">
                <label for="participants" class="block text-sm font-bold text-gray-700 mb-1">Peserta:</label>
                <textarea name="participants" id="participants" rows="2" required 
                          class="w-full rounded border-gray-300 shadow-sm focus:border-[#E65100] focus:ring-[#E65100] px-4 py-2 whitespace-pre-wrap">{{ old('participants', $schedule->participants) }}</textarea>
                @error('participants') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Status -->
            <div class="mb-6">
                <label for="status" class="block text-sm font-bold text-gray-700 mb-1">Status:</label>
                <select name="status" id="status" required
                        class="w-full rounded border-gray-300 shadow-sm focus:border-[#E65100] focus:ring-[#E65100] px-4 py-2">
                    <option value="upcoming" {{ old('status', $schedule->status) == 'upcoming' ? 'selected' : '' }}>Segera</option>
                    <option value="postponed" {{ old('status', $schedule->status) == 'postponed' ? 'selected' : '' }}>Ditunda</option>
                    <option value="completed" {{ old('status', $schedule->status) == 'completed' ? 'selected' : '' }}>Sudah Selesai</option>
                </select>
                @error('status') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="w-full bg-[#E65100] hover:bg-[#BF360C] text-white font-bold py-3 px-4 rounded-lg shadow transition transform hover:-translate-y-1">
                Kirim Perubahan
            </button>
        </form>
    </div>
@endsection
