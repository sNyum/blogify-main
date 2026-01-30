<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Jenis Login - BISTIK KALDU</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#F15A24', // Orange BPS
                        secondary: '#005596', // Blue BPS
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-black/50 min-h-screen flex items-center justify-center p-4 backdrop-blur-sm relative">
    
    <!-- Background Image (Optional) -->
    <div class="absolute inset-0 -z-10 bg-gradient-to-br from-gray-900 to-gray-800"></div>

    <!-- Main Card -->
    <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md mx-auto transform transition-all scale-100">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Pilih Jenis Login</h3>
            <p class="text-gray-600">Silakan pilih akses Anda</p>
        </div>

        <!-- Buttons Stack -->
        <div class="space-y-3">
            
            <!-- Login Admin (Blue) -->
            <a href="/admin/login" class="group block w-full p-5 bg-gradient-to-r from-secondary to-blue-800 hover:from-blue-700 hover:to-blue-900 rounded-xl transition-all duration-300 shadow-lg text-white">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <div class="text-left">
                        <h4 class="font-bold text-base">Login Admin</h4>
                        <p class="text-xs text-blue-200">Panel Administrasi BPS</p>
                    </div>
                </div>
            </a>
            
            <!-- Login Pengguna BPS (Green) -->
            <a href="/bps/login" class="group block w-full p-5 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 rounded-xl transition-all duration-300 shadow-lg text-white">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="text-left">
                        <h4 class="font-bold text-base">Login Pengguna BPS</h4>
                        <p class="text-xs text-green-200">Pegawai BPS Internal</p>
                    </div>
                </div>
            </a>
            
            <!-- Login User (Orange) -->
            <a href="/login" class="group block w-full p-5 bg-gradient-to-r from-primary to-orange-600 hover:from-orange-600 hover:to-primary rounded-xl transition-all duration-300 shadow-lg text-white">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div class="text-left">
                        <h4 class="font-bold text-base">Login User</h4>
                        <p class="text-xs text-orange-200">Akses Layanan Agency/OPD</p>
                    </div>
                </div>
            </a>

        </div>

    </div>

</body>
</html>
