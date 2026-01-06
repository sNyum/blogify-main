<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $modul->judul }} - BPS Kabupaten Batanghari</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 h-screen overflow-hidden font-sans antialiased">

    <!-- Header - Fixed Height -->
    <header class="bg-white shadow-sm z-20 relative h-16 flex-shrink-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex justify-between items-center">
            <a href="/" class="flex items-center text-blue-900 hover:text-blue-700 transition">
                <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                <span class="font-medium text-sm">Kembali ke Beranda</span>
            </a>
            <img class="h-10 w-auto" src="{{ asset('images/bps-logo-full.png') }}" alt="BPS Batanghari">
        </div>
    </header>

    <!-- Main Content - Calculated Height (100vh - header - footer) -->
    <main class="w-full max-w-[99%] mx-auto px-2" style="height: calc(100vh - 4rem - 2rem);">
        
        <!-- Card Container - Takes Full Height of Main -->
        <div class="bg-white rounded-xl shadow-2xl overflow-hidden h-full flex flex-col border border-gray-100 relative my-2">
            <div class="flex flex-col lg:flex-row h-full">
                <!-- Left: Viewer (Iframe) - Larger Area -->
                <div class="w-full lg:w-[80%] h-full bg-gray-50 border-r border-gray-200 relative group flex flex-col">
                    @if($modul->attachment_file)
                        @php
                            $extension = pathinfo($modul->attachment_file, PATHINFO_EXTENSION);
                        @endphp

                        @if(strtolower($extension) === 'pdf')
                            <iframe 
                                src="{{ asset('storage/' . $modul->attachment_file) }}" 
                                class="w-full h-full" 
                                frameborder="0">
                            </iframe>
                        @else
                            <!-- PPT/PPTX handled by Google Viewer -->
                            <iframe 
                                src="https://docs.google.com/gview?url={{ urlencode(asset('storage/' . $modul->attachment_file)) }}&embedded=true" 
                                class="w-full h-full" 
                                frameborder="0"
                                onerror="this.style.display='none'">
                            </iframe>
                            
                            <!-- Localhost Warning / Fallback -->
                            <div class="absolute inset-0 pointer-events-none flex items-center justify-center bg-gray-50/80 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 lg:hidden user-select-none">
                                <p class="text-gray-500 text-sm font-medium px-4 text-center">
                                    Jika preview tidak muncul, pastikan website sudah online (bukan localhost).
                                </p>
                            </div>
                        @endif
                    @else
                        <div class="flex items-center justify-center h-full text-gray-400">
                            <div class="text-center">
                                <svg class="mx-auto h-16 w-16 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <p class="mt-4 text-gray-400 font-medium">File presentasi tidak tersedia.</p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Right: Title & Actions - Sleek Sidebar -->
                <div class="w-full lg:w-[20%] bg-white flex flex-col p-6 overflow-y-auto">
                    
                    <!-- Content Group -->
                    <div>
                         <div class="flex items-center gap-2 mb-4">
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-600">
                                Modul Sektoral
                            </span>
                        </div>

                        <h1 class="text-xl md:text-2xl font-bold text-gray-900 leading-snug tracking-tight">
                            {{ $modul->judul }}
                        </h1>
                        
                        @if($modul->deskripsi)
                            <div class="mt-4 prose prose-sm text-gray-500 leading-relaxed">
                                {{ $modul->deskripsi }}
                            </div>
                        @endif
                    </div>

                    <!-- Footer Group -->
                    <div class="mt-auto pt-8">
                        @if($modul->attachment_file)
                            <a href="{{ asset('storage/' . $modul->attachment_file) }}" target="_blank" class="flex items-center justify-center w-full px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl shadow-lg shadow-blue-200 hover:shadow-blue-300 transition-all duration-300 transform group hover:-translate-y-0.5">
                                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                                Download Materi
                            </a>
                        @else
                             <button disabled class="w-full px-4 py-3 bg-gray-100 text-gray-400 text-sm font-semibold rounded-xl cursor-not-allowed">
                                Download Tidak Tersedia
                            </button>
                        @endif
                        
                        <div class="mt-4 text-center">
                            <a href="/" class="text-xs font-medium text-gray-400 hover:text-gray-600 transition-colors">
                                &larr; Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer - Fixed at Bottom -->
    <footer class="h-8 flex-shrink-0 flex items-center justify-center bg-gray-50">
        <div class="text-center text-gray-400 text-xs">
            &copy; {{ date('Y') }} Badan Pusat Statistik Kabupaten Batanghari. All rights reserved.
        </div>
    </footer>
</body>
</html>
