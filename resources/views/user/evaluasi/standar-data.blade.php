@extends('layouts.evaluasi')

@section('content')

    <div class="p-8">
        
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-xl font-bold text-[#1A237E]">Indikator 101 Standar Data Statistik</h2>
                <p class="text-sm text-gray-500 uppercase">{{ $user->organization ?? 'DINAS TERKAIT' }}</p>
            </div>
            <div class="text-sm text-gray-400">
                <a href="{{ route('evaluasi.dashboard') }}" class="hover:text-[#E65100]">Dashboard</a> / <span class="text-gray-600">Tabel</span>
            </div>
        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-lg shadow-sm border border-orange-100 overflow-hidden mb-6">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-orange-400 text-white font-bold">
                        <tr>
                            <th class="px-4 py-3 border-r border-orange-300">Kode</th>
                            <th class="px-4 py-3 border-r border-orange-300 w-1/3">Nama Indikator</th>
                            <th class="px-4 py-3 text-center border-r border-orange-300">Bobot</th>
                            <th class="px-4 py-3 text-center border-r border-orange-300">Nilai PM</th>
                            <th class="px-4 py-3 text-center border-r border-orange-300">Nilai PB</th>
                            <th class="px-4 py-3 text-center border-r border-orange-300">Penjelasan</th>
                            <th class="px-4 py-3 text-center border-r border-orange-300">Bukti Dukung</th>
                            <th class="px-4 py-3 text-center border-r border-orange-300">Proses</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr class="hover:bg-orange-50 transition">
                            <td class="px-4 py-3 font-medium text-gray-900 border-r border-gray-100">{{ $indikator['kode'] }}</td>
                            <td class="px-4 py-3 text-gray-800 border-r border-gray-100">{{ $indikator['nama'] }}</td>
                            <td class="px-4 py-3 text-center text-gray-600 border-r border-gray-100">{{ $indikator['bobot'] }}</td>
                            <td class="px-4 py-3 text-center text-gray-600 border-r border-gray-100">{{ $indikator['nilai_pm'] }}</td>
                            <td class="px-4 py-3 text-center text-gray-600 border-r border-gray-100">{{ $indikator['nilai_pb'] }}</td>
                            <td class="px-4 py-3 text-center border-r border-gray-100">
                                <a href="#" class="text-blue-500 hover:underline">Cek</a>
                            </td>
                            <td class="px-4 py-3 text-center border-r border-gray-100">
                                <a href="#" class="text-blue-500 hover:underline">Lihat</a>
                            </td>
                            <td class="px-4 py-3 text-center text-gray-600 border-r border-gray-100">{{ $indikator['proses'] }}</td>
                            <td class="px-4 py-3 text-center">
                                <a href="{{ route('evaluasi.pm.edit') }}" class="font-bold text-blue-600 hover:text-blue-800 mr-2">PM</a>
                                @if(isset($isOperator) && $isOperator)
                                    <a href="{{ route('evaluasi.pb.edit') }}" class="font-bold text-green-600 hover:text-green-800">PB</a>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Penjelasan Panel -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h3 class="font-bold text-[#1A237E] mb-4 border-b border-gray-100 pb-2">Penjelasan</h3>
            <p class="text-gray-600 text-sm leading-relaxed">
                Standar Data Statistik merujuk pada regulasi SDSN (indah.bps.go.id) atau ketetapan menteri/kepala instansi pusat. Pelaksanaan dan pengelolaan standar data statistik mengacu pada Peraturan BPS No 4/2020 tentang Petunjuk Teknis Standar Data Statistik.
            </p>
        </div>

    </div>

    @if(session('success'))
        <script>
            alert('{{ session('success') }}');
        </script>
    @endif
@endsection
