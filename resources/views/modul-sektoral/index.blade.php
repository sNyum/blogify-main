<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modul Sektoral - BPS Kabupaten Batanghari</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="font-inter bg-slate-50 text-slate-900 antialiased selection:bg-blue-500 selection:text-white flex flex-col min-h-screen">

    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Header Section -->
    <div class="pt-32 pb-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-block px-3 py-1 mb-4 text-xs font-semibold tracking-wider text-orange-600 uppercase bg-orange-50 rounded-full">
                Koleksi Data BPS
            </span>
            <h1 class="text-3xl md:text-5xl font-extrabold text-slate-900 tracking-tight mb-4">
                Modul Sektoral
            </h1>
            <p class="text-lg text-slate-600 max-w-2xl mx-auto">
                Kumpulan materi presentasi dan data statistik sektoral Kabupaten Batanghari.
            </p>
        </div>
    </div>

    <!-- Main Content -->
    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 w-full">
        @if($moduls->count() > 0)
            <div class="grid gap-6 sm:gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($moduls as $modul)
                    <div class="group bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-500 overflow-hidden flex flex-col h-full">
                        
                        <!-- Card Header / Icon -->
                        <div class="p-6 pb-0 flex items-start justify-between">
                            <div class="w-12 h-12 rounded-xl bg-orange-50 flex items-center justify-center text-orange-600 group-hover:bg-orange-600 group-hover:text-white transition-colors duration-500 shadow-inner">
                                <svg class="w-6 h-6 transform group-hover:scale-110 transition-transform duration-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-slate-400 group-hover:text-blue-500 transition-colors">
                                {{ $modul->created_at->diffForHumans() }}
                            </span>
                        </div>

                        <!-- Card Body -->
                        <div class="p-6 flex-grow flex flex-col">
                            <h3 class="text-lg font-bold text-slate-900 mb-3 group-hover:text-orange-600 transition-colors line-clamp-2">
                                <a href="/modul-sektoral/{{ $modul->slug }}" class="hover:underline decoration-2 underline-offset-2">
                                    {{ $modul->judul }}
                                </a>
                            </h3>
                            
                            @if($modul->deskripsi)
                                <p class="text-sm text-slate-500 leading-relaxed mb-6 line-clamp-3">
                                    {{ $modul->deskripsi }}
                                </p>
                            @else
                                <p class="text-sm text-slate-400 italic mb-6">Tidak ada deskripsi singkat.</p>
                            @endif
                        </div>

                        <!-- Card Footer -->
                        <div class="p-6 pt-0 mt-auto">
                            <a href="/modul-sektoral/{{ $modul->slug }}" class="inline-flex items-center justify-center w-full px-4 py-2.5 text-sm font-semibold text-orange-600 bg-orange-50 hover:bg-orange-600 hover:text-white rounded-xl transition-all duration-300 group-hover:shadow-md">
                                Lihat Detail
                                <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                {{ $moduls->links('vendor.pagination.stacked') }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-20">
                <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-medium text-slate-900 mb-2">Belum ada modul tersedia</h3>
                <p class="text-slate-500">Silakan kembali lagi nanti untuk update terbaru.</p>
                <div class="mt-8">
                    <a href="/" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-full shadow-sm text-white bg-orange-600 hover:bg-orange-700 transition-colors">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        @endif
    </main>

    <!-- Footer -->
    @include('partials.footer')


</body>
</html>
