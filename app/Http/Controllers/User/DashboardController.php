<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ChatConversation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show user dashboard.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        // Mock Data for Dashboard Widgets
        $evaluasiStatus = 'Belum Dikirim'; 
        $evaluasiScore = '-';
        $jadwalPembinaan = 'Senin, 12 Feb 2024';

        $stats = [
            'total_chats' => ChatConversation::where('external_user_id', $user->id)->count(),
            'open_chats' => ChatConversation::where('external_user_id', $user->id)->whereIn('status', ['open', 'assigned'])->count(),
            'closed_chats' => ChatConversation::where('external_user_id', $user->id)->where('status', 'closed')->count(),
            'average_rating' => ChatConversation::where('external_user_id', $user->id)->whereNotNull('rating')->avg('rating'),
        ];

        $recentConversations = ChatConversation::where('external_user_id', $user->id)
            ->with(['latestMessage', 'assignedAdmin'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('user.dashboard', compact('user', 'stats', 'recentConversations', 'evaluasiStatus', 'evaluasiScore', 'jadwalPembinaan'));
    }

    public function evaluasi()
    {
        // Mock Data for Evaluasi Page
        $maturityLevels = [
            ['level' => 1, 'desc' => 'Rintisan', 'detail' => 'Kegiatan statistik sektoral dilakukan tanpa rencana matang.'],
            ['level' => 2, 'desc' => 'Terkelola', 'detail' => 'Kegiatan statistik sektoral dilakukan sesuai rencana namun belum konsisten.'],
            ['level' => 3, 'desc' => 'Terdefinisi', 'detail' => 'Kegiatan statistik sektoral dilakukan sesuai standar dan terdokumentasi.'],
            ['level' => 4, 'desc' => 'Terpadu dan Terukur', 'detail' => 'Kegiatan statistik sektoral dilakukan secara terpadu dan kinerjanya terukur.'],
            ['level' => 5, 'desc' => 'Optimum', 'detail' => 'Kegiatan statistik sektoral dilakukan dengan peningkatan kualitas berkelanjutan.'],
        ];

        return view('user.evaluasi', compact('maturityLevels'));
    }

    public function pembinaan()
    {
        $user = request()->user();
        
        // Fetch Documents grouped by category
        $documents = $user->documents->groupBy('category');

        return view('user.pembinaan', compact('documents'))->with('header', 'Menu Pembinaan');
    }
}
