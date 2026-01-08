<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Terkini - BPS Kabupaten Batanghari</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="font-inter bg-slate-50 text-slate-900 antialiased selection:bg-blue-500 selection:text-white flex flex-col min-h-screen">

    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Header Section -->
    <div class="pt-32 pb-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-block px-3 py-1 mb-4 text-xs font-semibold tracking-wider text-orange-600 uppercase bg-orange-50 rounded-full">
                Informasi Terkini
            </span>
            <h1 class="text-3xl md:text-5xl font-extrabold text-slate-900 tracking-tight mb-4">
                Berita & Kegiatan
            </h1>
            <p class="text-lg text-slate-600 max-w-2xl mx-auto">
                Dapatkan informasi terbaru seputar kegiatan dan rilis data statistik.
            </p>
        </div>
    </div>

    <!-- Main Content -->
    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 w-full">
        @if($berita->count() > 0)
            <div class="grid gap-6 sm:gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($berita as $news)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow flex flex-col h-full">
                        <div class="h-56 bg-gray-200 relative flex-shrink-0">
                            @if($news->youtube_url)
                                <a href="{{ $news->youtube_url }}" target="_blank" class="block h-full w-full">
                            @endif
                                @if($news->foto)
                                <img class="h-full w-full object-cover" src="{{ asset('storage/' . $news->foto) }}" alt="{{ $news->judul }}">
                            @else
                                <div class="flex items-center justify-center h-full text-gray-400 bg-gray-100">
                                        <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                </div>
                            @endif
                            @if($news->youtube_url)
                                </a>
                            @endif
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="text-sm text-gray-500 mb-3 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                <time datetime="{{ $news->created_at }}">{{ $news->created_at->format('d M Y') }}</time>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 leading-snug">
                                <a href="{{ $news->youtube_url ?? '#' }}" {{ $news->youtube_url ? 'target=_blank' : '' }} class="hover:text-orange-600 transition-colors">{{ $news->judul }}</a>
                            </h3>
                            <div class="text-gray-600 text-sm line-clamp-3 mb-6 flex-grow">
                                {!! Str::limit(strip_tags($news->konten), 120) !!}
                            </div>
                            
                            <div class="pt-4 border-t border-gray-50 mt-auto">
                                @if($news->channel_name)
                                    <div class="flex items-center mb-4">
                                        @php
                                            $isYoutube = Str::contains($news->youtube_url, ['youtube.com', 'youtu.be']);
                                        @endphp
                                        <div class="flex items-center px-3 py-1 rounded-full {{ $isYoutube ? 'bg-red-50 text-red-600 hover:bg-red-100' : 'bg-orange-50 text-orange-600 hover:bg-orange-100' }} transition-colors w-max max-w-full">
                                            @if($isYoutube)
                                                <svg class="w-3.5 h-3.5 mr-1.5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                                            @else
                                                <svg class="w-3.5 h-3.5 mr-1.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg>
                                            @endif
                                            <span class="text-xs font-semibold truncate">{{ $news->channel_name }}</span>
                                        </div>
                                    </div>
                                @endif

                                <a href="{{ $news->youtube_url ?? '#' }}" {{ $news->youtube_url ? 'target=_blank' : '' }} class="inline-flex items-center w-full justify-center px-4 py-2.5 text-sm font-medium text-orange-600 bg-orange-50 hover:bg-orange-600 hover:text-white rounded-xl transition-all duration-300">
                                    @if(Str::contains($news->youtube_url, ['youtube.com', 'youtu.be']))
                                        Tonton Video
                                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    @else
                                        Baca Selengkapnya
                                        <svg class="ml-2 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                {{ $berita->links('vendor.pagination.stacked') }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-20">
                <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                </div>
                <h3 class="text-xl font-medium text-slate-900 mb-2">Belum ada berita</h3>
                <p class="text-slate-500">Silakan kembali lagi nanti.</p>
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
