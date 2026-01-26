@extends('layouts.evaluasi')

@section('content')

    <div class="p-8">
        
        <h2 class="text-xl font-bold text-[#1A237E] mb-8">Penilaian Pembinaan Statistik Sektoral Terpadu Kabupaten Batang Hari</h2>

        <!-- Status Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- Card 1 -->
            <div class="bg-white p-4 rounded-xl shadow-sm flex items-center gap-4 border border-blue-100">
                <div class="bg-indigo-100 p-3 rounded-lg text-indigo-600">
                     <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-bold">Instansi Terdaftar</p>
                    <h3 class="text-lg font-bold text-gray-800">2</h3>
                </div>
            </div>
             <!-- Card 2 -->
             <div class="bg-white p-4 rounded-xl shadow-sm flex items-center gap-4 border border-blue-100">
                <div class="bg-blue-100 p-3 rounded-lg text-blue-500">
                     <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-bold">Penilaian Mandiri</p>
                    <h3 class="text-lg font-bold text-gray-800">2</h3>
                </div>
            </div>
             <!-- Card 3 -->
             <div class="bg-white p-4 rounded-xl shadow-sm flex items-center gap-4 border border-blue-100">
                <div class="bg-emerald-100 p-3 rounded-lg text-emerald-500">
                     <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-bold">Dinilai</p>
                    <h3 class="text-lg font-bold text-gray-800">1</h3>
                </div>
            </div>
             <!-- Card 4 -->
             <div class="bg-white p-4 rounded-xl shadow-sm flex items-center gap-4 border border-blue-100">
                <div class="bg-red-100 p-3 rounded-lg text-red-500">
                     <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" /></svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-bold">Final</p>
                    <h3 class="text-lg font-bold text-gray-800">0</h3>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            
            <!-- Main Chart Area -->
            <div class="lg:col-span-3 bg-white p-6 rounded-xl shadow-sm border border-blue-50">
                <div class="mb-4">
                    <h3 class="text-[#1A237E] font-bold text-lg">Hasil Penilaian Mandiri dan Penilaian Badan</h3>
                    <p class="text-gray-500 text-sm uppercase">{{ $user->organization ?? 'DINAS TERKAIT' }}</p>
                </div>
                
                <div class="relative h-80 w-full">
                    <canvas id="evaluasiChart"></canvas>
                </div>
            </div>

            <!-- Right Sidebar Cards -->
            <div class="space-y-6">
                
                <!-- User Profile -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-blue-50 flex items-center gap-4">
                     <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center text-orange-500 shadow-inner">
                         <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                     </div>
                     <div>
                         <h4 class="font-bold text-[#1A237E]">{{ $user->name }}</h4>
                         <p class="text-xs text-blue-400 font-medium">
                            @if($user instanceof \App\Models\ExternalUser)
                                User OPD
                            @else
                                Operator
                            @endif
                         </p>
                     </div>
                </div>

                <!-- Upload Folder -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-blue-50">
                    <h4 class="font-bold text-[#1A237E] mb-4">Folder Upload Bukti Dukung</h4>
                    <a href="#" class="text-blue-500 text-sm font-semibold hover:underline flex items-center gap-2">
                        Klik untuk mengakses folder
                         <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                    </a>
                </div>

            </div>

        </div>

    </div>

    <!-- Chart Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('evaluasiChart').getContext('2d');
            
            const labels = @json($labels);
            const dataPM = @json($dataPM);
            const dataPB = @json($dataPB);

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'PM',
                            data: dataPM,
                            backgroundColor: '#4285F4',
                            borderRadius: 4,
                            barPercentage: 0.6,
                        },
                        {
                            label: 'PB',
                            data: dataPB,
                            backgroundColor: '#EA4335',
                            borderRadius: 4,
                            barPercentage: 0.6,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 3.5, // Scale 0-3 usually
                            ticks: { stepSize: 1 }
                        },
                        x: {
                            grid: { display: false }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'right',
                            align: 'start',
                            labels: {
                                usePointStyle: true,
                                boxWidth: 8
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
