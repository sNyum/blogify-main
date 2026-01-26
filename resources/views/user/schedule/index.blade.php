@extends('layouts.dashboard')

@section('content')

    <!-- Banner Info -->
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-[#E65100] uppercase mb-2">JADWAL PEMBINAAN</h2>
        <p class="text-gray-600 max-w-4xl mx-auto">
            Instansi atau Organisasi Perangkat Daerah (OPD) dapat melihat jadwal pembinaan yang telah dijadwalkan berikut ini:
        </p>
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
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-gray-500 italic">
                                Belum ada jadwal pembinaan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
