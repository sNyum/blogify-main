@extends('layouts.evaluasi')

@section('content')
    <div class="p-8">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-xl font-bold text-[#1A237E]">Daftar Nilai IPS Instansi/Dinas/Lembaga</h2>
                <p class="text-sm font-bold text-[#1A237E] mt-1">{{ rand(10,99) }} {{ $user->organization ?? 'DINAS TERKAIT' }}</p>
            </div>
            <div class="text-sm text-gray-400">
                <a href="{{ route('evaluasi.dashboard') }}" class="hover:text-[#E65100]">Dashboard</a> / <span class="text-gray-600">Tabel</span>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md border border-gray-300 overflow-hidden mb-6">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left border-collapse">
                    <thead class="bg-[#C5CAE9] text-[#1A237E] font-bold border-b-2 border-[#9FA8DA]">
                        <tr>
                            <th rowspan="2" class="px-4 py-3 border-r border-[#9FA8DA] text-center w-24">Indikator</th>
                            <th rowspan="2" class="px-4 py-3 border-r border-[#9FA8DA] text-center">Nama Indikator</th>
                            <th colspan="2" class="px-4 py-2 border-r border-[#9FA8DA] border-b border-[#9FA8DA] text-center">Progress</th>
                            <th colspan="2" class="px-4 py-2 border-r border-[#9FA8DA] border-b border-[#9FA8DA] text-center">Hasil</th>
                            <th rowspan="2" class="px-4 py-3 text-center w-24">Predikat</th>
                        </tr>
                        <tr>
                            <th class="px-4 py-2 border-r border-[#9FA8DA] text-center">PM</th>
                            <th class="px-4 py-2 border-r border-[#9FA8DA] text-center">PB</th>
                            <th class="px-4 py-2 border-r border-[#9FA8DA] text-center">PM</th>
                            <th class="px-4 py-2 border-r border-[#9FA8DA] text-center">PB</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($indikatorList as $item)
                        <tr class="hover:bg-indigo-50 transition">
                            <td class="px-4 py-3 text-center font-medium text-gray-700 border-r border-gray-200">{{ $item['kode'] }}</td>
                            <td class="px-4 py-3 text-gray-800 border-r border-gray-200">{{ $item['nama'] }}</td>
                            <td class="px-4 py-3 text-center text-gray-500 border-r border-gray-200">{{ number_format($item['progress_pm'], 2) }}%</td>
                            <td class="px-4 py-3 text-center text-gray-500 border-r border-gray-200">{{ number_format($item['progress_pb'], 2) }}%</td>
                            <td class="px-4 py-3 text-center text-gray-600 border-r border-gray-200">{{ number_format($item['hasil_pm'], 2) }}</td>
                            <td class="px-4 py-3 text-center text-gray-600 border-r border-gray-200">{{ number_format($item['hasil_pb'], 2) }}</td>
                            <td class="px-4 py-3 text-center">
                                @if($item['predikat'] == 'Baik')
                                    <span class="bg-green-600 text-white text-xs font-bold px-3 py-1 rounded">Baik</span>
                                @else
                                    <span class="bg-red-600 text-white text-xs font-bold px-3 py-1 rounded">Kurang</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
