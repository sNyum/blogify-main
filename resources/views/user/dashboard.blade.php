@extends('layouts.dashboard')

@section('content')
    <!-- Statistics Overview -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Status Evaluasi -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Status Evaluasi EPSS</p>
                <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $evaluasiStatus }}</h3>
                <a href="{{ route('evaluasi.dashboard') }}" class="text-xs text-primary font-semibold mt-2 inline-block hover:underline">Lihat Detail →</a>
            </div>
            <div class="w-12 h-12 bg-orange-50 rounded-lg flex items-center justify-center text-primary">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
        </div>

        <!-- Nilai IPS -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Nilai IPS Sementara</p>
                <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $evaluasiScore }}</h3>
                <span class="text-xs text-green-600 bg-green-50 px-2 py-1 rounded-full font-medium mt-2 inline-block">Predikat: -</span>
            </div>
            <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center text-secondary">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
            </div>
        </div>

        <!-- Jadwal Pembinaan -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Jadwal Pebinaan Terdekat</p>
                <h3 class="text-lg font-bold text-gray-800 mt-1">{{ $jadwalPembinaan }}</h3>
                <a href="{{ route('pembinaan.index') }}" class="text-xs text-primary font-semibold mt-2 inline-block hover:underline">Lihat Semua Jadwal →</a>
            </div>
            <div class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center text-green-600">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
            </div>
        </div>
    </div>

    <!-- Recent Actions / Chats -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Live Chat Widget Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-gray-800">Riwayat Konsultasi</h3>
                <a href="{{ route('chat') }}" class="text-sm font-medium text-primary hover:text-orange-600">Lihat Semua</a>
            </div>
            
             @if($recentConversations->count() > 0)
                <div class="space-y-4">
                    @foreach($recentConversations as $conversation)
                        <div class="flex items-start p-3 hover:bg-gray-50 rounded-lg transition-colors border border-transparent hover:border-gray-100">
                            <div class="flex-shrink-0 w-10 h-10 bg-primary/10 text-primary rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                            </div>
                            <div class="ml-4 flex-1">
                                <div class="flex items-center justify-between">
                                    <h4 class="text-sm font-semibold text-gray-900">{{ $conversation->subject }}</h4>
                                    <span class="text-xs text-gray-500">{{ $conversation->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-sm text-gray-500 mt-1 line-clamp-1">{{ $conversation->latestMessage?->content ?? '...' }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <p class="text-gray-500 text-sm">Belum ada riwayat konsultasi.</p>
                    <a href="{{ route('chat') }}" class="mt-4 inline-flex px-4 py-2 bg-primary text-white text-sm font-medium rounded-lg hover:bg-orange-600">Mulai Konsultasi</a>
                </div>
            @endif
        </div>

        <!-- Quick Access -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-6">Akses Cepat</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="{{ route('evaluasi.dashboard') }}" class="p-4 bg-orange-50 rounded-xl border border-orange-100 hover:shadow-md transition-all text-center group">
                    <div class="w-10 h-10 mx-auto bg-white rounded-full flex items-center justify-center text-primary shadow-sm mb-3 group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                    </div>
                    <span class="text-sm font-bold text-gray-700 group-hover:text-primary">Isi Evaluasi</span>
                </a>
                <a href="#" class="p-4 bg-blue-50 rounded-xl border border-blue-100 hover:shadow-md transition-all text-center group">
                    <div class="w-10 h-10 mx-auto bg-white rounded-full flex items-center justify-center text-secondary shadow-sm mb-3 group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                    </div>
                    <span class="text-sm font-bold text-gray-700 group-hover:text-secondary">Unduh Laporan</span>
                </a>
            </div>
        </div>
    </div>
@endsection
