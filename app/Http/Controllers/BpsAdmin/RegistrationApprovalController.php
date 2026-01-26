<?php

namespace App\Http\Controllers\BpsAdmin;

use App\Http\Controllers\Controller;
use App\Models\ExternalUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegistrationApprovalController extends Controller
{
    /**
     * Show BPS admin login page.
     */
    public function showLogin()
    {
        return view('auth.bps-login');
    }

    /**
     * Handle BPS admin login.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('bps-admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    /**
     * Show registration approval dashboard.
     */
    public function index(Request $request)
    {
        $query = ExternalUser::with('approver')->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $registrations = $query->paginate(15);

        return view('bps-admin.registrations', compact('registrations'));
    }

    /**
     * Approve a registration.
     */
    public function approve(Request $request, $id)
    {
        $registration = ExternalUser::findOrFail($id);

        if ($registration->isApproved()) {
            return back()->with('error', 'Pendaftaran sudah disetujui sebelumnya.');
        }

        // Generate random password
        $password = Str::random(10);

        $registration->update([
            'status' => 'approved',
            'password' => Hash::make($password),
            'approved_by' => Auth::id(),
            'approved_at' => now(),
            'is_verified' => true,
            'is_active' => true,
        ]);

        // Store password temporarily in session for WhatsApp message
        session()->put('new_password_' . $id, $password);

        return back()->with('success', 'Pendaftaran berhasil disetujui. Silakan kirim kredensial via WhatsApp.');
    }

    /**
     * Reject a registration.
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);

        $registration = ExternalUser::findOrFail($id);

        $registration->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        return back()->with('success', 'Pendaftaran ditolak.');
    }

    /**
     * Delete a registration.
     */
    public function destroy($id)
    {
        $registration = ExternalUser::findOrFail($id);
        
        // Delete uploaded file if exists
        if ($registration->surat_permohonan_path && file_exists(storage_path('app/public/' . $registration->surat_permohonan_path))) {
            unlink(storage_path('app/public/' . $registration->surat_permohonan_path));
        }

        $registration->delete();

        return back()->with('success', 'Pendaftaran berhasil dihapus.');
    }

    /**
     * Get WhatsApp message for sending credentials.
     */
    public function getWhatsAppMessage($id)
    {
        $registration = ExternalUser::findOrFail($id);
        
        if (!$registration->isApproved()) {
            return back()->with('error', 'Pendaftaran belum disetujui.');
        }

        $password = session()->get('new_password_' . $id);
        
        if (!$password) {
            return back()->with('error', 'Password tidak ditemukan. Silakan approve ulang.');
        }

        // Determine greeting based on time
        $hour = now()->format('H');
        $greeting = 'Selamat Pagi';
        if ($hour >= 11 && $hour < 15) {
            $greeting = 'Selamat Siang';
        } elseif ($hour >= 15 && $hour < 18) {
            $greeting = 'Selamat Sore';
        } elseif ($hour >= 18) {
            $greeting = 'Selamat Malam';
        }

        $message = urlencode(
            "{$greeting} Pak/Bu. Kami dari Tim Statistik Sektoral BPS Kabupaten Batanghari, izin menginformasikan bahwa OPD Bapak/Ibu telah disetujui dan terdaftar untuk mendapatkan pembinaan statistik sektoral.\n\n" .
            "Berikut akun akses OPD Bapak/Ibu:\n" .
            "Email: {$registration->email}\n" .
            "Password: {$password}\n\n" .
            "Silakan login di: " . url('/login') . "\n\n" .
            "Silakan update password akun secara mandiri untuk menjaga privasi Bapak/Ibu.\n\n" .
            "Terima kasih.\n\n" .
            "Tim Statistik Sektoral\n" .
            "BPS Kabupaten Batanghari"
        );

        $whatsappUrl = "https://wa.me/{$registration->phone}?text={$message}";

        // Clear password from session after generating link
        session()->forget('new_password_' . $id);

        return redirect($whatsappUrl);
    }

    /**
     * View uploaded surat permohonan PDF.
     */
    public function viewSurat($id)
    {
        $registration = ExternalUser::findOrFail($id);

        if (!$registration->surat_permohonan_path) {
            abort(404, 'Surat permohonan tidak ditemukan.');
        }

        $filePath = storage_path('app/public/' . $registration->surat_permohonan_path);

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->file($filePath);
    }

    /**
     * Logout BPS admin.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('bps-admin.login')->with('success', 'Logout berhasil.');
    }
}
