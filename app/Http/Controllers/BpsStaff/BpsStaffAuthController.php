<?php

namespace App\Http\Controllers\BpsStaff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class BpsStaffAuthController extends Controller
{
    /**
     * Show the BPS staff login form.
     */
    public function showLogin()
    {
        if (Auth::guard('bps')->check()) {
            return redirect()->route('pendaftaran.index');
        }

        return view('bps.login');
    }

    /**
     * Handle BPS staff login request.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('bps')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            
            // Update last login timestamp
            Auth::guard('bps')->user()->updateLastLogin();

            return redirect()->intended(route('pendaftaran.index'));
        }

        throw ValidationException::withMessages([
            'email' => __('The provided credentials do not match our records.'),
        ]);
    }

    /**
     * Handle BPS staff logout.
     */
    public function logout(Request $request)
    {
        Auth::guard('bps')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('bps.login');
    }
}
