@extends('layouts.evaluasi')

@section('content')
<div class="p-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-xl font-bold text-[#1A237E]">Daftar Nilai IPS Instansi/Dinas/Lembaga</h2>
            <p class="text-sm font-bold text-gray-700 uppercase">{{ $instansi->id + 30 }} {{ $instansi->organization }}</p>
            <p class="text-xs text-black font-bold mt-1">{{ $domain_id }} {{ $domainName }}</p>
            <p class="text-xs text-black font-bold mt-1">{{ $aspek['kode'] }} {{ $aspek['nama'] }}</p>
        </div>
        <div class="text-sm text-gray-400">
             Dashboard / Tabel
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        
        <div class="p-6">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-blue-100 text-[#1A237E] font-bold text-center border border-blue-200">
                        <th rowspan="2" class="px-4 py-3 bg-blue-50 border border-blue-200">Indikator</th>
                        <th rowspan="2" class="px-4 py-3 bg-blue-50 border border-blue-200 text-left w-1/2">Nama Indikator</th>
                        <th colspan="2" class="px-4 py-2 border border-blue-200 bg-blue-200 text-blue-900">Progress</th>
                        <th colspan="2" class="px-4 py-2 border border-blue-200 bg-blue-200 text-blue-900">Hasil</th>
                        <th rowspan="2" class="px-4 py-3 bg-blue-50 border border-blue-200">Predikat</th>
                    </tr>
                    <tr class="bg-blue-50 text-center text-xs">
                         <th class="px-4 py-2 border border-blue-200">PM</th>
                         <th class="px-4 py-2 border border-blue-200">PB</th>
                         <th class="px-4 py-2 border border-blue-200">PM</th>
                         <th class="px-4 py-2 border border-blue-200">PB</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <!-- Aspect Row -->
                    <tr class="hover:bg-blue-50 transition border-b border-gray-100">
                        <td class="px-4 py-3 text-center border-r">{{ $aspek['kode'] }}</td>
                        <td class="px-4 py-3 text-[#1A237E] font-medium border-r">
                            {{ $aspek['nama'] }}
                        </td>
                        <td class="px-4 py-3 text-center border-r">{{ number_format($aspek['progress_pm'], 2) }}%</td>
                        <td class="px-4 py-3 text-center border-r">{{ number_format($aspek['progress_pb'], 2) }}%</td>
                        <td class="px-4 py-3 text-center border-r">{{ number_format($aspek['hasil_pm'], 2) }}</td>
                        <td class="px-4 py-3 text-center border-r">{{ number_format($aspek['hasil_pb'], 2) }}</td>
                         <td class="px-4 py-3 text-center">
                            <span class="px-2 py-1 text-xs font-bold text-white rounded 
                                {{ $aspek['predikat'] == 'Baik' ? 'bg-green-500' : 'bg-red-500' }}">
                                {{ $aspek['predikat'] }}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
