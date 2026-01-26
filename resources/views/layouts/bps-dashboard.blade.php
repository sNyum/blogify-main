<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Dashboard BPS Admin' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-background-soft font-sans antialiased text-gray-800" x-data="{ sidebarOpen: false }">
    
    <div x-cloak :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>

    <div class="flex h-screen overflow-hidden bg-background-soft">
        
        <!-- Sidebar -->
        <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-white border-r border-gray-200 lg:translate-x-0 lg:static lg:inset-0 lg:block shadow-xl lg:shadow-none font-medium">
            <!-- Sidebar Header -->
            <div class="flex items-center justify-center h-20 shadow-sm border-b border-gray-100 bg-white">
                <a href="#" class="flex items-center gap-2 px-4">
                    <img class="h-8 w-auto" src="{{ asset('images/bps-logo-full.png') }}" alt="Logo">
                    <span class="text-sm font-bold text-gray-700 tracking-wide">BISTIK ADMIN</span>
                </a>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-5 px-4 space-y-1">
                <p class="px-2 text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Menu Admin</p>
                
                <a href="{{ route('bps-admin.dashboard') }}" class="flex items-center px-4 py-3 text-sm rounded-lg transition-colors group {{ request()->routeIs('bps-admin.dashboard') ? 'bg-orange-50 text-primary font-bold' : 'text-gray-600 hover:bg-gray-50 hover:text-primary' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('bps-admin.dashboard') ? 'text-primary' : 'text-gray-400 group-hover:text-primary' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('bps-admin.registrations') }}" class="flex items-center px-4 py-3 text-sm rounded-lg transition-colors group {{ request()->routeIs('bps-admin.registrations*') ? 'bg-orange-50 text-primary font-bold' : 'text-gray-600 hover:bg-gray-50 hover:text-primary' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('bps-admin.registrations*') ? 'text-primary' : 'text-gray-400 group-hover:text-primary' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Approval Pendaftaran
                </a>

                <a href="{{ route('bps-admin.pembinaan.index') }}" class="flex items-center px-4 py-3 text-sm rounded-lg transition-colors group {{ request()->routeIs('bps-admin.pembinaan*') ? 'bg-orange-50 text-primary font-bold' : 'text-gray-600 hover:bg-gray-50 hover:text-primary' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('bps-admin.pembinaan*') ? 'text-primary' : 'text-gray-400 group-hover:text-primary' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Kelola Pembinaan
                </a>

                <!-- Tambahkan menu lain di sini jika perlu -->
                
                <div class="pt-4 mt-4 border-t border-gray-100">
                     <form method="POST" action="{{ route('bps-admin.logout') }}">
                        @csrf
                        <button type="submit" class="flex w-full items-center px-4 py-3 text-sm rounded-lg transition-colors group text-red-600 hover:bg-red-50">
                            <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Logout
                        </button>
                    </form>
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
                    <h2 class="text-xl font-bold text-gray-800 ml-4 lg:ml-0">{{ $header ?? 'Dashboard Admin' }}</h2>
                </div>

                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-3">
                        <div class="text-right hidden sm:block">
                            <div class="text-sm font-semibold text-gray-800">{{ auth()->user()->name ?? 'Admin BPS' }}</div>
                            <div class="text-xs text-gray-500">Administrator</div>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-white font-bold shadow-md">
                            {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Scrollable Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-background-soft p-6">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>
