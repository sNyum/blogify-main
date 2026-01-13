<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\ModulSektoral;
use Illuminate\Http\Request;

use App\Models\Pustaka;

class LandingController extends Controller
{
    public function index()
    {
        $modulSektoral = ModulSektoral::latest()->take(3)->get();
        $pustaka = Pustaka::latest()->take(6)->get();
        $berita = Berita::latest()->take(3)->get();

        return view('landing', compact('modulSektoral', 'pustaka', 'berita'));
    }
}
