@extends('layouts.evaluasi')

@section('content')
<div class="p-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-xl font-bold text-[#1A237E]">Daftar Nilai IPS Instansi/Dinas/Lembaga</h2>
            <p class="text-sm font-bold text-gray-700 uppercase">{{ $instansi->id + 30 }} {{ $instansi->organization }}</p>
            <p class="text-xs text-blue-500 font-bold mt-1">1 Prinsip SDI</p>
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
                    @foreach($domains as $d)
                    <!-- Domain Row -->
                    <tr class="hover:bg-blue-50 transition border-b border-gray-100 cursor-pointer" 
                        onclick="window.location='{{ route('evaluasi.instansi.detail.domain', ['id' => $instansi->id, 'domain_id' => $d['id']]) }}'">
                        <td class="px-4 py-3 text-center border-r">{{ $d['id'] }}</td>
                        <td class="px-4 py-3 text-[#1A237E] font-medium border-r">
                            {{ $d['name'] }}
                        </td>
                        <td class="px-4 py-3 text-center border-r">{{ number_format($d['progress_pm'], 2) }}%</td>
                        <td class="px-4 py-3 text-center border-r">{{ number_format($d['progress_pb'], 2) }}%</td>
                        <td class="px-4 py-3 text-center border-r">{{ number_format($d['hasil_pm'], 2) }}</td>
                        <td class="px-4 py-3 text-center border-r">{{ number_format($d['hasil_pb'], 2) }}</td>
                         <td class="px-4 py-3 text-center">
                            <span class="px-2 py-1 text-xs font-bold text-white rounded 
                                {{ $d['predikat'] == 'Baik' ? 'bg-green-500' : 'bg-red-500' }}">
                                {{ $d['predikat'] }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
