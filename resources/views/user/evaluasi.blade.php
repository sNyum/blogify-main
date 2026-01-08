@extends('layouts.dashboard')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Evaluasi Mandiri EPSS</h1>
        <p class="text-gray-600">Lakukan penilaian mandiri terhadap penyelenggaraan statistik sektoral di instansi Anda.</p>
    </div>

    <!-- Info Card -->
    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-8">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm text-blue-700">
                    Silakan isi formulir penilaian mandiri di bawah ini sesuai dengan kondisi riil. Sertakan tautan bukti dukung untuk mempermudah verifikasi.
                </p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
            <h2 class="font-bold text-gray-800">Formulir Penilaian Mandiri</h2>
            <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded">Status: Draft</span>
        </div>
        
        <form class="p-6 space-y-8">
            <!-- Indicator Section -->
            <div class="space-y-6">
                <div class="pb-6 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Indikator 1: Prinsip Satu Data Indonesia</h3>
                    <p class="text-gray-600 text-sm mb-4">Sejauh mana instansi telah menerapkan prinsip SDI dalam penyelenggaraan statistik?</p>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                             <label class="block text-sm font-medium text-gray-700 mb-2">Tingkat Kematangan</label>
                             <select class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                                <option value="" disabled selected>Pilih Level...</option>
                                @foreach($maturityLevels as $level)
                                    <option value="{{ $level['level'] }}">Level {{ $level['level'] }} - {{ $level['desc'] }}</option>
                                @endforeach
                             </select>
                             <p class="mt-1 text-xs text-gray-500">Pilih level yang paling menggambarkan kondisi saat ini.</p>
                        </div>
                        <div>
                             <label class="block text-sm font-medium text-gray-700 mb-2">Tautan Bukti Dukung</label>
                             <input type="url" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary" placeholder="https://drive.google.com/...">
                             <p class="mt-1 text-xs text-gray-500">Link Google Drive/Cloud berisi dokumen pendukung.</p>
                        </div>
                    </div>
                     <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Catatan / Penjelasan</label>
                        <textarea rows="3" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary" placeholder="Jelaskan kondisi implementasi..."></textarea>
                    </div>
                </div>

                <!-- Repeatable Block Mockup -->
                <div class="pb-6 border-b border-gray-100 opacity-50">
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Indikator 2: Kualitas Data</h3>
                    <p class="text-gray-600 text-sm mb-4">Penerapan standar dan metadata dalam data yang dihasilkan.</p>
                     <p class="text-sm text-gray-400 italic">(Formulir indikator selanjutnya...)</p>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4">
                <button type="button" class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50">Simpan Draft</button>
                <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg font-bold hover:bg-orange-600 shadow-lg shadow-orange-500/30">Kirim Penilaian</button>
            </div>
        </form>
    </div>
@endsection
