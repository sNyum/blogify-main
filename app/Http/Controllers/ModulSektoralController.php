<?php

namespace App\Http\Controllers;

use App\Models\ModulSektoral;

class ModulSektoralController extends Controller
{
    public function index()
    {
        $moduls = ModulSektoral::orderBy('judul')->get();
        // dd($moduls);

        return view('modul.index', compact('moduls'));
    }

    public function show($slug)
    {
        $modul = ModulSektoral::where('slug', $slug)
            ->with(['files' => fn ($q) => $q->orderBy('urutan')])
            ->firstOrFail();

        return view('modul.show', compact('modul'));
    }
}
