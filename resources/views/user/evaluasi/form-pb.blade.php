@extends('layouts.evaluasi')

@section('content')

    <div class="p-8">
        
        <div class="mb-6">
            <h2 class="text-xl font-bold text-[#1A237E]">Indikator 10101 Tingkat Kematangan Penerapan Standar Data Statistik (SDS)</h2>
            <p class="text-sm text-gray-500 uppercase">{{ $user->organization ?? 'DINAS TERKAIT' }}</p>
             <div class="text-xs text-gray-400 mt-2 text-right">
                <a href="{{ route('evaluasi.dashboard') }}" class="hover:text-[#E65100]">Dashboard</a> / <span>PB</span>
            </div>
        </div>

        <form action="{{ route('evaluasi.pb.update') }}" method="POST">
            @csrf
            
            <!-- Info PM (Read Only) -->
            <div class="bg-blue-50 border border-blue-200 p-4 rounded-lg mb-6 shadow-sm">
                <h4 class="font-bold text-blue-800 text-sm mb-2">Hasil Penilaian Mandiri (PM)</h4>
                <div class="flex flex-col gap-2">
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-semibold text-gray-600">Nilai:</span>
                        <span class="text-xl font-bold text-blue-600">{{ $score->score_pm ?? '-' }}</span>
                    </div>
                    <div>
                         <span class="text-xs font-semibold text-gray-600">Catatan:</span>
                         <p class="text-sm text-gray-700 bg-white p-2 rounded border border-blue-100 italic">"{{ $score->notes ?? 'Tidak ada catatan' }}"</p>
                    </div>
                    @if(isset($score->evidence_link))
                    <div>
                         <span class="text-xs font-semibold text-gray-600">Bukti Dukung:</span>
                         <a href="{{ $score->evidence_link }}" target="_blank" class="text-sm text-blue-500 underline block break-all hover:text-blue-700">{{ $score->evidence_link }}</a>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Card PB -->
            <div class="bg-white rounded-lg shadow-sm border border-green-100 p-6 mb-6">
                <h3 class="font-bold text-[#1A237E] mb-4">Verifikasi Hasil Penilaian Indikator</h3>
                <div class="space-y-3">
                    @php $val = $score->score_pb ?? 0; @endphp
                    
                    <label class="flex items-start gap-3 cursor-pointer">
                        <input type="radio" name="score_pb" value="1" {{ $val == 1 ? 'checked' : '' }} class="mt-1 text-green-600 focus:ring-green-600">
                        <span class="text-gray-700 text-sm">1. Penerapan SDS belum dilakukan oleh seluruh Produsen Data</span>
                    </label>
                    <label class="flex items-start gap-3 cursor-pointer">
                        <input type="radio" name="score_pb" value="2" {{ $val == 2 ? 'checked' : '' }} class="mt-1 text-green-600 focus:ring-green-600">
                        <span class="text-gray-700 text-sm">2. Penerapan SDS telah dilakukan oleh setiap Produsen Data sesuai standarnya masing-masing</span>
                    </label>
                    <label class="flex items-start gap-3 cursor-pointer">
                        <input type="radio" name="score_pb" value="3" {{ $val == 3 ? 'checked' : '' }} class="mt-1 text-green-600 focus:ring-green-600">
                        <span class="text-gray-700 text-sm">3. Penerapan SDS telah dilakukan berdasarkan kaidah yang ditetapkan dan berlaku untuk seluruh Produsen Data</span>
                    </label>
                    <label class="flex items-start gap-3 cursor-pointer">
                        <input type="radio" name="score_pb" value="4" {{ $val == 4 ? 'checked' : '' }} class="mt-1 text-green-600 focus:ring-green-600">
                        <span class="text-gray-700 text-sm">4. Penerapan SDS telah dilakukan reviu dan evaluasi secara berkala</span>
                    </label>
                    <label class="flex items-start gap-3 cursor-pointer">
                        <input type="radio" name="score_pb" value="5" {{ $val == 5 ? 'checked' : '' }} class="mt-1 text-green-600 focus:ring-green-600">
                        <span class="text-gray-700 text-sm">5. Penerapan SDS telah dilakukan pemutakhiran oleh Produsen Data bersama Walidata dalam rangka peningkatan kualitas</span>
                    </label>
                </div>
                @error('score_pb')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nilai Pemeriksaan -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 mb-6">
                <h4 class="font-bold text-[#1A237E] mb-3">Nilai Pemeriksaan</h4>
                <select name="nilai_pemeriksaan" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="">-- Pilih Nilai --</option>
                    <option value="1" {{ ($score->nilai_pemeriksaan ?? '') == '1' ? 'selected' : '' }}>1</option>
                    <option value="2" {{ ($score->nilai_pemeriksaan ?? '') == '2' ? 'selected' : '' }}>2</option>
                    <option value="3" {{ ($score->nilai_pemeriksaan ?? '') == '3' ? 'selected' : '' }}>3</option>
                    <option value="4" {{ ($score->nilai_pemeriksaan ?? '') == '4' ? 'selected' : '' }}>4</option>
                    <option value="5" {{ ($score->nilai_pemeriksaan ?? '') == '5' ? 'selected' : '' }}>5</option>
                </select>
                @error('nilai_pemeriksaan')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Catatan Penilaian Data -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 mb-6">
                <h4 class="font-bold text-[#1A237E] mb-3">Catatan Penilaian Data</h4>
                <textarea name="catatan_pb" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Masukkan catatan penilaian...">{{ $score->catatan_pb ?? '' }}</textarea>
                @error('catatan_pb')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Lihat Bukti Dukung -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 mb-6">
                <h4 class="font-bold text-[#1A237E] mb-3">Lihat Bukti Dukung</h4>
                <div class="flex gap-3">
                    @if(isset($score->evidence_link) && $score->evidence_link)
                        <a href="{{ $score->evidence_link }}" target="_blank" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded shadow-sm text-sm transition">
                            TAMPILKAN
                        </a>
                        <a href="{{ $score->evidence_link }}" download class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded shadow-sm text-sm transition">
                            UNDUH
                        </a>
                    @else
                        <p class="text-gray-500 text-sm italic">Tidak ada bukti dukung yang tersedia</p>
                    @endif
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex gap-4">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded shadow-sm text-sm transition">
                    SIMPAN NILAI PB
                </button>
                <a href="{{ route('evaluasi.sdi.standar-data') }}" class="bg-white border border-red-500 text-red-500 hover:bg-red-50 font-bold py-2 px-6 rounded shadow-sm text-sm transition text-center">
                    BATAL
                </a>
            </div>

        </form>

    </div>
@endsection
