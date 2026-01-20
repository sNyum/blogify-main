<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bistik Kaldu - BPS Kabupaten Batanghari</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body class="bg-background-soft text-gray-800 antialiased font-sans">
    <!-- Navbar -->
    <nav id="navbar" x-data="{ mobileMenuOpen: false }" class="bg-white/90 backdrop-blur-xl fixed w-full z-50 border-b border-gray-200/50 shadow-lg shadow-primary/5 transition-all duration-500 ease-out">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div id="nav-content" class="flex justify-between h-20 transition-all duration-500">
                <div class="flex items-center">
                    <a href="/" class="flex items-center gap-3 transform hover:scale-105 transition-transform duration-300">
                        <img id="nav-logo" class="h-10 w-auto transition-all duration-500" src="{{ asset('images/bps-logo-full.png') }}" alt="BPS Logo">
                        <span class="font-bold text-xl text-primary tracking-wide hidden md:block">BISTIK KALDU</span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden sm:flex sm:items-center sm:gap-8">
                    <a href="#modul-sektoral" class="nav-link relative text-sm font-medium text-gray-700 hover:text-primary transition-all duration-300 group">
                        Modul Sektoral
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-primary to-primary-hover group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="#berita" class="nav-link relative text-sm font-medium text-gray-700 hover:text-primary transition-all duration-300 group">
                        Berita
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-primary to-primary-hover group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="#pustaka" class="nav-link relative text-sm font-medium text-gray-700 hover:text-primary transition-all duration-300 group">
                        Pustaka
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-primary to-primary-hover group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="#konsultasi" class="nav-link relative text-sm font-medium text-gray-700 hover:text-primary transition-all duration-300 group">
                        Konsultasi
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-primary to-primary-hover group-hover:w-full transition-all duration-300"></span>
                    </a>
                    
                    @auth('external')
                        <a href="/chat" class="nav-link relative text-sm font-medium text-primary transition-all duration-300 group">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                Live Chat
                            </span>
                        </a>
                        
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 hover:text-primary transition-colors">
                                <div class="w-8 h-8 bg-gradient-to-br from-primary to-primary-hover rounded-full flex items-center justify-center text-white font-semibold">
                                    {{ substr(auth('external')->user()->name, 0, 1) }}
                                </div>
                                <span class="hidden lg:inline">{{ auth('external')->user()->name }}</span>
                                <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 z-50">
                                <a href="/dashboard" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-primary transition-colors">
                                    Dashboard
                                </a>
                                <form action="/logout" method="POST" class="block">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <button onclick="openLoginModal()" class="px-6 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-primary to-primary-hover rounded-full hover:shadow-xl hover:shadow-orange-500/40 hover:-translate-y-0.5 ml-2 transition-all duration-300">
                            Login
                        </button>
                    @endauth
                </div>

                <!-- Mobile Hamburger Button -->
                <div class="flex items-center sm:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-600 hover:text-primary p-2 focus:outline-none">
                        <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Panel -->
        <div x-show="mobileMenuOpen" x-collapse x-cloak class="sm:hidden bg-white border-t border-gray-100 shadow-lg">
            <div class="px-4 pt-2 pb-6 space-y-1">
                <a href="#modul-sektoral" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary hover:bg-orange-50">Modul Sektoral</a>
                <a href="#berita" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary hover:bg-orange-50">Berita</a>
                <a href="#pustaka" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary hover:bg-orange-50">Pustaka</a>
                <a href="#konsultasi" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary hover:bg-orange-50">Konsultasi</a>
                
                @auth('external')
                     <a href="/chat" class="block px-3 py-2 rounded-md text-base font-medium text-primary hover:bg-orange-50 font-bold">Live Chat</a>
                     <div class="border-t border-gray-100 my-2 pt-2">
                        <div class="px-3 py-2 text-sm text-gray-500">Logged in as {{ auth('external')->user()->name }}</div>
                        <a href="/dashboard" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary hover:bg-orange-50">Dashboard</a>
                        <form action="/logout" method="POST" class="block">
                            @csrf
                            <button type="submit" class="w-full text-left block px-3 py-2 rounded-md text-base font-medium text-red-600 hover:bg-red-50">Logout</button>
                        </form>
                     </div>
                @else
                    <button onclick="openLoginModal()" class="w-full text-left block px-3 py-2 rounded-md text-base font-medium text-primary hover:bg-orange-50 font-bold">
                        Login
                    </button>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Login Modal (Preserved) -->
    <div id="loginModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8 transform transition-all">
            <button onclick="closeLoginModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
            <div class="text-center mb-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Pilih Jenis Login</h3>
                <p class="text-gray-600">Silakan pilih akses Anda</p>
            </div>
            <div class="space-y-4">
                <a href="/admin/login" class="group block w-full p-6 bg-gradient-to-r from-secondary to-blue-800 hover:from-blue-700 hover:to-blue-900 rounded-xl transition-all duration-300 shadow-lg text-white">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center"><svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg></div>
                        <div class="text-left"><h4 class="font-bold">Login Admin</h4><p class="text-xs text-blue-200">Panel Administrasi</p></div>
                    </div>
                </a>
                <a href="/login" class="group block w-full p-6 bg-white border-2 border-primary/20 hover:border-primary rounded-xl transition-all duration-300 shadow-sm hover:shadow-lg">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-orange-50 rounded-lg flex items-center justify-center"><svg class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg></div>
                        <div class="text-left"><h4 class="font-bold text-gray-900">Login User</h4><p class="text-xs text-gray-500">Akses Layanan Agency/OPD</p></div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Hero Section (Bistik Kaldu Theme) -->
    <div class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 bg-gradient-to-br from-white via-orange-50/30 to-white overflow-hidden">
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center z-10">
            <h1 class="text-4xl lg:text-6xl font-extrabold tracking-tight text-gray-900 mb-6">
                Bimbingan Statistik <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-orange-600">Sektoral Terpadu</span>
            </h1>
            <p class="text-lg lg:text-xl text-gray-600 mb-10 leading-relaxed max-w-3xl mx-auto">
                <span class="font-bold text-primary">BISTIK KALDU</span> hadir sebagai wujud komitmen BPS Kabupaten Batanghari dalam mewujudkan Satu Data Indonesia melalui pembinaan statistik sektoral yang berkualitas.
            </p>
            <div class="mt-10 flex justify-center gap-4">
                <a href="#modul-sektoral" class="px-8 py-3.5 bg-orange-500 text-white text-lg font-semibold rounded-lg shadow-xl shadow-orange-500/20 hover:bg-orange-600 hover:shadow-orange-500/30 transition-all transform hover:-translate-y-1">
                    Jelajahi Data
                </a>
            </div>
        </div>
    </div>

    <!-- About Section -->
    <div id="about" class="py-16 bg-white relative">
        <div class="max-w-5xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-12">Program Unggulan</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="p-6 bg-background-soft rounded-2xl border border-gray-100">
                    <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center mb-4 mx-auto text-primary"><svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg></div>
                    <h3 class="font-bold text-lg mb-2">Evaluasi Mandiri</h3>
                    <p class="text-sm text-gray-600">Penilaian mandiri penyelenggaraan statistik sektoral.</p>
                </div>
                <div class="p-6 bg-background-soft rounded-2xl border border-gray-100">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-4 mx-auto text-secondary"><svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg></div>
                    <h3 class="font-bold text-lg mb-2">Pembinaan</h3>
                    <p class="text-sm text-gray-600">Bimbingan teknis bagi produsen data.</p>
                </div>
                <div class="p-6 bg-background-soft rounded-2xl border border-gray-100">
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-4 mx-auto text-green-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" /></svg></div>
                    <h3 class="font-bold text-lg mb-2">Data Sektoral</h3>
                    <p class="text-sm text-gray-600">Repository data statistik sektoral daerah.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modul Sektoral (Dynamic) -->
    <div id="modul-sektoral" class="py-16 bg-background-soft">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between mb-12 gap-4">
                <div class="text-center md:text-left w-full md:w-auto mx-auto md:mx-0">
                    <h2 class="text-base font-bold text-orange-600 tracking-wide uppercase">Katalog Data</h2>
                    <p class="mt-1 text-3xl font-extrabold text-gray-900">Modul Sektoral</p>
                </div>
                <a href="/modul-sektoral" class="group flex items-center gap-2 text-sm font-semibold text-orange-600 hover:text-orange-700 transition-colors">
                    Lihat Semua
                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
            <div class="grid gap-6 md:grid-cols-3">
                @forelse($modulSektoral as $item)
                    <a href="/modul-sektoral/{{ $item->slug }}" class="group bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all hover:border-primary/30">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-lg bg-orange-50 text-primary flex items-center justify-center group-hover:bg-primary group-hover:text-white transition-colors">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                            </div>
                            <h3 class="font-semibold text-gray-900 group-hover:text-primary transition-colors">{{ $item->judul }}</h3>
                        </div>
                    </a>
                @empty
                    <div class="col-span-3 text-center py-8 text-gray-500">Belum ada modul.</div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Berita (Dynamic) -->
    <div id="berita" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between mb-12 gap-4">
                <div class="text-center md:text-left w-full md:w-auto mx-auto md:mx-0">
                    <h2 class="text-base font-bold text-primary tracking-wide uppercase">Informasi</h2>
                    <p class="mt-1 text-3xl font-extrabold text-gray-900">Berita Terbaru</p>
                </div>
                <a href="/berita" class="group flex items-center gap-2 text-sm font-semibold text-primary hover:text-orange-700 transition-colors">
                    Lihat Semua
                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
            <div class="grid gap-8 md:grid-cols-3">
                @forelse($berita as $news)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-all">
                        <div class="h-48 bg-gray-200 relative">
                            @if($news->foto)
                                <img src="{{ asset('storage/' . $news->foto) }}" class="w-full h-full object-cover">
                            @endif
                        </div>
                        <div class="p-6">
                            <time class="text-xs text-gray-500">{{ $news->created_at->format('d M Y') }}</time>
                            <h3 class="mt-2 text-lg font-bold text-gray-900 line-clamp-2 hover:text-primary">
                                <a href="#">{{ $news->judul }}</a>
                            </h3>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-8 text-gray-500">Belum ada berita.</div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Pustaka (Dynamic) -->
    <div id="pustaka" class="py-16 bg-background-soft">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between mb-12 gap-4">
                <div class="text-center md:text-left w-full md:w-auto mx-auto md:mx-0">
                    <h2 class="text-base font-bold text-orange-600 tracking-wide uppercase">Publikasi</h2>
                    <p class="mt-1 text-3xl font-extrabold text-gray-900">Pustaka Digital</p>
                </div>
                <a href="/pustaka" class="group flex items-center gap-2 text-sm font-semibold text-orange-600 hover:text-orange-700 transition-colors">
                    Lihat Semua
                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>

            <div class="grid gap-4 grid-cols-2 md:grid-cols-3 lg:grid-cols-6">
                @forelse($pustaka as $item)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-all group">
                         <div class="aspect-[3/4] bg-gray-100 relative overflow-hidden">
                            @if($item->cover_path)
                                <img src="{{ asset('storage/' . $item->cover_path) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                    <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                            @endif
                             <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                                <a href="{{ asset('storage/' . $item->pdf_path) }}" target="_blank" class="p-2 bg-white rounded-full text-gray-900 hover:text-primary transition-colors" title="Baca">
                                     <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                             </div>
                        </div>
                        <div class="p-3">
                            <h3 class="font-bold text-gray-900 mb-1 text-sm line-clamp-2" title="{{ $item->judul }}">{{ $item->judul }}</h3>
                            <p class="text-xs text-gray-500">{{ $item->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 md:col-span-3 lg:col-span-6 text-center py-8 text-gray-500">Belum ada pustaka.</div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Konsultasi Section -->
    <div id="konsultasi" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-base font-bold text-primary tracking-wide uppercase">Bantuan</h2>
                <p class="mt-1 text-3xl font-extrabold text-gray-900">Layanan Konsultasi</p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">Butuh bantuan terkait data statistik? Kami siap membantu anda.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Live Chat -->
                <div class="relative group bg-white p-6 flex flex-col h-full focus-within:ring-2 focus-within:ring-inset focus-within:ring-primary rounded-2xl shadow-sm border border-gray-100 hover:border-blue-500 hover:shadow-lg transition-all hover:-translate-y-1">
                    <div class="w-14 h-14 bg-blue-50 rounded-xl flex items-center justify-center mb-6 text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors">Live Chat</h3>
                        <p class="mt-2 text-sm text-gray-500">Konsultasi langsung dengan agen kami melalui fitur chat website.</p>
                    </div>
                    <div class="mt-auto pt-6">
                        @auth('external')
                            <a href="/chat" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-semibold text-sm">
                                Mulai Chat
                                <svg class="ml-2 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                        @else
                            <button onclick="openLoginModal()" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-semibold text-sm">
                                Login untuk Chat
                                <svg class="ml-2 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </button>
                        @endauth
                    </div>
                </div>

                <!-- Kunjungan Langsung -->
                <div class="relative group bg-white p-6 flex flex-col h-full rounded-2xl shadow-sm border border-gray-100 hover:border-orange-500 hover:shadow-lg transition-all hover:-translate-y-1">
                    <div class="w-14 h-14 bg-orange-50 rounded-xl flex items-center justify-center mb-6 text-orange-600 group-hover:bg-orange-600 group-hover:text-white transition-colors">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-lg font-bold text-gray-900 group-hover:text-orange-600 transition-colors">Pelayanan Statistik Terpadu</h3>
                        <p class="mt-2 text-sm text-gray-500">Jln. Jend. Sudirman Km.3 Muara Bulian, Batang Hari - Jambi, 36613</p>
                    </div>
                    <div class="mt-auto pt-6">
                        <a href="https://maps.app.goo.gl/example" target="_blank" class="inline-flex items-center text-orange-600 hover:text-orange-700 font-semibold text-sm">
                            Lihat di Maps
                            <svg class="ml-2 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Kontak -->
                <div class="relative group bg-white p-6 flex flex-col h-full rounded-2xl shadow-sm border border-gray-100 hover:border-green-500 hover:shadow-lg transition-all hover:-translate-y-1">
                    <div class="w-14 h-14 bg-green-50 rounded-xl flex items-center justify-center mb-6 text-green-600 group-hover:bg-green-600 group-hover:text-white transition-colors">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-lg font-bold text-gray-900 group-hover:text-green-600 transition-colors">Hubungi Kami</h3>
                        <p class="mt-2 text-sm text-gray-500">
                            Email: bps1504@bps.go.id<br>
                            Telp: (0743) 21008
                        </p>
                    </div>
                    <div class="mt-auto pt-6">
                        <a href="mailto:bps1504@bps.go.id" class="inline-flex items-center text-green-600 hover:text-green-700 font-semibold text-sm">
                            Kirim Email
                            <svg class="ml-2 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')
    
    <script>
        function openLoginModal() { document.getElementById('loginModal').classList.remove('hidden'); }
        function closeLoginModal() { document.getElementById('loginModal').classList.add('hidden'); }
    </script>
</body>
</html>
