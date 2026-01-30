<!-- Enhanced Navbar with Glassmorphism -->
<nav id="navbar" class="bg-white/70 backdrop-blur-xl fixed w-full z-50 border-b border-gray-200/50 shadow-lg shadow-orange-500/5 transition-all duration-500 ease-out">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div id="nav-content" class="flex justify-between h-20 transition-all duration-500">
            <div class="flex items-center">
                <a href="/" class="transform hover:scale-105 transition-transform duration-300">
                    <img id="nav-logo" class="h-20 w-auto transition-all duration-500" src="{{ asset('images/bistik-kaldu-logo.png') }}" alt="BISTIK KALDU - Kabupaten Batanghari">
                </a>
            </div>
            <div class="hidden sm:flex sm:items-center sm:gap-8">
                <a href="/modul-sektoral" class="nav-link relative text-sm font-medium {{ request()->is('modul-sektoral*') ? 'text-orange-600 font-bold' : 'text-gray-700' }} hover:text-orange-600 transition-all duration-300 group">
                    Modul Sektoral
                    <span class="absolute -bottom-1 left-0 {{ request()->is('modul-sektoral*') ? 'w-full' : 'w-0' }} h-0.5 bg-gradient-to-r from-orange-600 to-orange-400 group-hover:w-full transition-all duration-300"></span>
                </a>
                <a href="/berita" class="nav-link relative text-sm font-medium {{ request()->is('berita*') ? 'text-orange-600 font-bold' : 'text-gray-700' }} hover:text-orange-600 transition-all duration-300 group">
                    Berita
                    <span class="absolute -bottom-1 left-0 {{ request()->is('berita*') ? 'w-full' : 'w-0' }} h-0.5 bg-gradient-to-r from-orange-600 to-orange-400 group-hover:w-full transition-all duration-300"></span>
                </a>
                <a href="/pustaka" class="nav-link relative text-sm font-medium {{ request()->is('pustaka*') ? 'text-orange-600 font-bold' : 'text-gray-700' }} hover:text-orange-600 transition-all duration-300 group">
                    Pustaka
                    <span class="absolute -bottom-1 left-0 {{ request()->is('pustaka*') ? 'w-full' : 'w-0' }} h-0.5 bg-gradient-to-r from-orange-600 to-orange-400 group-hover:w-full transition-all duration-300"></span>
                </a>
                <a href="/#konsultasi" class="nav-link relative text-sm font-medium text-gray-700 hover:text-orange-600 transition-all duration-300 group">
                    Konsultasi
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-orange-600 to-orange-400 group-hover:w-full transition-all duration-300"></span>
                </a>
                <button onclick="openGlobalLoginModal()" class="px-6 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-orange-600 to-orange-700 rounded-full hover:from-orange-700 hover:to-orange-800 transition-all duration-300 shadow-lg shadow-orange-500/30 hover:shadow-xl hover:shadow-orange-500/40 hover:-translate-y-0.5 ml-2 cursor-pointer">
                    Login
                </button>
            </div>
            <!-- Mobile menu button -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button type="button" id="mobile-menu-button" class="inline-flex items-center justify-center p-2 rounded-lg text-gray-600 hover:text-orange-600 hover:bg-orange-50 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-orange-500 transition-all duration-300">
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
            <a href="/modul-sektoral" class="block px-3 py-2 rounded-lg text-base font-medium {{ request()->is('modul-sektoral*') ? 'text-orange-600 bg-orange-50 font-bold' : 'text-gray-700' }} hover:text-orange-600 hover:bg-orange-50 transition-all duration-300">Modul Sektoral</a>
            <a href="/berita" class="block px-3 py-2 rounded-lg text-base font-medium {{ request()->is('berita*') ? 'text-orange-600 bg-orange-50 font-bold' : 'text-gray-700' }} hover:text-orange-600 hover:bg-orange-50 transition-all duration-300">Berita</a>
            <a href="/pustaka" class="block px-3 py-2 rounded-lg text-base font-medium {{ request()->is('pustaka*') ? 'text-orange-600 bg-orange-50 font-bold' : 'text-gray-700' }} hover:text-orange-600 hover:bg-orange-50 transition-all duration-300">Pustaka</a>
            <a href="/#konsultasi" class="block px-3 py-2 rounded-lg text-base font-medium text-gray-700 hover:text-orange-600 hover:bg-orange-50 transition-all duration-300">Konsultasi</a>
            <button onclick="openGlobalLoginModal()" class="block w-full px-3 py-2 mt-2 rounded-lg text-base font-medium text-white bg-gradient-to-r from-orange-600 to-orange-700 hover:from-orange-700 hover:to-orange-800 transition-all duration-300 text-center cursor-pointer">Login</button>
        </div>
    </div>
</nav>

            <!-- Login Modal (Global) -->
            <div id="globalLoginModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-[100] flex items-center justify-center p-4 transition-opacity duration-300 opacity-0 pointer-events-none">
                <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8 transform transition-all scale-95 opacity-0 duration-300 relative" id="modalContent">
                    <button onclick="closeGlobalLoginModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors bg-gray-100 rounded-full p-1">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                    
                    <div class="text-center mb-6">
                        <img src="{{ asset('images/bistik-kaldu-logo.png') }}" alt="BISTIK KALDU" class="h-16 w-auto mx-auto mb-3">
                        <h3 class="text-2xl font-bold text-gray-900 mb-1">Pilih Jenis Login</h3>
                        <p class="text-gray-500 text-sm">Silakan pilih akses Anda</p>
                    </div>
                    
                    <div class="space-y-3">
                        <!-- Login Admin (Blue) -->
                        <a href="/admin/login" class="group block w-full p-4 bg-gradient-to-r from-secondary to-blue-800 hover:from-blue-700 hover:to-blue-900 rounded-xl transition-all duration-300 shadow-md text-white border border-transparent hover:border-blue-300">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <div class="text-left">
                                    <h4 class="font-bold text-sm uppercase tracking-wide">Login Admin</h4>
                                    <p class="text-[10px] text-blue-100">Panel Administrasi BPS</p>
                                </div>
                            </div>
                        </a>
                        
                        <!-- Login Pengguna BPS (Green) -->
                        <a href="/bps/login" class="group block w-full p-4 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 rounded-xl transition-all duration-300 shadow-md text-white border border-transparent hover:border-green-300">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="text-left">
                                    <h4 class="font-bold text-sm uppercase tracking-wide">Login Pengguna BPS</h4>
                                    <p class="text-[10px] text-green-100">Pegawai BPS Internal</p>
                                </div>
                            </div>
                        </a>
                        
                        <!-- Login User (Orange) -->
                        <a href="/login" class="group block w-full p-4 bg-gradient-to-r from-primary to-orange-600 hover:from-orange-600 hover:to-primary rounded-xl transition-all duration-300 shadow-md text-white border border-transparent hover:border-orange-300">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div class="text-left">
                                    <h4 class="font-bold text-sm uppercase tracking-wide">Login User</h4>
                                    <p class="text-[10px] text-orange-200">Akses Layanan Agency/OPD</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

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

                // Global Login Modal Logic
                function openGlobalLoginModal() {
                    const modal = document.getElementById('globalLoginModal');
                    const content = document.getElementById('modalContent');
                    
                    modal.classList.remove('hidden');
                    // Small delay to allow display:block to apply before opacity transition
                    setTimeout(() => {
                        modal.classList.remove('opacity-0', 'pointer-events-none');
                        content.classList.remove('scale-95', 'opacity-0');
                        content.classList.add('scale-100', 'opacity-100');
                    }, 10);
                }

                function closeGlobalLoginModal() {
                    const modal = document.getElementById('globalLoginModal');
                    const content = document.getElementById('modalContent');
                    
                    modal.classList.add('opacity-0', 'pointer-events-none');
                    content.classList.remove('scale-100', 'opacity-100');
                    content.classList.add('scale-95', 'opacity-0');
                    
                    // Wait for transition to finish before hiding
                    setTimeout(() => {
                        modal.classList.add('hidden');
                    }, 300);
                }

                // Close modal when clicking outside
                document.getElementById('globalLoginModal').addEventListener('click', (e) => {
                    if (e.target === document.getElementById('globalLoginModal')) {
                        closeGlobalLoginModal();
                    }
                });
            </script>
