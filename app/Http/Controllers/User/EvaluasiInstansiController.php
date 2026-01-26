<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExternalUser;

class EvaluasiInstansiController extends Controller
{
    public function index()
    {
        if (!auth('bps')->check()) {
            abort(403, 'Akses Ditolak. Menu ini hanya untuk Operator.');
        }

        $instansis = ExternalUser::all();
        $user = auth('bps')->user();
        return view('user.evaluasi.instansi.index', compact('instansis', 'user'));
    }

    public function setTarget($id)
    {
        if (!auth('bps')->check()) {
            abort(403);
        }

        $target = ExternalUser::findOrFail($id);
        
        // Set session target untuk Penilaian Badan
        session(['evaluasi_target_id' => $target->id]);

        return redirect()->route('evaluasi.dashboard')->with('success', 'Masuk Mode Penilaian Badan untuk: ' . $target->organization);
    }

    public function hasilPenilaian()
    {
        if (!auth('bps')->check()) {
            abort(403);
        }

        $instansis = ExternalUser::all();
        $user = auth('bps')->user();

        // Calculate Mock Scores per Instansi
        foreach ($instansis as $inst) {
             // Mock Calculation
             // In real app, query EvaluasiScore where external_user_id = $inst->id
             $scores = \App\Models\EvaluasiScore::where('external_user_id', $inst->id)->get();
             
             $totalIndikator = 20; // Example Total Indicators
             $filledPM = $scores->whereNotNull('score_pm')->count();
             $filledPB = $scores->whereNotNull('score_pb')->count();

             $inst->progress_pm = ($filledPM / $totalIndikator) * 100;
             $inst->progress_pb = ($filledPB / $totalIndikator) * 100;
             
             // Simple Avg
             $inst->hasil_pm = $scores->avg('score_pm') ?? 0;
             $inst->hasil_pb = $scores->avg('score_pb') ?? 0;
             
             $inst->predikat = $inst->hasil_pb >= 2.6 ? 'Baik' : 'Kurang';
        }

        return view('user.evaluasi.instansi.hasil', compact('instansis', 'user'));
    }

    public function detailInstansi($id)
    {
        if (!auth('bps')->check()) {
            abort(403);
        }
        
        $instansi = ExternalUser::findOrFail($id);
        $user = auth('bps')->user();

        // Domains only
        $domains = [
            ['id' => 1, 'name' => 'Prinsip SDI'],
            ['id' => 2, 'name' => 'Kualitas Data'],
            ['id' => 3, 'name' => 'Proses Bisnis Statistik'],
            ['id' => 4, 'name' => 'Kelembagaan'],
            ['id' => 5, 'name' => 'Statistik Nasional'],
        ];

        foreach ($domains as &$d) {
             $d['progress_pm'] = rand(0, 100);
             $d['progress_pb'] = rand(0, 100);
             $d['hasil_pm'] = rand(10, 30) / 10;
             $d['hasil_pb'] = rand(10, 30) / 10;
             $d['predikat'] = $d['hasil_pb'] >= 2.6 ? 'Baik' : 'Kurang';
        }

        return view('user.evaluasi.instansi.detail', compact('instansi', 'user', 'domains'));
    }

    public function detailDomain($id, $domain_id)
    {
        if (!auth('bps')->check()) abort(403);
        $instansi = ExternalUser::findOrFail($id);
        $user = auth('bps')->user();
        
        // Mock Domain Name lookup
        $domainName = match($domain_id) {
            '1' => 'Prinsip SDI',
            '2' => 'Kualitas Data',
            '3' => 'Proses Bisnis',
             default => 'Domain'
        };

        // Mock Aspects
        $aspeks = [
            ['kode' => '101', 'nama' => 'Standar Data Statistik'],
            ['kode' => '102', 'nama' => 'Metadata Statistik'],
            ['kode' => '103', 'nama' => 'Interoperabilitas Data'],
            ['kode' => '104', 'nama' => 'Kode Referensi/Data Induk'],
        ];

         foreach ($aspeks as &$a) {
             $a['progress_pm'] = 100;
             $a['progress_pb'] = 100;
             $a['hasil_pm'] = rand(10, 30) / 10;
             $a['hasil_pb'] = rand(10, 30) / 10;
             $a['predikat'] = $a['hasil_pb'] >= 2.6 ? 'Baik' : 'Kurang';
        }

        return view('user.evaluasi.instansi.detail-domain', compact('instansi', 'user', 'domainName', 'domain_id', 'aspeks'));
    }

    public function detailAspek($id, $domain_id, $aspek_id)
    {
        if (!auth('bps')->check()) abort(403);
        $instansi = ExternalUser::findOrFail($id);
        $user = auth('bps')->user();
        
        $domainName = 'Prinsip SDI';
        $aspek = [
            'kode' => $aspek_id,
            'nama' => 'Tingkat Kematangan Penerapan Standar Data Statistik (SDS)',
            'progress_pm' => 100,
            'progress_pb' => 100,
            'hasil_pm' => 1.00,
            'hasil_pb' => 3.00,
            'predikat' => 'Baik'
        ];

        return view('user.evaluasi.instansi.detail-aspek', compact('instansi', 'user', 'domainName', 'domain_id', 'aspek'));
    }

    public function refreshProses()
    {
        if (!auth('bps')->check()) abort(403);
        
        // Logic Refresh/Kalkulasi Ulang (Mock)
        sleep(1); // Simulate processing
        
        return redirect()->route('evaluasi.instansi.hasil')->with('success', 'Data Hasil Penilaian Berhasil Di-refresh.');
    }
}
