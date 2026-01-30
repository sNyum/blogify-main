<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'BPS Kabupaten Batanghari' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background-soft text-gray-800 antialiased font-sans">
    <!-- Navbar -->
    <nav id="navbar" class="bg-white/90 backdrop-blur-xl fixed w-full z-50 border-b border-gray-200/50 shadow-lg shadow-primary/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="transform hover:scale-105 transition-transform duration-300">
                        <img class="h-12 w-auto" src="{{ asset('images/bistik-kaldu-logo.png') }}" alt="BISTIK KALDU - Kabupaten Batanghari">
                    </a>
                </div>
                <div class="hidden sm:flex sm:items-center sm:gap-8">
                    <a href="/modul-sektoral" class="nav-link relative text-sm font-medium text-gray-700 hover:text-primary transition-all duration-300 group">
                        Modul Sektoral
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-primary to-primary-hover group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="/berita" class="nav-link relative text-sm font-medium text-gray-700 hover:text-primary transition-all duration-300 group">
                        Berita
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-primary to-primary-hover group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="/pustaka" class="nav-link relative text-sm font-medium text-gray-700 hover:text-primary transition-all duration-300 group">
                        Pustaka
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-primary to-primary-hover group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="/#konsultasi" class="nav-link relative text-sm font-medium text-gray-700 hover:text-primary transition-all duration-300 group">
                        Konsultasi
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-primary to-primary-hover group-hover:w-full transition-all duration-300"></span>
                    </a>
                    
                    @auth('external')
                        <!-- Live Chat Menu -->
                        <a href="/chat" class="nav-link relative text-sm font-medium text-primary transition-all duration-300 group">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                Live Chat
                            </span>
                            <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-gradient-to-r from-primary to-primary-hover"></span>
                        </a>
                        
                        <!-- User Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 hover:text-primary transition-colors">
                                <div class="w-8 h-8 bg-gradient-to-br from-primary to-primary-hover rounded-full flex items-center justify-center text-white font-semibold">
                                    {{ substr(auth('external')->user()->name, 0, 1) }}
                                </div>
                                <span>{{ auth('external')->user()->name }}</span>
                                <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 z-50">
                                <a href="/dashboard" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-primary transition-colors">
                                    <span class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                        Dashboard
                                    </span>
                                </a>
                                <form action="/logout" method="POST" class="block">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                        <span class="flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            Logout
                                        </span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="/login" class="px-6 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-primary to-primary-hover rounded-full hover:shadow-xl hover:shadow-primary/40 hover:-translate-y-0.5 ml-2 transition-all duration-300">
                            Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-16">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer')
</body>
</html>
