@extends('layouts.dashboard')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Pembinaan Statistik</h1>
        <p class="text-gray-600">Akses jadwal pembinaan, materi, dan dokumentasi kegiatan bimbingan statistik sektoral.</p>
    </div>

    <!-- Stats Row -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center">
            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 mr-4">
               <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
            </div>
            <div>
                <p class="text-sm text-gray-500">Total Pembinaan</p>
                <p class="text-2xl font-bold text-gray-800">2</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center">
            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600 mr-4">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <div>
                <p class="text-sm text-gray-500">Tergabung Sejak</p>
                <p class="text-xl font-bold text-gray-800">Jan 2024</p>
            </div>
        </div>
         <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center">
            <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 mr-4">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" /></svg>
            </div>
            <div>
                <p class="text-sm text-gray-500">Unduh Materi</p>
                <p class="text-xl font-bold text-gray-800">{{ count($materials) }} File</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Upcoming Schedule -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Jadwal Pembinaan</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-sm text-gray-500 border-b border-gray-100">
                                <th class="py-3 px-4 font-medium">Topik / Kegiatan</th>
                                <th class="py-3 px-4 font-medium">Tanggal</th>
                                <th class="py-3 px-4 font-medium">Status</th>
                                <th class="py-3 px-4 font-medium">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            @forelse($schedules as $schedule)
                                <tr class="border-b border-gray-50 hover:bg-gray-50/50">
                                    <td class="py-4 px-4 font-medium text-gray-800">{{ $schedule['topic'] }}</td>
                                    <td class="py-4 px-4 text-gray-600">{{ \Carbon\Carbon::parse($schedule['date'])->format('d M Y') }}</td>
                                    <td class="py-4 px-4">
                                        @if($schedule['status'] == 'Upcoming')
                                            <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs font-semibold">Akan Datang</span>
                                        @else
                                            <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs font-semibold">Selesai</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-4">
                                        <button class="text-primary hover:text-orange-600 font-medium text-xs">Detail</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-8 text-gray-500">Belum ada jadwal pembinaan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Materials Download -->
        <div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Materi & Unduhan</h2>
                <ul class="space-y-3">
                    @foreach($materials as $material)
                        <li class="flex items-center justify-between p-3 bg-gray-50 rounded-lg group hover:bg-blue-50 transition-colors">
                            <div class="flex items-center overflow-hidden">
                                <div class="flex-shrink-0 w-8 h-8 bg-white border border-gray-200 rounded flex items-center justify-center text-xs font-bold text-gray-500 uppercase">
                                    {{ $material['type'] }}
                                </div>
                                <div class="ml-3 truncate">
                                    <p class="text-sm font-medium text-gray-800 truncate group-hover:text-blue-700">{{ $material['title'] }}</p>
                                    <p class="text-xs text-gray-500">{{ $material['size'] }}</p>
                                </div>
                            </div>
                            <button class="text-gray-400 hover:text-blue-600">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                            </button>
                        </li>
                    @endforeach
                </ul>
                <button class="w-full mt-6 py-2 text-sm text-primary font-medium hover:underline">Lihat Semua Materi</button>
            </div>
        </div>
    </div>
@endsection
