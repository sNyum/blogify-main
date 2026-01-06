<?php

namespace App\Http\Controllers;

use App\Models\ModulSektoral;

class ModulSektoralController extends Controller
{
    public function index()
    {
        $moduls = ModulSektoral::orderBy('judul')->paginate(9);
        // dd($moduls);

        return view('modul-sektoral.index', compact('moduls'));
    }

    public function show($slug)
    {
        $modul = ModulSektoral::where('slug', $slug)->firstOrFail();

        return view('modul-sektoral.show', compact('modul'));
    }
}
