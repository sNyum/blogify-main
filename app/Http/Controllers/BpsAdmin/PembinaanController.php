<?php

namespace App\Http\Controllers\BpsAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PembinaanController extends Controller
{
    public function index()
    {
        // List only APPROVED OPDs
        $opds = \App\Models\ExternalUser::where('status', 'approved')
            ->orderBy('organization', 'asc')
            ->get();

        return view('bps-admin.pembinaan.index', compact('opds'));
    }

    public function show($id)
    {
        $opd = \App\Models\ExternalUser::findOrFail($id);
        
        // Fetch Documents grouped by category
        $documents = $opd->documents->groupBy('category');

        return view('bps-admin.pembinaan.show', compact('opd', 'documents'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'category' => 'required|in:sk_tim,materi,dokumentasi,daftar_hadir,notulen',
            'file' => 'required|file|max:10240', // Max 10MB
            'title' => 'nullable|string|max:255',
        ]);

        $opd = \App\Models\ExternalUser::findOrFail($id);
        
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $filePath = $file->storeAs('pembinaan/' . $id . '/' . $request->category, time() . '_' . $fileName, 'public');

        \App\Models\CoachingDocument::create([
            'external_user_id' => $opd->id,
            'category' => $request->category,
            'title' => $request->title ?? $fileName,
            'file_path' => $filePath,
            'file_name' => $fileName,
            'file_type' => $file->getClientOriginalExtension(),
            'file_size' => $this->formatSize($file->getSize()),
            'uploaded_by_bps_staff_id' => auth()->id(), // Assumes BPS guard
        ]);

        return back()->with('success', 'Dokumen berhasil diunggah.');
    }

    private function formatSize($bytes)
    {
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            return $bytes . ' bytes';
        } elseif ($bytes == 1) {
            return $bytes . ' byte';
        } else {
            return '0 bytes';
        }
    }
}
