<?php

namespace App\Http\Controllers\BpsAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistics for Dashboard Cards
        $totalOpd = \App\Models\ExternalUser::where('status', 'approved')->count();
        $pendingRegistrations = \App\Models\ExternalUser::where('status', 'pending')->count();
        $totalDocuments = \App\Models\CoachingDocument::count();
        $recentOpds = \App\Models\ExternalUser::where('status', 'approved')
                        ->orderBy('created_at', 'desc')
                        ->take(5)
                        ->get();

        return view('bps-admin.dashboard.index', compact('totalOpd', 'pendingRegistrations', 'totalDocuments', 'recentOpds'));
    }
}
