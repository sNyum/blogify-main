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
                <a href="/admin/login" class="px-6 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-orange-600 to-orange-700 rounded-full hover:from-orange-700 hover:to-orange-800 transition-all duration-300 shadow-lg shadow-orange-500/30 hover:shadow-xl hover:shadow-orange-500/40 hover:-translate-y-0.5 ml-2 inline-block">
                    Login
                </a>
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
            <a href="/admin/login" class="block w-full px-3 py-2 mt-2 rounded-lg text-base font-medium text-white bg-gradient-to-r from-orange-600 to-orange-700 hover:from-orange-700 hover:to-orange-800 transition-all duration-300 text-center">Login</a>
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
