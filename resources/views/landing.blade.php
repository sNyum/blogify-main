<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Badan Pusat Statistik Kabupaten Batanghari</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">
    <!-- Navbar -->
    <nav class="bg-white/80 backdrop-blur-md fixed w-full z-50 border-b border-gray-100 shadow-sm transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <img class="h-12 w-auto" src="{{ asset('images/bps-logo-full.png') }}" alt="Badan Pusat Statistik Kabupaten Batanghari">
                </div>
                <div class="hidden sm:flex sm:items-center sm:gap-8">
                    <a href="#" class="text-sm font-medium text-gray-600 hover:text-blue-600 transition-colors">Beranda</a>
                    <a href="#modul-sektoral" class="text-sm font-medium text-gray-600 hover:text-blue-600 transition-colors">Modul Sektoral</a>
                    <a href="#berita" class="text-sm font-medium text-gray-600 hover:text-blue-600 transition-colors">Berita</a>
                    <a href="#pustaka" class="text-sm font-medium text-gray-600 hover:text-blue-600 transition-colors">Pustaka</a>
                    <a href="#konsultasi" class="text-sm font-medium text-gray-600 hover:text-blue-600 transition-colors">Konsultasi</a>
                    <a href="/admin/login" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-full hover:bg-blue-700 transition-colors shadow-md shadow-blue-500/20 ml-2">Login</a>
                </div>
                <!-- Mobile menu button -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                        <span class="sr-only">Open main menu</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative pt-32 pb-20 sm:pt-40 sm:pb-24 overflow-hidden bg-gradient-to-br from-blue-50 to-indigo-50">
        <div class="absolute top-0 right-0 -mr-20 -mt-20">
             <svg width="404" height="404" fill="none" viewBox="0 0 404 404" role="img" aria-labelledby="svg-squares">
                <defs><pattern id="ad119f34-7694-4c31-947f-5c9d249b21f3" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><rect x="0" y="0" width="4" height="4" class="text-blue-200" fill="currentColor" /></pattern></defs><rect width="404" height="404" fill="url(#ad119f34-7694-4c31-947f-5c9d249b21f3)" />
            </svg>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center z-10">
            <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                <span class="block text-blue-600">Data Mencerdaskan Bangsa</span>
                <span class="block text-2xl sm:text-3xl mt-2 text-gray-700 font-semibold">BPS Kabupaten Batanghari</span>
            </h1>
            <p class="mt-4 max-w-xl mx-auto text-base text-gray-500 sm:text-lg md:text-xl md:max-w-3xl">
                Menyediakan data statistik berkualitas untuk Indonesia Maju.
            </p>
            <div class="mt-8 max-w-md mx-auto sm:flex sm:justify-center md:mt-10">
                <div class="rounded-md shadow">
                    <a href="#modul-sektoral" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 md:py-4 md:text-lg transition-colors shadow-lg shadow-blue-500/30">
                        Lihat Data
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modul Sektoral Section -->
    <div id="modul-sektoral" class="py-16 bg-white sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-base font-semibold text-blue-600 tracking-wide uppercase">Layanan Data</h2>
                <p class="mt-1 text-3xl font-extrabold text-gray-900 sm:text-4xl sm:tracking-tight">Modul Sektoral</p>
                <p class="max-w-xl mt-5 mx-auto text-xl text-gray-500">
                    Akses data statistik sektoral terkini.
                </p>
            </div>

            <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @forelse($modulSektoral as $item)
                    <a href="/modul-sektoral/{{ $item->slug }}" class="group relative bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-lg hover:border-blue-200 transition-all duration-300 flex items-center">
                        <div class="flex-shrink-0 h-12 w-12 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                             <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                        </div>
                        <div class="ml-4 flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 group-hover:text-blue-700 transition-colors">{{ $item->judul }}</h3>
                        </div>
                        <div class="ml-2">
                             <svg class="h-5 w-5 text-gray-400 group-hover:text-blue-500 group-hover:translate-x-1 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-12">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                             <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" /></svg>
                        </div>
                        <p class="text-gray-500 text-lg">Belum ada modul sektoral yang tersedia.</p>
                    </div>
                @endforelse
            </div>
            
            @if($modulSektoral->count() > 0)
            <div class="mt-10 text-center">
                 <a href="/modul-sektoral" class="font-medium text-blue-600 hover:text-blue-500 flex items-center justify-center gap-1 group">
                    Lihat semua modul
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                </a>
            </div>
            @endif
        </div>
    </div>

    <!-- Berita Section -->
    <div id="berita" class="py-16 bg-gray-50 sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                 <h2 class="text-base font-semibold text-blue-600 tracking-wide uppercase">Informasi Terkini</h2>
                <p class="mt-1 text-3xl font-extrabold text-gray-900 sm:text-4xl sm:tracking-tight">Berita Terbaru</p>
            </div>

            <div class="mt-12 grid gap-8 md:grid-cols-3">
                 @forelse($berita as $news)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
                         <div class="h-48 bg-gray-200 relative">
                             @if($news->youtube_url)
                                 <a href="{{ $news->youtube_url }}" target="_blank" class="block h-full w-full">
                             @endif
                                 @if($news->foto)
                                    <img class="h-full w-full object-cover" src="{{ asset('storage/' . $news->foto) }}" alt="{{ $news->judul }}">
                                @else
                                    <div class="flex items-center justify-center h-full text-gray-400">
                                         <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                    </div>
                                @endif
                             @if($news->youtube_url)
                                 </a>
                             @endif
                         </div>
                        <div class="p-6">
                            <div class="text-sm text-gray-500 mb-2">
                                <time datetime="{{ $news->created_at }}">{{ $news->created_at->format('d M Y') }}</time>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">
                                <a href="{{ $news->youtube_url ?? '#' }}" {{ $news->youtube_url ? 'target=_blank' : '' }} class="hover:text-blue-600 transition-colors">{{ $news->judul }}</a>
                            </h3>
                            <div class="text-gray-600 text-sm line-clamp-3 mb-4">
                                {!! Str::limit(strip_tags($news->konten), 100) !!}
                            </div>
                            <a href="{{ $news->youtube_url ?? '#' }}" {{ $news->youtube_url ? 'target=_blank' : '' }} class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-500">
                                Tonton Video
                                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                         <p class="text-gray-500">Belum ada berita terbaru.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Pustaka Section -->
    <div id="pustaka" class="py-16 bg-white sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                 <h2 class="text-base font-semibold text-blue-600 tracking-wide uppercase">Publikasi</h2>
                <p class="mt-1 text-3xl font-extrabold text-gray-900 sm:text-4xl sm:tracking-tight">Pustaka Digital</p>
                <p class="max-w-xl mt-5 mx-auto text-xl text-gray-500">
                    Unduh dan baca publikasi statistik terbaru.
                </p>
            </div>

            <div class="mt-12 grid gap-8 md:grid-cols-3 lg:grid-cols-4">
                 @forelse($pustaka as $book)
                    <div class="group relative bg-white border border-gray-200 rounded-2xl overflow-hidden hover:shadow-lg transition-all duration-300">
                         <div class="aspect-w-3 aspect-h-4 bg-gray-200 group-hover:opacity-90 transition-opacity relative overflow-hidden h-48">
                             @if($book->cover_path)
                                <img src="{{ asset('storage/' . $book->cover_path) }}" alt="{{ $book->judul }}" class="object-cover w-full h-full transform group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="flex items-center justify-center h-full text-gray-400 bg-gray-100">
                                     <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-center pb-6">
                                <a href="{{ asset('storage/' . $book->pdf_path) }}" target="_blank" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-full shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300">
                                    <svg class="mr-2 -ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    Lihat PDF
                                </a>
                            </div>
                         </div>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-2">
                                <a href="{{ asset('storage/' . $book->pdf_path) }}" target="_blank">
                                    <span class="absolute inset-0"></span>
                                    {{ $book->judul }}
                                </a>
                            </h3>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                         <p class="text-gray-500">Belum ada pustaka digital terbaru.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Konsultasi Section -->
    <div id="konsultasi" class="py-16 bg-gray-50 sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <!-- Left: Info Text -->
                <div>
                     <h2 class="text-base font-semibold text-blue-600 tracking-wide uppercase mb-2">Layanan Kami</h2>
                    <h3 class="text-3xl font-extrabold text-gray-900 sm:text-4xl mb-6">Konsultasi Statistik</h3>
                    <p class="text-lg text-gray-600 leading-relaxed text-justify">
                        Jika <span class="font-bold text-blue-600">#SahabatData</span> memiliki pertanyaan seputar data BPS Kabupaten Batang Hari, silakan disampaikan melalui chat Whatsapp ini, operator kami siap membantu. Layanan kami buka setiap hari kerja, Senin s/d Jumat pukul 08.00-15.30 WIB.
                    </p>
                </div>

                <!-- Right: Form -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <form id="waForm" class="space-y-6">
                        <div>
                            <label for="nama" class="sr-only">Nama</label>
                            <input type="text" id="nama" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 px-4 py-3" placeholder="Masukan Nama">
                        </div>
                        <div>
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" id="email" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 px-4 py-3" placeholder="Masukan Email">
                        </div>
                        <div>
                            <label for="pesan" class="sr-only">Pesan</label>
                            <textarea id="pesan" rows="4" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 px-4 py-3" placeholder="Tuliskan Pesan"></textarea>
                        </div>
                        <div>
                            <button type="submit" style="background-color: #16a34a; color: white;" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                Kirim Pesan dengan WhatsApp
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.getElementById('waForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const nama = document.getElementById('nama').value;
            const email = document.getElementById('email').value;
            const pesan = document.getElementById('pesan').value;
            
            if (!nama || !email || !pesan) {
                alert('Mohon lengkapi semua field');
                return;
            }
            
            const text = `Halo BPS Batanghari,%0A%0ANama: ${nama}%0AEmail: ${email}%0A%0APesan:%0A${pesan}`;
            // Replace with actual BPS Batanghari WhatsApp number
            const phoneNumber = '6281373850795'; 
            
            window.open(`https://wa.me/${phoneNumber}?text=${text}`, '_blank');
        });
    </script>
    
    <!-- Footer -->
    <!-- Footer -->
    <!-- Footer -->
    <footer style="background-color: #003B6F; color: white;">
        <!-- Colored Border Line -->
        <div class="flex h-2 w-full">
            <div class="flex-1" style="background-color: #0099FF;"></div>
            <div class="flex-1" style="background-color: #33CC33;"></div>
            <div class="flex-1" style="background-color: #FF9900;"></div>
        </div>
            <div class="flex flex-col md:flex-row justify-between items-start gap-8">
                <!-- Left Content -->
                <div class="space-y-4">
                    <!-- Header -->
                    <div class="flex items-center mt-2">
                         <!-- BPS Logo -->
                         <img class="h-16 w-auto" src="{{ asset('images/bps-logo-footer.png') }}" alt="Badan Pusat Statistik Kabupaten Batanghari">
                    </div>

                    <!-- Address & Contact -->
                    <div class="space-y-1 text-base font-normal">
                        <p>Jl. Jenderal Sudirman Muara Bulian - Jambi, Indonesia, 36613</p>
                        <p>Telp : (0743) 21008 <span class="mx-1">Fax : (0743) 21008</span> Email : bps1504@bps.go.id</p>
                    </div>
                </div>

                <!-- Right Content: BerAKHLAK Logo -->
                <div class="flex-shrink-0">
                    <img class="h-14 w-auto" src="{{ asset('images/berakhlak-logo-new.png') }}" alt="BerAKHLAK">
                </div>
            </div>
    </footer>
</body>
</html>
