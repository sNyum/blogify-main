<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluasi EPSS - Bistik Kaldu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Add Chart.js -->
</head>
<body class="bg-[#FFF8E1] font-sans text-gray-800" x-data="{ sidebarOpen: false }">

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed inset-y-0 left-0 z-30 w-72 overflow-y-auto transition duration-300 transform bg-white border-r border-gray-200 lg:translate-x-0 lg:static lg:inset-0 lg:block shadow-xl">
            <!-- Sidebar Header -->
            <div class="flex items-center justify-center py-6 border-b border-gray-100">
                <a href="#" class="flex flex-col items-center">
                    <img class="h-12 w-auto mb-2" src="{{ asset('images/bps-logo-full.png') }}" alt="Logo">
                    <div class="text-center">
                        <h1 class="font-bold text-gray-800 text-lg leading-tight">BISTIK<br>KALDU</h1>
                        <p class="text-[10px] text-gray-500 mt-1 uppercase">Pembinaan Statistik Sektoral Terpadu<br>Kabupaten Batang Hari</p>
                    </div>
                </a>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-6 px-4 space-y-2">
                
                <a href="{{ route('evaluasi.dashboard') }}" class="flex items-center px-4 py-3 text-sm font-bold text-white bg-[#E65100] rounded-lg shadow-md transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    Dashboard Penilaian
                </a>

                <div class="pt-4 pb-2">
                    <p class="px-2 text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Penilaian Mandiri</p>
                </div>

                <!-- Domain 1 -->
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50 hover:text-[#E65100] transition-colors">
                        <div class="flex items-center">
                            <span class="mr-3 text-gray-400">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                            </span>
                            1. Prinsip SDI
                        </div>
                        <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </button>
                    <!-- Aspek List (Placeholder) -->
                    <div x-show="open" x-collapse class="pl-12 pr-4 py-2 space-y-1">
                        <a href="{{ route('evaluasi.sdi.standar-data') }}" class="block text-xs text-gray-500 hover:text-[#E65100] {{ request()->routeIs('evaluasi.sdi.standar-data') ? 'text-[#E65100] font-bold' : '' }}">101. Standar Data</a>
                        <a href="#" class="block text-xs text-gray-500 hover:text-[#E65100]">102. Metadata</a>
                        <a href="#" class="block text-xs text-gray-500 hover:text-[#E65100]">103. Interopabilitas</a>
                        <a href="#" class="block text-xs text-gray-500 hover:text-[#E65100]">104. Kode Referensi</a>
                    </div>
                </div>

                <!-- Domain 2 -->
                <a href="#" class="flex items-center px-4 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50 hover:text-[#E65100] transition-colors">
                    <span class="mr-3 text-gray-400"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg></span>
                    2. Kualitas Data
                </a>
                
                 <!-- Domain 3 -->
                <a href="#" class="flex items-center px-4 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50 hover:text-[#E65100] transition-colors">
                    <span class="mr-3 text-gray-400"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg></span>
                    3. Proses Bisnis
                </a>

                 <!-- Domain 4 -->
                <a href="#" class="flex items-center px-4 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50 hover:text-[#E65100] transition-colors">
                    <span class="mr-3 text-gray-400"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg></span>
                    4. Kelembagaan
                </a>

                 <!-- Domain 5 -->
                <a href="#" class="flex items-center px-4 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50 hover:text-[#E65100] transition-colors">
                    <span class="mr-3 text-gray-400"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg></span>
                    5. Statistik Nasional
                </a>

                <div x-data="{ open: false }" class="pt-4 border-t border-gray-100 mt-4">
                     <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50 hover:text-[#E65100] transition-colors">
                        <div class="flex items-center">
                            <span class="mr-3 text-gray-400"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg></span>
                            Pengguna
                        </div>
                        <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </button>
                    <!-- Pengguna List -->
                    <div x-show="open" x-collapse class="pl-12 pr-4 py-2 space-y-1">
                        <a href="{{ route('evaluasi.pengguna.profil') }}" class="block text-xs text-gray-500 hover:text-[#E65100] {{ request()->routeIs('evaluasi.pengguna.profil') ? 'text-[#E65100] font-bold' : '' }}">Profil</a>
                        
                        @if(!auth('external')->check())
                        <a href="{{ route('evaluasi.pengguna.index') }}" class="block text-xs text-gray-500 hover:text-[#E65100] {{ request()->routeIs('evaluasi.pengguna.index') ? 'text-[#E65100] font-bold' : '' }}">Daftar Pengguna</a>
                        @endif

                        <a href="{{ route('evaluasi.pengguna.password') }}" class="block text-xs text-gray-500 hover:text-[#E65100] {{ request()->routeIs('evaluasi.pengguna.password') ? 'text-[#E65100] font-bold' : '' }}">Ubah Password</a>
                    </div>
                
                    <a href="{{ route('evaluasi.nilai-ips') }}" class="flex items-center px-4 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50 hover:text-[#E65100] transition-colors {{ request()->routeIs('evaluasi.nilai-ips') ? 'bg-orange-50 text-[#E65100] font-bold' : '' }}">
                        <span class="mr-3 text-gray-400"><svg class="w-5 h-5 {{ request()->routeIs('evaluasi.nilai-ips') ? 'text-[#E65100]' : '' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg></span>
                        Nilai IPS
                    </a>

                    <!-- Instansi Menu (BPS Only) -->
                    @if(auth('bps')->check())
                    <div x-data="{ open: false }" class="mt-2">
                        <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50 hover:text-[#E65100] transition-colors">
                            <div class="flex items-center">
                                <span class="mr-3 text-gray-400">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                                </span>
                                Instansi
                            </div>
                            <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                        </button>
                        <div x-show="open" x-collapse class="pl-12 pr-4 py-2 space-y-1">
                            <a href="{{ route('evaluasi.instansi.index') }}" class="block text-xs text-gray-500 hover:text-[#E65100] {{ request()->routeIs('evaluasi.instansi.index') ? 'text-[#E65100] font-bold' : '' }}">Daftar Instansi</a>
                            <a href="{{ route('evaluasi.instansi.hasil') }}" class="block text-xs text-gray-500 hover:text-[#E65100] {{ request()->routeIs('evaluasi.instansi.hasil') ? 'text-[#E65100] font-bold' : '' }}">Hasil Penilaian</a>
                            <a href="{{ route('evaluasi.instansi.proses') }}" class="block text-xs text-gray-500 hover:text-[#E65100] {{ request()->routeIs('evaluasi.instansi.proses') ? 'text-[#E65100] font-bold' : '' }}">Proses</a>
                        </div>
                    </div>
                    @endif
                    
                    <form action="{{ route('evaluasi.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="flex w-full items-center px-4 py-2 text-sm font-medium text-red-500 rounded-lg hover:bg-red-50 transition-colors mt-2">
                             <span class="mr-3"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg></span>
                            Logout
                        </button>
                    </form>
                </div>

            </nav>
        </div>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-hidden bg-[#FFF8E1]">
            
            <!-- Mobile Header with Hamburger -->
            <header class="flex items-center justify-between px-6 py-4 bg-white border-b border-gray-200 lg:hidden shadow-sm">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none p-2 rounded-md hover:bg-gray-100">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <span class="ml-4 text-lg font-bold text-gray-800">Evaluasi EPSS</span>
                </div>
                <img class="h-8 w-auto" src="{{ asset('images/bps-logo-full.png') }}" alt="Logo">
            </header>

            <!-- Scrollable Content -->
            <div class="flex-1 overflow-x-hidden overflow-y-auto">
                @yield('content')
            </div>
        </main>

        <!-- Mobile Sidebar Overlay -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black bg-opacity-50 z-20 lg:hidden"></div>
    </div>

</body>
</html>
