@extends('layouts.evaluasi')

@section('content')

    <div class="p-8">
        
        <div class="mb-6">
            <h2 class="text-xl font-bold text-[#1A237E]">Indikator 10101 Tingkat Kematangan Penerapan Standar Data Statistik (SDS)</h2>
            <p class="text-sm text-gray-500 uppercase">{{ $user->organization ?? 'DINAS TERKAIT' }}</p>
             <div class="text-xs text-gray-400 mt-2 text-right">
                <a href="{{ route('evaluasi.dashboard') }}" class="hover:text-[#E65100]">Dashboard</a> / <span>Radio</span>
            </div>
        </div>

        <form action="{{ route('evaluasi.pm.update') }}" method="POST">
            @csrf
            
            <!-- Card 1: Penilaian Mandiri -->
            <div class="bg-white rounded-lg shadow-sm border border-orange-100 p-6 mb-6">
                <h3 class="font-bold text-[#1A237E] mb-4">Penilaian Indikator secara Mandiri</h3>
                <div class="space-y-3">
                    @php $val = $score->score_pm ?? 0; @endphp
                    
                    <label class="flex items-start gap-3 cursor-pointer">
                        <input type="radio" name="score_pm" value="1" {{ $val == 1 ? 'checked' : '' }} class="mt-1 text-[#E65100] focus:ring-[#E65100]">
                        <span class="text-gray-700 text-sm">1. Penerapan SDS belum dilakukan oleh seluruh Produsen Data</span>
                    </label>
                    <label class="flex items-start gap-3 cursor-pointer">
                        <input type="radio" name="score_pm" value="2" {{ $val == 2 ? 'checked' : '' }} class="mt-1 text-[#E65100] focus:ring-[#E65100]">
                        <span class="text-gray-700 text-sm">2. Penerapan SDS telah dilakukan oleh setiap Produsen Data sesuai standarnya masing-masing</span>
                    </label>
                    <label class="flex items-start gap-3 cursor-pointer">
                        <input type="radio" name="score_pm" value="3" {{ $val == 3 ? 'checked' : '' }} class="mt-1 text-[#E65100] focus:ring-[#E65100]">
                        <span class="text-gray-700 text-sm">3. Penerapan SDS telah dilakukan berdasarkan kaidah yang ditetapkan dan berlaku untuk seluruh Produsen Data</span>
                    </label>
                    <label class="flex items-start gap-3 cursor-pointer">
                        <input type="radio" name="score_pm" value="4" {{ $val == 4 ? 'checked' : '' }} class="mt-1 text-[#E65100] focus:ring-[#E65100]">
                        <span class="text-gray-700 text-sm">4. Penerapan SDS telah dilakukan reviu dan evaluasi secara berkala</span>
                    </label>
                    <label class="flex items-start gap-3 cursor-pointer">
                        <input type="radio" name="score_pm" value="5" {{ $val == 5 ? 'checked' : '' }} class="mt-1 text-[#E65100] focus:ring-[#E65100]">
                        <span class="text-gray-700 text-sm">5. Penerapan SDS telah dilakukan pemutakhiran oleh Produsen Data bersama Walidata dalam rangka peningkatan kualitas</span>
                    </label>
                </div>
            </div>

            <!-- Card 2: Catatan -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <h3 class="font-bold text-gray-700 mb-2 text-sm">Catatan Produsen Data</h3>
                <textarea name="notes" rows="3" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#E65100] focus:ring-[#E65100] text-sm" placeholder="Contoh: Baik">{{ old('notes', $score->notes ?? '') }}</textarea>
            </div>

            <!-- Card 3: Bukti Dukung -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <h3 class="font-bold text-gray-700 mb-2 text-sm">Copy Paste Link Bukti Dukung (share folder)</h3>
                <input type="url" name="evidence_link" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#E65100] focus:ring-[#E65100] text-sm mb-4 text-blue-600" placeholder="https://drive.google.com/..." value="{{ old('evidence_link', $score->evidence_link ?? '') }}">
                
                <p class="text-xs text-gray-500 leading-relaxed italic">
                    Kami selaku produsen data menyatakan bahwa jawaban dan bukti dukung yang dilampirkan sesuai dengan kenyataan sebenarnya. Bila kemudian hari ditemukan ketidaksesuaian dengan bukti dukung yang ada, maka kami siap menerima keputusan pembatalan penilaian
                </p>
            </div>

            <!-- Buttons -->
            <div class="flex gap-4">
                <button type="submit" class="bg-white border border-green-500 text-green-500 hover:bg-green-50 font-bold py-2 px-6 rounded shadow-sm text-sm transition">
                    SIMPAN
                </button>
                <a href="{{ route('evaluasi.sdi.standar-data') }}" class="bg-white border border-red-500 text-red-500 hover:bg-red-50 font-bold py-2 px-6 rounded shadow-sm text-sm transition text-center">
                    BATAL
                </a>
            </div>

        </form>

    </div>
@endsection
