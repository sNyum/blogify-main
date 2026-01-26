<?php

namespace App\Http\Controllers\BpsStaff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BpsStaffDashboardController extends Controller
{
    /**
     * Show BPS staff dashboard.
     */
    public function index()
    {
        $staff = Auth::guard('bps')->user();
        
        // Statistics
        $totalOpd = \App\Models\ExternalUser::where('status', 'approved')->count();
        $pendingRegistrations = \App\Models\ExternalUser::where('status', 'pending')->count();
        $totalDocuments = \App\Models\CoachingDocument::count();
        $recentOpds = \App\Models\ExternalUser::where('status', 'approved')
                        ->orderBy('created_at', 'desc')
                        ->take(5)
                        ->get();

        return view('bps.dashboard', compact('staff', 'totalOpd', 'pendingRegistrations', 'totalDocuments', 'recentOpds'));
    }
}
