<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pendaftaran Pembinaan - BPS Kabupaten Batanghari</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-2xl">
        <!-- Card -->
        <div class="bg-[#FFF5E6] rounded-lg shadow-lg p-8">
            <!-- Logo/Header -->
            <div class="text-center mb-6">
                <img src="{{ asset('images/bistik-kaldu-logo.png') }}" alt="BISTIK KALDU" class="h-16 w-auto mx-auto mb-4">
                <h1 class="text-2xl font-bold text-gray-800">Pendaftaran Pembinaan Statistik Sektoral</h1>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Registration Form -->
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf

                <!-- Nama Instansi/OPD -->
                <div class="mb-4">
                    <label for="organization" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Instansi/OPD (Gunakan Kapital Tanpa Dingbat)*
                    </label>
                    <input type="text" id="organization" name="organization" value="{{ old('organization') }}" required
                           placeholder="CONTOH: DINAS PENDIDIKAN KOTA BATANGHARI"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition uppercase">
                </div>

                <!-- Surat Permohonan Pembinaan -->
                <div class="mb-4">
                    <label for="surat_permohonan" class="block text-sm font-medium text-gray-700 mb-2">
                        Surat Permohonan Pembinaan (Format PDF)*
                    </label>
                    <div class="mb-2">
                        <a href="{{ route('pendaftaran.download-template') }}" 
                           class="inline-flex items-center px-4 py-2 bg-secondary text-white text-sm font-medium rounded hover:bg-secondary-hover transition">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Download Format Surat
                        </a>
                    </div>
                    <input type="file" id="surat_permohonan" name="surat_permohonan" accept=".pdf" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition">
                    <p class="text-xs text-gray-500 mt-1">Format: PDF, Maksimal 2MB</p>
                </div>

                <!-- Nama PIC -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama PIC Instansi/OPD*
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition">
                </div>

                <!-- Email (hidden but required for login) -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email PIC*
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                           placeholder="contoh@email.com"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#F15A24] focus:border-transparent transition">
                    <p class="text-xs text-gray-500 mt-1">Email akan digunakan untuk login</p>
                </div>

                <!-- Nomor WA PIC -->
                <div class="mb-6">
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                        Nomor WA PIC Instansi/OPD (Contoh: 628xxxxx)*
                    </label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required
                           placeholder="628123456789"
                           pattern="[0-9]{10,15}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition">
                    <p class="text-xs text-gray-500 mt-1">Gunakan format 628xxx (tanpa +)</p>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                        class="w-full bg-primary text-white font-semibold py-3 rounded-lg hover:bg-primary-hover transition duration-300 shadow-lg">
                    Kirim Pendaftaran
                </button>
            </form>

            <!-- Login Link -->
            <div class="mt-6 text-center">
                <p class="text-gray-600 text-sm">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="text-primary hover:text-primary-hover font-semibold">Login di sini</a>
                </p>
            </div>

            <!-- Back to Home -->
            <div class="mt-4 text-center">
                <a href="{{ route('pendaftaran.index') }}" class="text-gray-500 hover:text-gray-700 text-sm">
                    ← Lihat Data Pendaftar
                </a>
            </div>
        </div>
    </div>
</body>
</html>
