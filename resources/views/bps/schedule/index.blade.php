@extends('layouts.bps-staff-dashboard')

@php
    $header = 'Jadwal Pembinaan';
@endphp

@section('content')

    <!-- Banner Info -->
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-[#E65100] uppercase mb-2">JADWAL PEMBINAAN</h2>
        <p class="text-gray-600 max-w-4xl mx-auto">
            Instansi atau Organisasi Perangkat Daerah (OPD) dapat melihat jadwal pembinaan yang telah dijadwalkan berikut ini:
        </p>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Add Button -->
    <div class="flex justify-center mb-6">
        <a href="{{ route('bps.schedule.create') }}" class="inline-flex items-center px-6 py-3 bg-[#E65100] hover:bg-[#BF360C] text-white font-bold rounded-lg shadow-lg transition transform hover:-translate-y-1">
            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Jadwal
        </a>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-[#FFE0B2]">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-[#E65100] text-white">
                        <th class="px-4 py-4 text-center text-sm font-bold uppercase tracking-wider w-12">No</th>
                        <th class="px-4 py-4 text-left text-sm font-bold uppercase tracking-wider">Tanggal</th>
                        <th class="px-4 py-4 text-left text-sm font-bold uppercase tracking-wider">Jam</th>
                        <th class="px-4 py-4 text-left text-sm font-bold uppercase tracking-wider">Materi</th>
                        <th class="px-4 py-4 text-left text-sm font-bold uppercase tracking-wider">Tempat</th>
                        <th class="px-4 py-4 text-left text-sm font-bold uppercase tracking-wider">Peserta</th>
                        <th class="px-4 py-4 text-center text-sm font-bold uppercase tracking-wider">Status</th>
                        <th class="px-4 py-4 text-center text-sm font-bold uppercase tracking-wider w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-orange-100">
                    @forelse($schedules as $index => $schedule)
                        <tr class="hover:bg-orange-50 transition {{ $loop->even ? 'bg-[#FFF3E0]' : 'bg-white' }}">
                            <td class="px-4 py-3 text-center text-sm font-medium text-gray-600">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800 whitespace-nowrap">{{ $schedule->date->format('d-m-Y') }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800 whitespace-nowrap">{{ \Carbon\Carbon::parse($schedule->time)->format('H:i') }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800 font-medium">{{ $schedule->topic }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800">{{ $schedule->location }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800">{{ $schedule->participants }}</td>
                            <td class="px-4 py-3 text-center">
                                @php
                                    $statusClass = '';
                                    $statusLabel = '';
                                    switch($schedule->status) {
                                        case 'upcoming':
                                            $statusClass = 'bg-blue-100 text-blue-800';
                                            $statusLabel = 'Segera';
                                            break;
                                        case 'postponed':
                                            $statusClass = 'bg-red-100 text-red-800';
                                            $statusLabel = 'Ditunda';
                                            break;
                                        case 'completed':
                                            $statusClass = 'bg-green-100 text-green-800';
                                            $statusLabel = 'Sudah Selesai';
                                            break;
                                    }
                                @endphp
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full {{ $statusClass }}">
                                    {{ $statusLabel }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('bps.schedule.edit', $schedule->id) }}" class="text-[#E65100] hover:text-[#BF360C] flex items-center gap-1 text-sm font-semibold">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                        Edit
                                    </a>
                                    <span class="text-gray-300">|</span>
                                    <form action="{{ route('bps.schedule.destroy', $schedule->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 flex items-center gap-1 text-sm font-semibold">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-8 text-center text-gray-500 italic">
                                Belum ada jadwal pembinaan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
