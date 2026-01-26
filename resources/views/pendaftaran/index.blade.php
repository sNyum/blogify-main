<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Pembinaan - BPS Kabupaten Batanghari</title>
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
                    <a href="/#modul-sektoral" class="nav-link relative text-sm font-medium text-gray-700 hover:text-primary transition-all duration-300 group">
                        Modul Sektoral
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-primary to-primary-hover group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="/#berita" class="nav-link relative text-sm font-medium text-gray-700 hover:text-primary transition-all duration-300 group">
                        Berita
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-primary to-primary-hover group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="/#pustaka" class="nav-link relative text-sm font-medium text-gray-700 hover:text-primary transition-all duration-300 group">
                        Pustaka
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-primary to-primary-hover group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="/#konsultasi" class="nav-link relative text-sm font-medium text-gray-700 hover:text-primary transition-all duration-300 group">
                        Konsultasi
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-primary to-primary-hover group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="/pendaftaran" class="nav-link relative text-sm font-medium text-gray-700 hover:text-primary transition-all duration-300 group">
                        Pendaftaran
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
                        @auth('bps')
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 hover:text-green-600 transition-colors">
                                    <div class="w-8 h-8 bg-gradient-to-br from-green-600 to-green-700 rounded-full flex items-center justify-center text-white font-semibold">
                                        {{ substr(auth('bps')->user()->name, 0, 1) }}
                                    </div>
                                    <span class="hidden lg:inline">{{ auth('bps')->user()->name }}</span>
                                    <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                
                                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 z-50">
                                    <div class="px-4 py-2 text-xs text-gray-500 border-b border-gray-100">Pengguna BPS</div>
                                    <a href="{{ route('bps.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 transition-colors">
                                        Dashboard
                                    </a>
                                    <form action="{{ route('bps.logout') }}" method="POST" class="block">
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
                <a href="/#modul-sektoral" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary hover:bg-orange-50">Modul Sektoral</a>
                <a href="/#berita" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary hover:bg-orange-50">Berita</a>
                <a href="/#pustaka" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary hover:bg-orange-50">Pustaka</a>
                <a href="/#konsultasi" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary hover:bg-orange-50">Konsultasi</a>
                <a href="/pendaftaran" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary hover:bg-orange-50">Pendaftaran</a>
                
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
                    @auth('bps')
                        <div class="border-t border-gray-100 my-2 pt-2">
                            <div class="px-3 py-2 text-sm text-gray-500">Pengguna BPS: {{ auth('bps')->user()->name }}</div>
                            <a href="{{ route('bps.dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-green-600 hover:bg-green-50">Dashboard</a>
                            <form action="{{ route('bps.logout') }}" method="POST" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left block px-3 py-2 rounded-md text-base font-medium text-red-600 hover:bg-red-50">Logout</button>
                            </form>
                        </div>
                    @else
                        <button onclick="openLoginModal()" class="w-full text-left block px-3 py-2 rounded-md text-base font-medium text-primary hover:bg-orange-50 font-bold">
                            Login
                        </button>
                    @endauth
                @endauth
            </div>
        </div>
    </nav>

    <!-- Login Modal -->
    <div id="loginModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8 transform transition-all relative">
            <button onclick="closeLoginModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
            <div class="text-center mb-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Pilih Jenis Login</h3>
                <p class="text-gray-600">Silakan pilih akses Anda</p>
            </div>
            <div class="space-y-3">
                <!-- Login Admin BPS -->
                <a href="/admin/login" class="group block w-full p-5 bg-gradient-to-r from-secondary to-blue-800 hover:from-blue-700 hover:to-blue-900 rounded-xl transition-all duration-300 shadow-lg text-white">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center"><svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg></div>
                        <div class="text-left"><h4 class="font-bold text-base">Login Admin</h4><p class="text-xs text-blue-200">Panel Administrasi BPS</p></div>
                    </div>
                </a>
                
                <!-- Login Pengguna BPS (Staff Internal) -->
                <a href="/bps/login" class="group block w-full p-5 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 rounded-xl transition-all duration-300 shadow-lg text-white">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center"><svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg></div>
                        <div class="text-left"><h4 class="font-bold text-base">Login Pengguna BPS</h4><p class="text-xs text-green-200">Pegawai BPS Internal</p></div>
                    </div>
                </a>
                
                <!-- Login User External (Agency/OPD) -->
                <a href="/login" class="group block w-full p-5 bg-gradient-to-r from-primary to-orange-600 hover:from-orange-600 hover:to-primary rounded-xl transition-all duration-300 shadow-lg text-white">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center"><svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg></div>
                        <div class="text-left"><h4 class="font-bold text-base">Login User</h4><p class="text-xs text-orange-200">Akses Layanan Agency/OPD</p></div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content with padding for fixed navbar -->
    <div class="pt-20">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Page Title -->
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-4">
            PENDAFTARAN PEMBINAAN STATISTIK SEKTORAL
        </h1>

        <!-- Description -->
        <div class="text-center text-gray-600 mb-6 max-w-4xl mx-auto">
            <p class="mb-2">
                Pendaftaran Pembinaan bertujuan agar Instansi atau Organisasi Perangkat Daerah (OPD) yang membutuhkan pembinaan statistik sektoral dapat melengkapi persyaratan administrasi untuk selanjutnya mendapatkan jadwal pembinaan statistik.
            </p>
            <p class="mb-4">
                Instansi/OPD dapat bertanya terlebih dahulu melalui 
                <a href="#" class="text-[#F15A24] font-semibold hover:underline">Contact Person BPS Kabupaten Batanghari</a> 
                atau langsung mengisi formulir pendaftaran.
            </p>
            <p class="text-sm italic">
                Instansi/OPD yang pendaftarannya telah berstatus <strong>'Disetujui'</strong> akan segera menerima akun melalui WhatsApp. Akun akan digunakan untuk mengakses Menu Evaluasi dan Upload Data IUP. Username akan ditampilkan dalam chat, dan silakan update password secara mandiri.
            </p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6 max-w-4xl mx-auto">
                {{ session('success') }}
            </div>
        @endif

        <!-- Alert Box (Optional) -->
        {{-- Uncomment if registration is closed --}}
        {{-- <div class="bg-[#F15A24] text-white px-6 py-4 rounded-lg mb-6 max-w-4xl mx-auto text-center">
            <p class="font-bold text-lg">PENDAFTARAN PEMBINAAN TELAH DITUTUP</p>
            <p class="text-sm mt-1">Terima kasih telah mendaftar. Kami tidak sedang memproses pendaftaran. Mohon menunggu.</p>
        </div> --}}

        <!-- Data Pendaftar Section -->
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-[#F15A24]">DATA PENDAFTAR</h2>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th class="px-4 py-3 text-left text-sm font-semibold">No</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Nama OPD</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">PIC</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">WA</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">File Surat</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Status</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Tgl Pengajuan</th>
                            @auth('bps')
                                <th class="px-4 py-3 text-center text-sm font-semibold">Aksi</th>
                            @endauth
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($registrations as $index => $registration)
                            <tr class="{{ $loop->even ? 'bg-[#FFF5E6]' : 'bg-white' }} hover:bg-orange-50 transition">
                                <td class="px-4 py-3 text-sm">{{ $registrations->firstItem() + $index }}</td>
                                <td class="px-4 py-3 text-sm font-medium">{{ $registration->organization }}</td>
                                <td class="px-4 py-3 text-sm">{{ $registration->name }}</td>
                                <td class="px-4 py-3 text-sm font-mono">{{ $registration->masked_phone }}</td>
                                <td class="px-4 py-3 text-sm">
                                    @if($registration->surat_permohonan_path)
                                        <div class="flex gap-1 text-xs">
                                            <a href="{{ Storage::url($registration->surat_permohonan_path) }}" target="_blank" class="text-blue-600 hover:text-blue-800 hover:underline">Lihat</a>
                                            <span class="text-gray-400">|</span>
                                            <a href="{{ Storage::url($registration->surat_permohonan_path) }}" download class="text-blue-600 hover:text-blue-800 hover:underline">Download</a>
                                        </div>
                                    @else
                                        <span class="text-gray-400 text-xs">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if($registration->status === 'pending')
                                        <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">
                                            Menunggu Persetujuan
                                        </span>
                                    @elseif($registration->status === 'approved')
                                        <span class="inline-block px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">
                                            Disetujui
                                        </span>
                                    @elseif($registration->status === 'rejected')
                                        <span class="inline-block px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">
                                            Ditolak
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">{{ $registration->created_at->format('Y-m-d') }}</td>
                                @auth('bps')
                                    <td class="px-4 py-3 text-sm text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            @if($registration->status === 'pending')
                                                <form action="{{ route('bps-admin.registrations.approve', $registration->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menyetujui pendaftaran ini?')">
                                                    @csrf
                                                    <button type="submit" class="px-4 py-1.5 bg-[#F15A24] hover:bg-[#D1491B] text-white text-xs font-bold rounded shadow transition-colors w-20">
                                                        Setujui
                                                    </button>
                                                </form>
                                            @elseif($registration->status === 'approved')
                                                <a href="{{ route('bps-admin.registrations.whatsapp', $registration->id) }}" target="_blank" class="px-4 py-1.5 bg-green-500 hover:bg-green-600 text-white text-xs font-bold rounded shadow transition-colors w-20 inline-block text-center flex items-center justify-center">
                                                    Kirim WA
                                                </a>
                                            @endif
                                            
                                            <form action="{{ route('bps-admin.registrations.destroy', $registration->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-4 py-1.5 bg-[#F15A24] hover:bg-[#D1491B] text-white text-xs font-bold rounded shadow transition-colors w-20">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                @endauth
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                                    Belum ada data pendaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if($registrations->hasPages())
            <div class="mb-8">
                {{ $registrations->links() }}
            </div>
        @endif

        <!-- Register Button -->
        <div class="text-center mb-8">
            <a href="{{ route('register') }}" 
               class="inline-block px-8 py-3 bg-primary text-white font-semibold rounded-lg hover:bg-primary-hover transition shadow-lg">
                Daftar Sekarang
            </a>
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
