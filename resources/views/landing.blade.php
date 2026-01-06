<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Badan Pusat Statistik Kabupaten Batanghari</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">
    <!-- Navbar with Enhanced Glassmorphism -->
    <nav id="navbar" class="bg-white/70 backdrop-blur-xl fixed w-full z-50 border-b border-gray-200/50 shadow-lg shadow-blue-500/5 transition-all duration-500 ease-out">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div id="nav-content" class="flex justify-between h-20 transition-all duration-500">
                <div class="flex items-center">
                    <a href="/" class="transform hover:scale-105 transition-transform duration-300">
                        <img id="nav-logo" class="h-12 w-auto transition-all duration-500" src="{{ asset('images/bps-logo-full.png') }}" alt="Badan Pusat Statistik Kabupaten Batanghari">
                    </a>
                </div>
                <div class="hidden sm:flex sm:items-center sm:gap-8">
                    <a href="/modul-sektoral" class="nav-link relative text-sm font-medium text-gray-700 hover:text-blue-600 transition-all duration-300 group">
                        Modul Sektoral
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-600 to-blue-400 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="/berita" class="nav-link relative text-sm font-medium text-gray-700 hover:text-blue-600 transition-all duration-300 group">
                        Berita
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-600 to-blue-400 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="/pustaka" class="nav-link relative text-sm font-medium text-gray-700 hover:text-blue-600 transition-all duration-300 group">
                        Pustaka
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-600 to-blue-400 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="/#konsultasi" class="nav-link relative text-sm font-medium text-gray-700 hover:text-blue-600 transition-all duration-300 group">
                        Konsultasi
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-600 to-blue-400 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="/admin/login" class="px-6 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-blue-700 rounded-full hover:from-blue-700 hover:to-blue-800 transition-all duration-300 shadow-lg shadow-blue-500/30 hover:shadow-xl hover:shadow-blue-500/40 hover:-translate-y-0.5 ml-2">
                        Login
                    </a>
                </div>
                <!-- Mobile menu button -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button type="button" id="mobile-menu-button" class="inline-flex items-center justify-center p-2 rounded-lg text-gray-600 hover:text-blue-600 hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500 transition-all duration-300">
                        <span class="sr-only">Open main menu</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile menu (hidden by default) -->
        <div id="mobile-menu" class="hidden sm:hidden bg-white/95 backdrop-blur-xl border-t border-gray-200">
            <div class="px-4 pt-2 pb-3 space-y-1">
                <a href="/modul-sektoral" class="block px-3 py-2 rounded-lg text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-all duration-300">Modul Sektoral</a>
                <a href="/berita" class="block px-3 py-2 rounded-lg text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-all duration-300">Berita</a>
                <a href="/pustaka" class="block px-3 py-2 rounded-lg text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-all duration-300">Pustaka</a>
                <a href="/#konsultasi" class="block px-3 py-2 rounded-lg text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-all duration-300">Konsultasi</a>
                <a href="/admin/login" class="block px-3 py-2 mt-2 rounded-lg text-base font-medium text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 transition-all duration-300 text-center">Login</a>
            </div>
        </div>
    </nav>
    
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            const navContent = document.getElementById('nav-content');
            const navLogo = document.getElementById('nav-logo');
            
            if (window.scrollY > 50) {
                navbar.classList.add('bg-white/90', 'shadow-xl');
                navbar.classList.remove('bg-white/70');
                navContent.classList.remove('h-20');
                navContent.classList.add('h-16');
                navLogo.classList.remove('h-12');
                navLogo.classList.add('h-10');
            } else {
                navbar.classList.remove('bg-white/90', 'shadow-xl');
                navbar.classList.add('bg-white/70');
                navContent.classList.remove('h-16');
                navContent.classList.add('h-20');
                navLogo.classList.remove('h-10');
                navLogo.classList.add('h-12');
            }
        });
        
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', () => {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });
    </script>

    <!-- Hero Section with Enhanced Animations -->
    <div class="relative pt-32 pb-20 sm:pt-40 sm:pb-24 overflow-hidden bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
        <!-- Animated Background Shapes -->
        <div class="absolute inset-0 z-0">
            <!-- Floating geometric shapes -->
            <div class="absolute top-20 left-10 w-72 h-72 bg-blue-400/10 rounded-full mix-blend-multiply filter blur-xl animate-blob"></div>
            <div class="absolute top-40 right-10 w-72 h-72 bg-purple-400/10 rounded-full mix-blend-multiply filter blur-xl animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-400/10 rounded-full mix-blend-multiply filter blur-xl animate-blob animation-delay-4000"></div>
            
            <!-- Animated wave SVG -->
            <svg class="absolute bottom-0 w-full h-64 opacity-20" viewBox="0 0 100 100" preserveAspectRatio="none">
                <defs>
                   <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="100%">
                     <stop offset="0%" style="stop-color:rgb(59,130,246);stop-opacity:0.3" />
                     <stop offset="100%" style="stop-color:rgb(147,51,234);stop-opacity:0.3" />
                   </linearGradient>
                </defs>
                <path d="M0 50 Q 25 20, 50 50 T 100 50 V 100 H 0 Z" fill="url(#grad1)" >
                    <animate attributeName="d" 
                             dur="10s" 
                             repeatCount="indefinite"
                             values="M0 50 Q 25 20, 50 50 T 100 50 V 100 H 0 Z;
                                     M0 50 Q 25 80, 50 50 T 100 50 V 100 H 0 Z;
                                     M0 50 Q 25 20, 50 50 T 100 50 V 100 H 0 Z" />
                </path>
            </svg>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center z-10">
            <!-- Main Heading with Gradient Text -->
            <h1 class="text-3xl tracking-tight font-extrabold sm:text-4xl md:text-5xl lg:text-6xl animate-fade-in-up">
                <span class="block bg-gradient-to-r from-blue-600 via-blue-700 to-purple-600 bg-clip-text text-transparent">
                    Selamat Datang di Portal CERDAS
                </span>
                <span class="block text-xl sm:text-2xl md:text-3xl mt-3 text-gray-700 font-semibold">BPS Kabupaten Batanghari</span>
            </h1>
            
            <p class="mt-6 max-w-xl mx-auto text-sm text-gray-600 sm:text-base md:text-lg lg:text-xl md:max-w-3xl animate-fade-in-up animation-delay-200">
                Cakap Memahami Ragam Data Statistik
            </p>
            
            <!-- Enhanced CTA Button with Pulsing Glow -->
            <div class="mt-20 flex justify-center pb-0 animate-fade-in-up animation-delay-400">
                <a href="#modul-sektoral" class="btn-cta group relative block w-full max-w-md mx-auto px-10 py-6 text-base font-bold text-center text-white transition-all duration-300 rounded-2xl overflow-hidden">
                    <!-- Gradient background -->
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-blue-700 transition-all duration-300 group-hover:from-blue-700 group-hover:to-blue-800"></div>
                    
                    <!-- Pulsing glow effect -->
                    <div class="absolute inset-0 bg-blue-400 opacity-0 group-hover:opacity-20 blur-xl transition-opacity duration-300 animate-pulse-slow"></div>
                    
                    <!-- Sweep effect -->
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                    
                    <!-- Button text -->
                    <span class="relative z-10 flex items-center justify-center gap-2">
                        Lihat Data
                        <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </span>
                </a>
            </div>
            
            <!-- Scroll Indicator -->
            <div class="mt-16 flex justify-center animate-bounce">
                <a href="#about" class="flex flex-col items-center text-gray-400 hover:text-blue-600 transition-colors duration-300">
                    <span class="text-xs font-medium mb-2">Scroll untuk lebih lanjut</span>
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
    
    <style>
        /* Animation keyframes */
        @keyframes blob {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
        }
        
        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes pulse-slow {
            0%, 100% { opacity: 0.2; }
            50% { opacity: 0.4; }
        }
        
        .animate-blob {
            animation: blob 7s infinite;
        }
        
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        
        .animation-delay-4000 {
            animation-delay: 4s;
        }
        
        .animate-fade-in-up {
            animation: fade-in-up 0.8s ease-out forwards;
        }
        
        .animation-delay-200 {
            animation-delay: 0.2s;
            opacity: 0;
        }
        
        .animation-delay-400 {
            animation-delay: 0.4s;
            opacity: 0;
        }
        
        .animate-pulse-slow {
            animation: pulse-slow 3s ease-in-out infinite;
        }
        
        .btn-cta {
            box-shadow: 0 20px 25px -5px rgba(59, 130, 246, 0.3), 0 10px 10px -5px rgba(59, 130, 246, 0.2);
        }
        
        .btn-cta:hover {
            box-shadow: 0 25px 50px -12px rgba(59, 130, 246, 0.5);
            transform: translateY(-2px);
        }
    </style>

    <!-- About Section with Enhanced Design -->
    <div id="about" class="relative pt-40 pb-24 px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-white to-gray-50 overflow-hidden">
        <!-- Decorative Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 1px 1px, rgb(59, 130, 246) 1px, transparent 0); background-size: 40px 40px;"></div>
        </div>
        
        <!-- Decorative Elements -->
        <div class="absolute top-20 right-10 w-64 h-64 bg-blue-200/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 left-10 w-64 h-64 bg-purple-200/20 rounded-full blur-3xl"></div>
        
        <div class="relative max-w-5xl mx-auto text-center">
            <!-- Icon/Badge -->
            <div class="flex justify-center mb-8 fade-in-on-scroll">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-lg shadow-blue-500/30 transform hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            
            <!-- Main Title -->
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-12 fade-in-on-scroll">
                Apa itu portal <span class="bg-gradient-to-r from-blue-600 to-blue-700 bg-clip-text text-transparent">CERDAS</span>?
            </h2>
            
            <!-- Description Card -->
            <div class="max-w-4xl mx-auto fade-in-on-scroll animation-delay-200">
                <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl shadow-gray-200/50 p-8 md:p-12 border border-gray-100 hover:shadow-2xl hover:shadow-gray-300/50 transition-all duration-500">
                    <p class="text-lg md:text-xl text-gray-700 leading-relaxed">
                        <span class="font-bold text-blue-600">Secara khusus</span> dibangun untuk mendukung kegiatan penguatan statistik sektoral di Kabupaten Batang Hari dan <span class="font-bold text-blue-600">secara umum</span> diperuntukan bagi siapapun yang ingin memperkaya literasi statistik khususnya statistik sektoral. Berisi materi pembinaan statistik sektoral, berita statistik sektoral, tulisan ilmiah dan belajar statistik.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modul Sektoral Section -->
    <div id="modul-sektoral" class="py-16 bg-white sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-base font-semibold text-blue-600 tracking-wide uppercase">Layanan Data</h2>
                <p class="mt-1 text-3xl font-extrabold text-gray-900 sm:text-4xl sm:tracking-tight">Modul Sektoral</p>
                <p class="max-w-xl mt-5 mx-auto text-xl text-gray-500">
                    Akses data statistik sektoral terkini.
                </p>
            </div>

            <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @forelse($modulSektoral as $item)
                    <a href="/modul-sektoral/{{ $item->slug }}" class="group relative bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-lg hover:border-blue-200 transition-all duration-300 flex items-center">
                        <div class="flex-shrink-0 h-12 w-12 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                             <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                        </div>
                        <div class="ml-4 flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 group-hover:text-blue-700 transition-colors">{{ $item->judul }}</h3>
                        </div>
                        <div class="ml-2">
                             <svg class="h-5 w-5 text-gray-400 group-hover:text-blue-500 group-hover:translate-x-1 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-12">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                             <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" /></svg>
                        </div>
                        <p class="text-gray-500 text-lg">Belum ada modul sektoral yang tersedia.</p>
                    </div>
                @endforelse
            </div>
            
            @if($modulSektoral->count() > 0)
            <div class="mt-10 text-center">
                 <a href="/modul-sektoral" class="font-medium text-blue-600 hover:text-blue-500 flex items-center justify-center gap-1 group">
                    Lihat semua modul
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                </a>
            </div>
            @endif
        </div>
    </div>

    <!-- Berita Section -->
    <div id="berita" class="py-16 bg-gray-50 sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                 <h2 class="text-base font-semibold text-blue-600 tracking-wide uppercase">Informasi Terkini</h2>
                <p class="mt-1 text-3xl font-extrabold text-gray-900 sm:text-4xl sm:tracking-tight">Berita Terbaru</p>
            </div>

            <div class="mt-12 grid gap-6 sm:gap-8 sm:grid-cols-2 lg:grid-cols-3">
                 @forelse($berita as $news)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow flex flex-col">
                         <div class="h-48 bg-gray-200 relative">
                             @if($news->youtube_url)
                                 <a href="{{ $news->youtube_url }}" target="_blank" class="block h-full w-full">
                             @endif
                                 @if($news->foto)
                                    <img class="h-full w-full object-cover" src="{{ asset('storage/' . $news->foto) }}" alt="{{ $news->judul }}">
                                @else
                                    <div class="flex items-center justify-center h-full text-gray-400">
                                         <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                    </div>
                                @endif
                             @if($news->youtube_url)
                                 </a>
                             @endif
                         </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="text-sm text-gray-500 mb-2">
                                <time datetime="{{ $news->created_at }}">{{ $news->created_at->format('d M Y') }}</time>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">
                                <a href="{{ $news->youtube_url ?? '#' }}" {{ $news->youtube_url ? 'target=_blank' : '' }} class="hover:text-blue-600 transition-colors">{{ $news->judul }}</a>
                            </h3>
                            <div class="text-gray-600 text-sm line-clamp-3 mb-4">
                                {!! Str::limit(strip_tags($news->konten), 100) !!}
                            </div>
                            
                            <div class="mt-auto">
                                @if($news->channel_name)
                                    <div class="flex items-center mb-4">
                                        @php
                                            $isYoutube = Str::contains($news->youtube_url, ['youtube.com', 'youtu.be']);
                                        @endphp
                                        <div class="flex items-center px-2.5 py-1 rounded-full {{ $isYoutube ? 'bg-red-50 text-red-600 hover:bg-red-100' : 'bg-blue-50 text-blue-600 hover:bg-blue-100' }} transition-colors">
                                            @if($isYoutube)
                                                <svg class="w-3.5 h-3.5 mr-1.5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                                            @else
                                                <svg class="w-3.5 h-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg>
                                            @endif
                                            <span class="text-xs font-semibold max-w-[150px] truncate">{{ $news->channel_name }}</span>
                                        </div>
                                    </div>
                                @endif

                                <a href="{{ $news->youtube_url ?? '#' }}" {{ $news->youtube_url ? 'target=_blank' : '' }} class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-500">
                                    @if(Str::contains($news->youtube_url, ['youtube.com', 'youtu.be']))
                                        Tonton Video
                                        <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    @else
                                        Baca Selengkapnya
                                        <svg class="ml-1 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                         <p class="text-gray-500">Belum ada berita terbaru.</p>
                    </div>
                @endforelse
            </div>
            
            @if($berita->count() > 0)
            <div class="mt-10 text-center">
                 <a href="/berita" class="font-medium text-blue-600 hover:text-blue-500 flex items-center justify-center gap-1 group">
                    Lihat semua berita
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                </a>
            </div>
            @endif
        </div>
    </div>

    <!-- Pustaka Section -->
    <div id="pustaka" class="py-16 bg-white sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                 <h2 class="text-base font-semibold text-blue-600 tracking-wide uppercase">Publikasi</h2>
                <p class="mt-1 text-3xl font-extrabold text-gray-900 sm:text-4xl sm:tracking-tight">Pustaka Digital</p>
                <p class="max-w-xl mt-5 mx-auto text-xl text-gray-500">
                    Unduh dan baca publikasi statistik terbaru.
                </p>
            </div>

            <div class="mt-12 grid gap-8 md:grid-cols-3 lg:grid-cols-4">
                 @forelse($pustaka as $book)
                    <div class="group relative bg-white border border-gray-200 rounded-2xl overflow-hidden hover:shadow-lg transition-all duration-300">
                         <div class="aspect-w-3 aspect-h-4 bg-gray-200 group-hover:opacity-90 transition-opacity relative overflow-hidden h-48">
                             @if($book->cover_path)
                                <img src="{{ asset('storage/' . $book->cover_path) }}" alt="{{ $book->judul }}" class="object-cover w-full h-full transform group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="flex items-center justify-center h-full text-gray-400 bg-gray-100">
                                     <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-center pb-6">
                                <a href="{{ asset('storage/' . $book->pdf_path) }}" target="_blank" class="inline-flex items-center text-sm font-bold text-white hover:text-blue-200 transition-colors duration-300">
                                    <svg class="mr-2 -ml-1 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    Lihat PDF
                                </a>
                            </div>
                         </div>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-2">
                                <a href="{{ asset('storage/' . $book->pdf_path) }}" target="_blank">
                                    <span class="absolute inset-0"></span>
                                    {{ $book->judul }}
                                </a>
                            </h3>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                         <p class="text-gray-500">Belum ada pustaka digital terbaru.</p>
                    </div>
                @endforelse
            </div>
            
            @if($pustaka->count() > 0)
            <div class="mt-10 text-center">
                 <a href="/pustaka" class="font-medium text-blue-600 hover:text-blue-500 flex items-center justify-center gap-1 group">
                    Lihat semua pustaka
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                </a>
            </div>
            @endif
        </div>
    </div>

    <!-- Konsultasi Section -->
    <div id="konsultasi" class="py-16 bg-gray-50 sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <!-- Left: Info Text -->
                <div>
                     <h2 class="text-base font-semibold text-blue-600 tracking-wide uppercase mb-2">Layanan Kami</h2>
                    <h3 class="text-3xl font-extrabold text-gray-900 sm:text-4xl mb-6">Konsultasi Statistik</h3>
                    <p class="text-lg text-gray-600 leading-relaxed text-justify">
                        Jika <span class="font-bold text-blue-600">#SahabatData</span> memiliki pertanyaan seputar data BPS Kabupaten Batang Hari, silakan disampaikan melalui chat Whatsapp ini, operator kami siap membantu. Layanan kami buka setiap hari kerja, Senin s/d Jumat pukul 08.00-15.30 WIB.
                    </p>
                </div>

                <!-- Right: Form -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <form id="waForm" class="space-y-6">
                        <div>
                            <label for="nama" class="sr-only">Nama</label>
                            <input type="text" id="nama" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 px-4 py-3" placeholder="Masukan Nama">
                        </div>
                        <div>
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" id="email" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 px-4 py-3" placeholder="Masukan Email">
                        </div>
                        <div>
                            <label for="pesan" class="sr-only">Pesan</label>
                            <textarea id="pesan" rows="4" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 px-4 py-3" placeholder="Tuliskan Pesan"></textarea>
                        </div>
                        <div>
                            <button type="submit" style="background-color: #16a34a; color: white;" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                Kirim Pesan dengan WhatsApp
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.getElementById('waForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const nama = document.getElementById('nama').value;
            const email = document.getElementById('email').value;
            const pesan = document.getElementById('pesan').value;
            
            if (!nama || !email || !pesan) {
                alert('Mohon lengkapi semua field');
                return;
            }
            
            const text = `Halo BPS Batanghari,%0A%0ANama: ${nama}%0AEmail: ${email}%0A%0APesan:%0A${pesan}`;
            // Replace with actual BPS Batanghari WhatsApp number
            const phoneNumber = '6281373850795'; 
            
            window.open(`https://wa.me/${phoneNumber}?text=${text}`, '_blank');
        });
    </script>
    
    <!-- Enhanced Footer -->
    <!-- Enhanced Footer -->
    @include('partials.footer')
    
    <!-- Back to Top Button -->
    <button id="back-to-top" class="fixed bottom-8 right-8 bg-gradient-to-r from-blue-600 to-blue-700 text-white p-4 rounded-full shadow-2xl shadow-blue-500/40 opacity-0 invisible transition-all duration-300 hover:from-blue-700 hover:to-blue-800 hover:shadow-blue-500/60 hover:-translate-y-1 z-40">
        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
        </svg>
    </button>
    
    <script>
        // Scroll-triggered animations using Intersection Observer
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in-up');
                    entry.target.style.opacity = '1';
                }
            });
        }, observerOptions);
        
        // Observe all elements with fade-in-on-scroll class
        document.addEventListener('DOMContentLoaded', () => {
            const elements = document.querySelectorAll('.fade-in-on-scroll');
            elements.forEach(el => {
                el.style.opacity = '0';
                observer.observe(el);
            });
            
            // Back to Top button functionality
            const backToTopButton = document.getElementById('back-to-top');
            
            window.addEventListener('scroll', () => {
                if (window.scrollY > 300) {
                    backToTopButton.classList.remove('opacity-0', 'invisible');
                    backToTopButton.classList.add('opacity-100', 'visible');
                } else {
                    backToTopButton.classList.add('opacity-0', 'invisible');
                    backToTopButton.classList.remove('opacity-100', 'visible');
                }
            });
            
            backToTopButton.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>
