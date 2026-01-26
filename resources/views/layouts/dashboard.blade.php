<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Dashboard Bistik Kaldu' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-background-soft font-sans antialiased text-gray-800" x-data="{ sidebarOpen: false }">
    
    <!-- Sidebar (Mobile: Off-canvas, Desktop: Fixed) -->
    <div x-cloak :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>

    <!-- Main Content Wrapper -->
    <div class="flex h-screen overflow-hidden bg-background-soft">
        
        <!-- Sidebar (Mobile: Off-canvas, Desktop: Static in Flex) -->
        <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-white border-r border-gray-200 lg:translate-x-0 lg:static lg:inset-0 lg:block shadow-xl lg:shadow-none font-medium">
            <!-- Sidebar Header -->
            <div class="flex items-center justify-center h-20 shadow-sm border-b border-gray-100 bg-white">
                <a href="/" class="flex items-center gap-2 px-4">
                    <img class="h-8 w-auto" src="{{ asset('images/bps-logo-full.png') }}" alt="Logo">
                    <span class="text-sm font-bold text-gray-700 tracking-wide">BISTIK KALDU</span>
                </a>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-5 px-4 space-y-1">
                <p class="px-2 text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Menu Utama</p>
                
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-sm rounded-lg transition-colors group {{ request()->routeIs('dashboard') ? 'bg-orange-50 text-primary font-bold' : 'text-gray-600 hover:bg-gray-50 hover:text-primary' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-primary' : 'text-gray-400 group-hover:text-primary' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('pembinaan.index') }}" class="flex items-center px-4 py-3 text-sm rounded-lg transition-colors group {{ request()->routeIs('pembinaan.*') ? 'bg-orange-50 text-primary font-bold' : 'text-gray-600 hover:bg-gray-50 hover:text-primary' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('pembinaan.*') ? 'text-primary' : 'text-gray-400 group-hover:text-primary' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    Pembinaan
                </a>

                <a href="{{ route('schedule.list') }}" class="flex items-center px-4 py-3 text-sm rounded-lg transition-colors group {{ request()->routeIs('schedule.list') ? 'bg-orange-50 text-primary font-bold' : 'text-gray-600 hover:bg-gray-50 hover:text-primary' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('schedule.list') ? 'text-primary' : 'text-gray-400 group-hover:text-primary' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Jadwal
                </a>

                <a href="{{ route('evaluasi.dashboard') }}" class="flex items-center px-4 py-3 text-sm rounded-lg transition-colors group {{ request()->routeIs('evaluasi.*') ? 'bg-orange-50 text-primary font-bold' : 'text-gray-600 hover:bg-gray-50 hover:text-primary' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('evaluasi.*') ? 'text-primary' : 'text-gray-400 group-hover:text-primary' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Evaluasi
                </a>
                
                <a href="/modul-sektoral" class="flex items-center px-4 py-3 text-sm rounded-lg transition-colors group text-gray-600 hover:bg-gray-50 hover:text-primary">
                    <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                    </svg>
                    Data Sektoral
                </a>

                <a href="#" class="flex items-center px-4 py-3 text-sm rounded-lg transition-colors group text-gray-600 hover:bg-gray-50 hover:text-primary">
                    <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    Panduan
                </a>

                <a href="#" class="flex items-center px-4 py-3 text-sm rounded-lg transition-colors group text-gray-600 hover:bg-gray-50 hover:text-primary">
                    <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Pintar Berbagi
                </a>

                <div class="pt-4 mt-4 border-t border-gray-100">
                    <p class="px-2 text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Bantuan</p>
                    <a href="{{ route('chat') }}" class="flex items-center px-4 py-3 text-sm rounded-lg transition-colors group {{ request()->routeIs('chat') ? 'bg-orange-50 text-primary font-bold' : 'text-gray-600 hover:bg-gray-50 hover:text-primary' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('chat') ? 'text-primary' : 'text-gray-400 group-hover:text-primary' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        Live Chat
                    </a>
                </div>
            </nav>
        </div>

        <div class="flex-1 flex flex-col overflow-hidden">
             <!-- Top Header -->
            <header class="flex items-center justify-between px-6 py-4 bg-white border-b border-gray-200">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    <!-- Page Title -->
                    <h2 class="text-xl font-bold text-gray-800 ml-4 lg:ml-0">{{ $header ?? 'Dashboard' }}</h2>
                </div>

                <!-- User Menu -->
                <div class="flex items-center gap-4">
                    <div class="relative" x-data="{ userMenuOpen: false }">
                        <button @click="userMenuOpen = !userMenuOpen" class="flex items-center gap-3 focus:outline-none">
                            <div class="text-right hidden sm:block">
                                <div class="text-sm font-semibold text-gray-800">{{ auth('external')->user()->name }}</div>
                                <div class="text-xs text-gray-500">{{ auth('external')->user()->organization ?? 'Instansi/OPD' }}</div>
                            </div>
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary to-orange-400 flex items-center justify-center text-white font-bold shadow-md">
                                {{ substr(auth('external')->user()->name, 0, 1) }}
                            </div>
                        </button>

                        <!-- Dropdown -->
                        <div x-show="userMenuOpen" @click.away="userMenuOpen = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl py-1 z-50 border border-gray-100">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-primary">Profile</a>
                            <div class="border-t border-gray-100"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Scrollable Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-background-soft p-6">
                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-lg relative" role="alert">
                        <strong class="font-bold">Berhasil!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>
