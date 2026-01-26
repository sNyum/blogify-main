@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-transparent py-4">
    <div class="max-w-7xl mx-auto">
        <!-- Header Content if needed inside main area -->
        <div class="mb-6 text-center">
            <h1 class="text-2xl font-bold text-gray-800 uppercase tracking-wide">
                DOKUMEN PEMBINAAN STATISTIK SEKTORAL
            </h1>
        </div>

        <!-- Documents Accordion -->
        <div class="max-w-5xl mx-auto space-y-4" x-data="{ activeTab: null }">
            
            @php
                $categories = [
                    'sk_tim' => 'SK Tim',
                    'materi' => 'Materi',
                    'dokumentasi' => 'Dokumentasi',
                    'daftar_hadir' => 'Daftar Hadir',
                    'notulen' => 'Notulen'
                ];
                
                // Icons mapping
                $icons = [
                    'sk_tim' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />',
                    'materi' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />',
                    'dokumentasi' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />',
                    'daftar_hadir' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />',
                    'notulen' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />'
                ];
            @endphp

            @foreach($categories as $key => $label)
            <div class="bg-orange-50 rounded-lg overflow-hidden shadow-sm transition-all duration-300">
                <button 
                    @click="activeTab = activeTab === '{{ $key }}' ? null : '{{ $key }}'"
                    class="w-full px-6 py-4 flex items-center justify-between bg-[#FFF3E0] hover:bg-orange-100 transition-colors"
                >
                    <div class="flex items-center gap-4">
                        <div class="text-[#E65100]">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                {!! $icons[$key] !!}
                            </svg>
                        </div>
                        <span class="font-bold text-[#E65100] text-lg">{{ $label }}</span>
                    </div>
                    <div class="text-[#E65100]">
                        <svg class="w-5 h-5 transition-transform duration-300" :class="{ 'rotate-45': activeTab === '{{ $key }}' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                </button>
                <div x-show="activeTab === '{{ $key }}'" x-collapse x-cloak class="px-6 py-4 bg-white border-t border-orange-100">
                    @if(isset($documents[$key]) && $documents[$key]->count() > 0)
                        <div class="space-y-3">
                            @foreach($documents[$key] as $doc)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg border border-gray-100 hover:bg-orange-50 hover:border-orange-200 transition-colors">
                                <div class="flex items-center gap-3">
                                    <div class="bg-red-100 p-2 rounded text-red-600">
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                                    </div>
                                    <div>
                                        <h5 class="font-medium text-gray-900">{{ $doc->title ?? $doc->file_name }}</h5>
                                        <p class="text-xs text-gray-500">{{ strtoupper($doc->file_type ?? 'FILE') }} • {{ $doc->file_size ?? '-' }} • {{ $doc->created_at->format('d M Y') }}</p>
                                    </div>
                                </div>
                                <a href="{{ Storage::url($doc->file_path) }}" target="_blank" class="text-[#F15A24] hover:text-[#D1491B] font-medium text-sm flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                                    Download
                                </a>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <span class="text-[#F15A24] text-sm font-medium">Klik untuk melihat {{ strtolower($label) }} (Belum ada dokumen)</span>
                        </div>
                    @endif
                </div>
            </div>
            @endforeach

        </div>

        </div>
    </div>
</div>
@endsection
