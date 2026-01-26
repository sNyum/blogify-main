<?php

namespace App\Http\Controllers\Pendaftaran;

use App\Http\Controllers\Controller;
use App\Models\ExternalUser;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    /**
     * Display the public registration data table.
     */
    public function index()
    {
        $registrations = ExternalUser::orderBy('created_at', 'desc')
            ->paginate(15);

        return view('pendaftaran.index', compact('registrations'));
    }

    /**
     * Download the surat permohonan template.
     */
    public function downloadTemplate()
    {
        $filePath = public_path('templates/surat_permohonan_template.pdf');
        
        if (!file_exists($filePath)) {
            abort(404, 'Template tidak ditemukan');
        }

        return response()->download($filePath, 'Format_Surat_Permohonan_Pembinaan.pdf');
    }
}
