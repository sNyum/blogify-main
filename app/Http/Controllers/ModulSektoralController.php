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
        $modul = ModulSektoral::where('slug', $slug)->firstOrFail();

        return view('modul-sektoral.show', compact('modul'));
    }
}
