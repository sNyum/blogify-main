@extends('layouts.evaluasi')

@section('content')
<div class="p-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-xl font-bold text-[#1A237E]">Daftar Nilai IPS Instansi/Dinas/Lembaga</h2>
            <p class="text-sm text-gray-500">Monitoring Progress Penilaian</p>
        </div>
        <div class="text-sm text-gray-400">
             Dashboard / Tabel
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Sukses!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        
        <div class="p-6">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-blue-100 text-[#1A237E] font-bold text-center border border-blue-200">
                        <th rowspan="2" class="px-4 py-3 bg-blue-50 border border-blue-200">No</th>
                        <th rowspan="2" class="px-4 py-3 bg-blue-50 border border-blue-200">Kode</th>
                        <th rowspan="2" class="px-4 py-3 bg-blue-50 border border-blue-200 text-left w-1/3">Nama</th>
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
                    @forelse($instansis as $index => $inst)
                    <tr class="hover:bg-blue-50 transition border-b border-gray-100 cursor-pointer" onclick="window.location='{{ route('evaluasi.instansi.detail', $inst->id) }}'">
                        <td class="px-4 py-3 text-center border-r">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 text-center border-r">{{ $inst->id + 30 }}</td>
                        <td class="px-4 py-3 font-medium text-[#1A237E] uppercase border-r">{{ $inst->organization }}</td>
                        <td class="px-4 py-3 text-center border-r">{{ number_format($inst->progress_pm, 2) }}%</td>
                        <td class="px-4 py-3 text-center border-r">{{ number_format($inst->progress_pb, 2) }}%</td>
                        <td class="px-4 py-3 text-center border-r">{{ number_format($inst->hasil_pm, 2) }}</td>
                        <td class="px-4 py-3 text-center border-r">{{ number_format($inst->hasil_pb, 2) }}</td>
                        <td class="px-4 py-3 text-center">
                            <span class="px-2 py-1 text-xs font-bold text-white rounded 
                                {{ $inst->predikat == 'Baik' ? 'bg-green-500' : 'bg-red-500' }}">
                                {{ $inst->predikat }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-4 py-6 text-center text-gray-500">Belum ada data nilai.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
