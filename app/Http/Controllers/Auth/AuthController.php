<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ExternalUser;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Show registration form.
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Show login form.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Register a new user.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:external_users',
            'phone' => 'required|string|max:20',
            'organization' => 'required|string|max:255',
            'surat_permohonan' => 'required|file|mimes:pdf|max:2048', // 2MB max
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        // Handle PDF upload
        $suratPath = null;
        if ($request->hasFile('surat_permohonan')) {
            $file = $request->file('surat_permohonan');
            $filename = time() . '_' . str_replace(' ', '_', $request->organization) . '.pdf';
            $suratPath = $file->storeAs('surat_permohonan', $filename, 'public');
        }

        $user = ExternalUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make(Str::random(16)), // Temporary password, will be set on approval
            'phone' => $request->phone,
            'organization' => $request->organization,
            'surat_permohonan_path' => $suratPath,
            'status' => 'pending', // Pending approval
            'is_verified' => false,
            'is_active' => false,
        ]);

        // Create user profile
        UserProfile::create([
            'external_user_id' => $user->id,
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Pendaftaran berhasil terkirim. Menunggu persetujuan BPS.',
            ], 201);
        }

        // Redirect to pendaftaran page with success message
        return redirect()->route('pendaftaran.index')
            ->with('success', 'Pendaftaran berhasil terkirim! Silakan tunggu persetujuan dari BPS. Akun akan dikirimkan via WhatsApp.');
    }

    /**
     * Login user.
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        $user = ExternalUser::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email atau password salah.'
                ], 401);
            }
            return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
        }

        if (!$user->is_active) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Akun Anda tidak aktif.'
                ], 403);
            }
            return back()->withErrors(['email' => 'Akun Anda tidak aktif.'])->withInput();
        }

        // Update last login
        $user->updateLastLogin();

        // Generate token
        $token = $user->createToken('auth-token')->plainTextToken;

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'user' => $user->load('profile'),
                'token' => $token,
            ]);
        }

        // Login the user
        Auth::guard('external')->login($user, $request->filled('remember'));
        
        return redirect()->route('dashboard')->with('success', 'Login berhasil!');
    }

    /**
     * Logout user.
     */
    public function logout(Request $request)
    {
        if ($request->expectsJson()) {
            $request->user()->currentAccessToken()->delete();
            return response()->json([
                'success' => true,
                'message' => 'Logout berhasil.'
            ]);
        }

        Auth::guard('external')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logout berhasil.');
    }

    /**
     * Get authenticated user.
     */
    public function me(Request $request)
    {
        return response()->json([
            'success' => true,
            'user' => $request->user()->load('profile'),
        ]);
    }

    /**
     * Update user profile.
     */
    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'phone' => 'sometimes|nullable|string|max:20',
            'organization' => 'sometimes|string|max:255',
            'position' => 'sometimes|nullable|string|max:255',
            'address' => 'sometimes|nullable|string',
            'city' => 'sometimes|nullable|string|max:255',
            'province' => 'sometimes|nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Update user
        $user->update($request->only(['name', 'phone', 'organization']));

        // Update profile
        $user->profile->update($request->only(['position', 'address', 'city', 'province']));

        return response()->json([
            'success' => true,
            'user' => $user->fresh()->load('profile'),
        ]);
    }

    /**
     * Change password.
     */
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $user = $request->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Password saat ini salah.'
            ], 401);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Password berhasil diubah.'
        ]);
    }
}
