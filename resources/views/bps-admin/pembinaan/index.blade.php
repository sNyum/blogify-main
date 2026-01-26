@extends('layouts.bps-dashboard')

@php
    $header = 'Kelola Pembinaan';
@endphp

@section('content')

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4">
        <h2 class="text-xl font-bold text-gray-800">Daftar OPD Binaan</h2>
        <p class="text-sm text-gray-500">Pilih OPD untuk mengelola dokumen pembinaan.</p>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 text-gray-700 border-b border-gray-200">
                        <th class="px-4 py-3 text-left text-sm font-bold uppercase tracking-wider">No</th>
                        <th class="px-4 py-3 text-left text-sm font-bold uppercase tracking-wider">Nama OPD</th>
                        <th class="px-4 py-3 text-left text-sm font-bold uppercase tracking-wider">PIC</th>
                        <th class="px-4 py-3 text-center text-sm font-bold uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($opds as $index => $opd)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-sm text-gray-600">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 text-sm font-bold text-gray-800">{{ $opd->organization }}</td>
                            <td class="px-4 py-3 text-sm text-gray-600">{{ $opd->name }}</td>
                            <td class="px-4 py-3 text-center">
                                <a href="{{ route('bps-admin.pembinaan.show', $opd->id) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-[#F15A24] text-white text-xs font-bold rounded hover:bg-[#D1491B] transition shadow-sm">
                                    <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                    </svg>
                                    Kelola Dokumen
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-8 text-center text-gray-500 italic">
                                Belum ada OPD yang disetujui.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
