<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bistik Kaldu - BPS Kabupaten Batanghari</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body class="antialiased font-sans bg-background-soft text-gray-800">
    
    <!-- Navbar -->
    <nav class="absolute top-0 w-full z-10">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <div class="flex-shrink-0">
                    <a href="/" class="transform hover:scale-105 transition-transform duration-300">
                        <img class="h-20 w-auto" src="{{ asset('images/bistik-kaldu-logo.png') }}" alt="BISTIK KALDU">
                    </a>
                </div>
                
                <!-- Navigation -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-8">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-primary font-medium transition-colors">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="px-5 py-2.5 bg-gradient-to-r from-primary to-primary-hover text-white font-semibold rounded-full hover:shadow-lg hover:shadow-orange-500/30 transition-all transform hover:-translate-y-0.5">
                                    Login Agency
                                </a>
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-white">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-gradient-to-br from-orange-50/50 via-white to-orange-50/30"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-6 lg:px-8 pt-32 pb-20 lg:pt-48 lg:pb-32">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-4xl lg:text-6xl font-extrabold tracking-tight text-gray-900 mb-6">
                    Bimbingan Statistik <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-orange-600">Sektoral Terpadu</span>
                </h1>
                <p class="text-lg lg:text-xl text-gray-600 mb-10 leading-relaxed">
                    Menuju Satu Data Indonesia melalui pembinaan statistik yang terintegrasi, profesional, dan berintegritas untuk Kabupaten Batanghari.
                </p>
                <div class="flex justify-center gap-4">
                    <a href="{{ route('login') }}" class="px-8 py-3.5 bg-primary text-white text-lg font-semibold rounded-lg shadow-xl shadow-orange-500/20 hover:bg-orange-600 hover:shadow-orange-500/30 transition-all transform hover:-translate-y-1">
                        Mulai Konsultasi
                    </a>
                    <a href="#fitur" class="px-8 py-3.5 bg-white text-gray-700 text-lg font-semibold rounded-lg border border-gray-200 hover:border-primary/50 hover:text-primary transition-all">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div id="fitur" class="py-24 bg-background-soft">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-base font-bold text-primary tracking-wide uppercase">Layanan Kami</h2>
                <p class="mt-2 text-3xl font-extrabold text-gray-900">Platform Terintegrasi Statistik Sektoral</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center mb-6 text-primary">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Evaluasi Mandiri</h3>
                    <p class="text-gray-600">Lakukan penilaian mandiri penyelenggaraan statistik sektoral instansi Anda dengan mudah dan terukur.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-6 text-secondary">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Konsultasi & Pembinaan</h3>
                    <p class="text-gray-600">Dapatkan jadwal pembinaan dan konsultasi langsung dengan pembina data BPS secara terjadwal.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-6 text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Repository Data</h3>
                    <p class="text-gray-600">Akses dan bagikan data sektoral antar instansi untuk mendukung Satu Data Indonesia.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div>
                    <h2 class="text-2xl font-bold mb-4">BPS Kabupaten Batanghari</h2>
                    <p class="text-gray-400">Jl. Jend. Sudirman No. 123<br>Muara Bulian, Jambi</p>
                </div>
                <div class="md:text-right">
                    <p class="text-gray-500 text-sm">© {{ date('Y') }} Badan Pusat Statistik. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
