@extends('layouts.bps-dashboard')

@php
    $header = 'Approval Pendaftaran';
@endphp

@section('content')
    <!-- Filter Tabs -->
    <div class="mb-6 flex gap-2">
        <a href="{{ route('bps-admin.registrations') }}" 
           class="px-4 py-2 {{ !request('status') || request('status') == 'all' ? 'bg-primary text-white' : 'bg-white text-gray-700' }} rounded-lg font-semibold transition shadow-sm">
            Semua
        </a>
        <a href="{{ route('bps-admin.registrations', ['status' => 'pending']) }}" 
           class="px-4 py-2 {{ request('status') == 'pending' ? 'bg-primary text-white' : 'bg-white text-gray-700' }} rounded-lg font-semibold transition shadow-sm">
            Menunggu
        </a>
        <a href="{{ route('bps-admin.registrations', ['status' => 'approved']) }}" 
           class="px-4 py-2 {{ request('status') == 'approved' ? 'bg-primary text-white' : 'bg-white text-gray-700' }} rounded-lg font-semibold transition shadow-sm">
            Disetujui
        </a>
        <a href="{{ route('bps-admin.registrations', ['status' => 'rejected']) }}" 
           class="px-4 py-2 {{ request('status') == 'rejected' ? 'bg-primary text-white' : 'bg-white text-gray-700' }} rounded-lg font-semibold transition shadow-sm">
            Ditolak
        </a>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
            {{ session('error') }}
        </div>
    @endif

    <!-- Table -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 text-gray-700 border-b border-gray-200">
                        <th class="px-4 py-3 text-left text-sm font-bold uppercase tracking-wider">No</th>
                        <th class="px-4 py-3 text-left text-sm font-bold uppercase tracking-wider">Nama OPD</th>
                        <th class="px-4 py-3 text-left text-sm font-bold uppercase tracking-wider">PIC</th>
                        <th class="px-4 py-3 text-left text-sm font-bold uppercase tracking-wider">Email</th>
                        <th class="px-4 py-3 text-left text-sm font-bold uppercase tracking-wider">WA</th>
                        <th class="px-4 py-3 text-left text-sm font-bold uppercase tracking-wider">Status</th>
                        <th class="px-4 py-3 text-left text-sm font-bold uppercase tracking-wider">Tgl Pengajuan</th>
                        <th class="px-4 py-3 text-center text-sm font-bold uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($registrations as $index => $registration)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-sm text-gray-600">{{ $registrations->firstItem() + $index }}</td>
                            <td class="px-4 py-3 text-sm font-bold text-gray-800">{{ $registration->organization }}</td>
                            <td class="px-4 py-3 text-sm text-gray-600">{{ $registration->name }}</td>
                            <td class="px-4 py-3 text-sm text-gray-600">{{ $registration->email }}</td>
                            <td class="px-4 py-3 text-sm font-mono text-gray-600">{{ $registration->phone }}</td>
                            <td class="px-4 py-3 text-sm">
                                @if($registration->status === 'pending')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Menunggu
                                    </span>
                                @elseif($registration->status === 'approved')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Disetujui
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Ditolak
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-600">{{ $registration->created_at->format('d/m/Y') }}</td>
                            <td class="px-4 py-3">
                                <div class="flex gap-2 justify-center">
                                    <!-- Lihat Surat (Blue) -->
                                    @if($registration->surat_permohonan_path)
                                        <a href="{{ route('bps-admin.registrations.surat', $registration->id) }}" 
                                           target="_blank"
                                           class="p-1.5 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded transition" title="Lihat Surat">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                        </a>
                                    @endif

                                    @if($registration->status === 'pending')
                                        <!-- Setujui (Check) -->
                                        <form method="POST" action="{{ route('bps-admin.registrations.approve', $registration->id) }}" class="inline">
                                            @csrf
                                            <button type="submit" 
                                                    onclick="return confirm('Setujui pendaftaran ini?')"
                                                    class="p-1.5 text-green-600 hover:text-green-800 hover:bg-green-50 rounded transition" title="Setujui">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                            </button>
                                        </form>
                                    @endif

                                    @if($registration->status === 'approved')
                                        <!-- Kirim WA (WhatsApp Icon) -->
                                        <a href="{{ route('bps-admin.registrations.whatsapp', $registration->id) }}" 
                                           target="_blank"
                                           class="p-1.5 text-green-500 hover:text-green-700 hover:bg-green-50 rounded transition" title="Kirim WA">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                                        </a>
                                    @endif

                                    <!-- Hapus (Trash) -->
                                    <form method="POST" action="{{ route('bps-admin.registrations.destroy', $registration->id) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Yakin ingin menghapus pendaftaran ini?')"
                                                class="p-1.5 text-red-600 hover:text-red-800 hover:bg-red-50 rounded transition" title="Hapus">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-8 text-center text-gray-500 italic">
                                Tidak ada data pendaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($registrations->hasPages())
        <div class="mt-6">
            {{ $registrations->links() }}
        </div>
    @endif
@endsection
