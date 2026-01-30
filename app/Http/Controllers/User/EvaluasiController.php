<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\EvaluasiScore;
use App\Models\BpsStaff;

class EvaluasiController extends Controller
{
    public function loginForm()
    {
        return view('user.evaluasi.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // 1. Try External User (OPD)
        $externalUser = \App\Models\ExternalUser::where('email', $request->username)
                            ->first();

        if ($externalUser && Hash::check($request->password, $externalUser->password)) {
             session(['evaluasi_authenticated' => true]);
             auth('external')->login($externalUser);
             // Redirect external users to their user dashboard
             return redirect()->route('dashboard');
        }

        // 2. Try Internal User (BPS Staff)
        $internalUser = \App\Models\BpsStaff::where('email', $request->username)
                            ->orWhere('nip', $request->username)
                            ->first();

        if ($internalUser && Hash::check($request->password, $internalUser->password)) {
             session(['evaluasi_authenticated' => true]);
             auth('bps')->login($internalUser);
             // Redirect BPS staff to their staff dashboard
             return redirect()->route('bps.dashboard');
        }

        return back()->with('error', 'Username atau Password salah.');
    }

    public function dashboard()
    {
        // Auto-authenticate if user is already logged in via external or bps guard
        if (auth('external')->check() || auth('bps')->check()) {
            session(['evaluasi_authenticated' => true]);
        }
        
        if (!session('evaluasi_authenticated')) {
            return redirect()->route('evaluasi.login');
        }

        $user = $this->getTargetUser();
        if (!$user) return redirect()->route('evaluasi.login');

        $domains = ['Prinsip SDI', 'Kualitas Data', 'Proses Bisnis Statistik', 'Kelembagaan', 'Statistik Nasional'];
        
        // Ensure initial scores exist
        foreach ($domains as $d) {
             $data = ['score_pm' => rand(10, 30) / 10, 'score_pb' => rand(0, 20) / 10];
             
             if ($user instanceof \App\Models\ExternalUser) {
                  EvaluasiScore::firstOrCreate(
                      ['external_user_id' => $user->id, 'domain' => $d],
                      $data
                  );
             } else {
                  EvaluasiScore::firstOrCreate(
                      ['internal_user_id' => $user->id, 'domain' => $d],
                      $data
                  );
             }
        }
        
        $query = EvaluasiScore::query();
        if ($user instanceof \App\Models\ExternalUser) {
             $query->where('external_user_id', $user->id);
        } else {
             $query->where('internal_user_id', $user->id);
        }
        $scores = $query->get();
        
        // Prepare labels and data for Chart.js
        $labels = $scores->pluck('domain');
        $dataPM = $scores->pluck('score_pm');
        $dataPB = $scores->pluck('score_pb');

        return view('user.evaluasi.dashboard', compact('user', 'scores', 'labels', 'dataPM', 'dataPB'));
    }

    public function standarData()
    {
        $this->ensureEvaluasiAuth();
        
        if (!session('evaluasi_authenticated')) {
            return redirect()->route('evaluasi.login');
        }

        $user = $this->getTargetUser();
        $isOperator = auth('bps')->check();
        
        // Mock Data according to image
        $indikator = [
            'kode' => '10101',
            'nama' => 'Tingkat Kematangan Penerapan Standar Data Statistik (SDS)',
            'bobot' => 100,
            'nilai_pm' => 1,
            'nilai_pb' => 3,
            'proses' => '16-06',
        ];

        return view('user.evaluasi.standar-data', compact('user', 'indikator', 'isOperator'));
    }

    public function editPM()
    {
        $this->ensureEvaluasiAuth();
        
        if (!session('evaluasi_authenticated')) {
            return redirect()->route('evaluasi.login');
        }
        $user = $this->getTargetUser();
        $domain = 'Prinsip SDI'; 
        
        $query = EvaluasiScore::where('domain', $domain);
        if ($user instanceof \App\Models\ExternalUser) {
             $query->where('external_user_id', $user->id);
        } else {
             $query->where('internal_user_id', $user->id);
        }
        $score = $query->first();

        return view('user.evaluasi.form-pm', compact('user', 'score'));
    }

    public function editPB()
    {
        if (!session('evaluasi_authenticated') || !auth('bps')->check()) {
            return redirect()->route('evaluasi.login');
        }
        $user = $this->getTargetUser();
        $domain = 'Prinsip SDI'; 
        
        $query = EvaluasiScore::where('domain', $domain);
        if ($user instanceof \App\Models\ExternalUser) {
             $query->where('external_user_id', $user->id);
        } else {
             $query->where('internal_user_id', $user->id);
        }
        $score = $query->first();

        return view('user.evaluasi.form-pb', compact('user', 'score'));
    }

    public function updatePB(Request $request)
    {
        if (!session('evaluasi_authenticated') || !auth('bps')->check()) {
            abort(403);
        }

        $request->validate([
             'score_pb' => 'required|numeric|min:1|max:5',
             'nilai_pemeriksaan' => 'nullable|string',
             'catatan_pb' => 'nullable|string',
        ]);

        $user = $this->getTargetUser(); 
        $domain = 'Prinsip SDI'; 

        $data = [
            'score_pb' => $request->score_pb,
            'nilai_pemeriksaan' => $request->nilai_pemeriksaan,
            'catatan_pb' => $request->catatan_pb,
        ];

        if ($user instanceof \App\Models\ExternalUser) {
            EvaluasiScore::updateOrCreate(
                ['external_user_id' => $user->id, 'domain' => $domain],
                $data
            );
        } else {
            EvaluasiScore::updateOrCreate(
                ['internal_user_id' => $user->id, 'domain' => $domain],
                $data
            );
        }

        return redirect()->route('evaluasi.sdi.standar-data')->with('success', 'Nilai PB Berhasil Disimpan');
    }

    public function updatePM(Request $request)
    {
        if (!session('evaluasi_authenticated')) {
            return redirect()->route('evaluasi.login');
        }

        $request->validate([
             'score_pm' => 'required|numeric|min:1|max:5',
             'notes' => 'nullable|string',
             'evidence_link' => 'nullable|url'
        ]);

        $user = $this->getTargetUser();
        $domain = 'Prinsip SDI'; 

        $data = [
            'score_pm' => $request->score_pm,
            'notes' => $request->notes,
            'evidence_link' => $request->evidence_link
        ];

        if ($user instanceof \App\Models\ExternalUser) {
            EvaluasiScore::updateOrCreate(
                ['external_user_id' => $user->id, 'domain' => $domain],
                $data
            );
        } else {
            EvaluasiScore::updateOrCreate(
                ['internal_user_id' => $user->id, 'domain' => $domain],
                $data
            );
        }

        return redirect()->route('evaluasi.sdi.standar-data')->with('success', 'Data Berhasil Update');
    }

    public function profil()
    {
        $this->ensureEvaluasiAuth();
        
        if (!session('evaluasi_authenticated')) {
            return redirect()->route('evaluasi.login');
        }
        $user = $this->getTargetUser();
        return view('user.evaluasi.pengguna.profil', compact('user'));
    }

    public function updateProfil(Request $request)
    {
        $user = $this->getTargetUser();
        $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|max:2048'
        ]);

        $user->name = $request->name;
        // Logic avatar upload skipped for brevity/demo unless requested specific
        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui');
    }

    public function daftarPengguna()
    {
        if (!session('evaluasi_authenticated')) {
            return redirect()->route('evaluasi.login');
        }
        $user = $this->getTargetUser();
        if (!$user) return redirect()->route('evaluasi.login');
        
        // Restriction: Only Operator (Not ExternalUser)
        if ($user instanceof \App\Models\ExternalUser) {
             abort(403, 'Akses Ditolak. Menu ini hanya untuk Operator.');
        }

        $users = \App\Models\ExternalUser::all();
        return view('user.evaluasi.pengguna.index', compact('user', 'users'));
    }

    public function storePengguna(Request $request)
    {
        $this->authorizeOperator();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:external_users,email',
            'password' => 'required|string|min:6',
            'organization' => 'nullable|string|max:100', // Instansi
            'is_active' => 'nullable|boolean',
        ]);

        $user = new \App\Models\ExternalUser();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->organization = $request->organization;
        $user->is_active = $request->has('is_active');
        $user->is_verified = true; // Auto-verify staff-created accounts
        $user->status = 'approved'; // Auto-approve
        $user->approved_at = now(); // Set approval timestamp
        // $user->role = 1; // Default role user OPD
        $user->save();

        return redirect()->back()->with('success', 'Pengguna berhasil ditambahkan');
    }

    public function updatePengguna(Request $request, $id)
    {
        $this->authorizeOperator();

        $user = \App\Models\ExternalUser::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:external_users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'organization' => 'nullable|string|max:100',
            'is_active' => 'nullable|boolean',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->organization = $request->organization;
        $user->is_active = $request->has('is_active');
        $user->save();

        return redirect()->back()->with('success', 'Pengguna berhasil diperbarui');
    }

    public function destroyPengguna($id)
    {
        $this->authorizeOperator();

        $user = \App\Models\ExternalUser::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Pengguna berhasil dihapus');
    }

    private function authorizeOperator()
    {
        if (!session('evaluasi_authenticated') || !auth('bps')->check()) {
            abort(403, 'Akses Ditolak.');
        }
    }

    public function ubahPassword()
    {
        if (!session('evaluasi_authenticated')) {
            return redirect()->route('evaluasi.login');
        }
        $user = $this->getTargetUser();
        return view('user.evaluasi.pengguna.password', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
             'password' => 'required|min:6'
        ]);
        
        $user = $this->getTargetUser();
        $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Password berhasil diperbarui');
    }

    public function nilaiIPS()
    {
        $this->ensureEvaluasiAuth();
        
        if (!session('evaluasi_authenticated')) {
            return redirect()->route('evaluasi.login');
        }
        $user = $this->getTargetUser();
        if (!$user) return redirect()->route('evaluasi.login');

        // Mock Data Agregat
        $indikatorList = [
            [
                'kode' => '10101', 
                'nama' => 'Tingkat Kematangan Penerapan Standar Data Statistik (SDS)',
                'domain' => 'Prinsip SDI', // Map to DB domain key
                'progress_pm' => 100,
                'progress_pb' => 100,
            ],
            [
                'kode' => '10201', 
                'nama' => 'Tingkat Kematangan Penerapan Metadata Statistik',
                'domain' => 'Kualitas Data',
                'progress_pm' => 100,
                'progress_pb' => 100,
            ],
            [
                'kode' => '10301', 
                'nama' => 'Tingkat Kematangan Penerapan Interoperabilitas Data',
                'domain' => 'Proses Bisnis Statistik',
                'progress_pm' => 100,
                'progress_pb' => 100,
            ],
            [
                'kode' => '10401', 
                'nama' => 'Tingkat Kematangan Penerapan Kode Referensi',
                'domain' => 'Kelembagaan', 
                'progress_pm' => 100,
                'progress_pb' => 100,
            ],
        ];

        // Fetch scores
        foreach ($indikatorList as &$item) {
             $query = EvaluasiScore::where('domain', $item['domain']);
             if ($user instanceof \App\Models\ExternalUser) {
                  $query->where('external_user_id', $user->id);
             } else {
                  $query->where('internal_user_id', $user->id);
             }
             $score = $query->first();
             
             $item['hasil_pm'] = $score ? $score->score_pm : 1.00; 
             $item['hasil_pb'] = $score ? $score->score_pb : 1.00;
             $item['predikat'] = $item['hasil_pm'] >= 2.5 ? 'Baik' : 'Kurang';
        }

        return view('user.evaluasi.nilai-ips', compact('user', 'indikatorList'));
    }

    public function logout()
    {
        session()->forget('evaluasi_authenticated');
        session()->forget('evaluasi_target_id');

        if (auth('bps')->check()) {
            return redirect()->route('bps.dashboard');
        }

        return redirect()->route('dashboard');
    }

    private function getTargetUser()
    {
        if (auth('external')->check()) {
            return auth('external')->user();
        }

        if (auth('bps')->check()) {
            // Jika ada target instansi di session (Mode Penilaian Badan)
            if (session()->has('evaluasi_target_id')) {
                return \App\Models\ExternalUser::find(session('evaluasi_target_id'));
            }
            // Default: Kembali ke diri sendiri (Internal Assessment mock)
            return auth('bps')->user();
        }

        return null;
    }

    private function ensureEvaluasiAuth()
    {
        // Auto-authenticate if user is already logged in via external or bps guard
        if (auth('external')->check() || auth('bps')->check()) {
            session(['evaluasi_authenticated' => true]);
        }
    }
}
