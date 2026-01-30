<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Evaluasi EPSS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-[#FFF8E1] h-screen flex flex-col font-sans">

    <!-- Header Dummy (Visual Only to match image roughly) -->
    <div class="bg-[#E65100] px-8 py-4 flex justify-between items-center text-white shadow-md">
        <div class="flex items-center gap-3">
             <img class="h-12 w-auto" src="{{ asset('images/bistik-kaldu-logo.png') }}" alt="BISTIK KALDU">
        </div>
        <div class="hidden md:flex space-x-6 text-sm font-semibold">
            <span class="opacity-80">Pendaftaran</span>
            <span class="opacity-80">Pembinaan</span>
            <span class="opacity-80">Jadwal</span>
            <span class="font-bold border-b-2 border-white">Evaluasi</span>
            <span class="opacity-80">Data Sektoral</span>
            <span class="opacity-80">Panduan</span>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex items-center justify-center p-6">
        
        <div class="bg-white rounded-2xl shadow-2xl p-10 w-full max-w-md text-center transform hover:scale-105 transition duration-300">
            <div class="flex justify-center mb-8">
                <img src="{{ asset('images/bistik-kaldu-logo.png') }}" alt="BISTIK KALDU" class="h-32 w-auto drop-shadow-lg">
            </div>

            @if(session('error'))
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm font-bold">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('evaluasi.authenticate') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                     <input type="text" name="username" placeholder="username" required 
                           class="w-full bg-gray-50 border border-gray-200 text-gray-800 text-center text-sm rounded-lg focus:ring-[#E65100] focus:border-[#E65100] block w-full p-3 placeholder-gray-400">
                </div>
                <div>
                    <input type="password" name="password" placeholder="password" required 
                           class="w-full bg-gray-50 border border-gray-200 text-gray-800 text-center text-sm rounded-lg focus:ring-[#E65100] focus:border-[#E65100] block w-full p-3 placeholder-gray-400">
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full text-white bg-[#E65100] hover:bg-[#BF360C] focus:ring-4 focus:ring-orange-300 font-bold rounded-lg text-sm px-5 py-3 shadow-lg transition-transform transform hover:-translate-y-1">
                        LOG IN
                    </button>
                </div>
            </form>
        </div>

    </div>

    <footer class="bg-[#E65100] text-white text-center py-3 text-xs font-medium">
        &copy; 2025 BPS Kabupaten Batang Hari
    </footer>

</body>
</html>
