@extends('layouts.bps-dashboard')

@php
    $header = 'Pembinaan: ' . $opd->organization;
@endphp

@section('content')

    <!-- Breadcrumb & Back -->
    <div class="mb-6">
        <a href="{{ route('bps-admin.pembinaan.index') }}" class="inline-flex items-center text-gray-500 hover:text-[#F15A24] font-medium mb-4">
            <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Daftar OPD
        </a>
        <h1 class="text-2xl font-bold text-gray-800">{{ $opd->organization }}</h1>
        <p class="text-gray-500">Kelola dokumen pembinaan untuk OPD ini.</p>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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
                
                <!-- BPS Special Features -->
                <div class="mb-4 bg-white p-4 rounded-lg border border-orange-100 shadow-sm">
                    @if($key === 'sk_tim')
                        <div class="mb-4 text-center">
                            <a href="#" onclick="alert('Template SK Tim belum tersedia.')" class="font-bold text-[#F15A24] hover:underline text-sm">
                                Klik untuk mendownload Template SK Tim
                            </a>
                        </div>
                    @endif

                    <h4 class="font-bold text-gray-700 mb-2 text-sm">Upload {{ $label }} Baru</h4>
                    <form action="{{ route('bps-admin.pembinaan.store', $opd->id) }}" method="POST" enctype="multipart/form-data" class="flex gap-2 items-start">
                        @csrf
                        <input type="hidden" name="category" value="{{ $key }}">
                        
                        <div class="flex-1">
                            <input type="text" name="title" placeholder="Nama Dokumen (Opsional)" class="w-full text-sm border-gray-300 rounded mb-2">
                            <input type="file" name="file" required class="block w-full text-sm text-gray-500
                              file:mr-4 file:py-2 file:px-4
                              file:rounded-full file:border-0
                              file:text-sm file:font-semibold
                              file:bg-orange-50 file:text-[#F15A24]
                              hover:file:bg-orange-100
                            "/>
                            <p class="text-xs text-gray-400 mt-1">Maks 10MB.</p>
                        </div>
                        <button type="submit" class="bg-[#F15A24] hover:bg-[#D1491B] text-white px-4 py-2 rounded text-sm font-bold shadow transition">
                            Upload
                        </button>
                    </form>
                </div>

                <!-- Existing Documents List -->
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
                            <div class="flex items-center gap-2">
                                 <a href="{{ Storage::url($doc->file_path) }}" target="_blank" class="text-[#F15A24] hover:text-[#D1491B] font-medium text-sm flex items-center gap-1">
                                    Download
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4 text-gray-400 bg-gray-50 rounded italic text-sm">
                        Belum ada dokumen yang diupload.
                    </div>
                @endif
            </div>
        </div>
        @endforeach

    </div>
@endsection
