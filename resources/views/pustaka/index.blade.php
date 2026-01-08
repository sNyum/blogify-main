<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pustaka Digital - BPS Kabupaten Batanghari</title>
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
                Publikasi BPS
            </span>
            <h1 class="text-3xl md:text-5xl font-extrabold text-slate-900 tracking-tight mb-4">
                Pustaka Digital
            </h1>
            <p class="text-lg text-slate-600 max-w-2xl mx-auto">
                Koleksi publikasi, buku, dan laporan statistik yang dapat diunduh.
            </p>
        </div>
    </div>

    <!-- Main Content -->
    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 w-full">
        @if($pustaka->count() > 0)
            <div class="grid gap-4 sm:gap-6 grid-cols-2 sm:grid-cols-3 lg:grid-cols-4">
                @foreach($pustaka as $book)
                    <div class="group relative bg-white border border-gray-200 rounded-2xl overflow-hidden hover:shadow-lg transition-all duration-300 flex flex-col">
                         <div class="aspect-w-3 aspect-h-4 bg-gray-100 group-hover:opacity-90 transition-opacity relative overflow-hidden h-64">
                             @if($book->cover_path)
                                <img src="{{ asset('storage/' . $book->cover_path) }}" alt="{{ $book->judul }}" class="object-cover w-full h-full transform group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="flex items-center justify-center h-full text-gray-400 bg-gray-50">
                                     <svg class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-center pb-6">
                                <a href="{{ asset('storage/' . $book->pdf_path) }}" target="_blank" class="inline-flex items-center text-sm font-bold text-white hover:text-orange-200 transition-colors duration-300">
                                    <svg class="mr-2 -ml-1 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    Lihat PDF
                                </a>
                            </div>
                         </div>
                        <div class="p-4 flex-grow flex flex-col">
                            <h3 class="text-sm font-bold text-gray-900 group-hover:text-orange-600 transition-colors line-clamp-2 leading-tight mb-2">
                                <a href="{{ asset('storage/' . $book->pdf_path) }}" target="_blank">
                                    <span class="absolute inset-0"></span>
                                    {{ $book->judul }}
                                </a>
                            </h3>
                            <div class="mt-auto pt-2 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                                <span>{{ $book->created_at->format('M Y') }}</span>
                                <span class="bg-orange-50 text-orange-600 px-2 py-0.5 rounded-full font-medium">Buku</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                {{ $pustaka->links('vendor.pagination.stacked') }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-20">
                <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <h3 class="text-xl font-medium text-slate-900 mb-2">Belum ada pustaka tersedia</h3>
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
