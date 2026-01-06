<?php

namespace App\Http\Controllers;

use App\Models\Pustaka;
use Illuminate\Http\Request;

class PustakaController extends Controller
{
    public function index()
    {
        $pustaka = Pustaka::latest()->paginate(12); // Grid layout, so multiple of 3/4 is good
        return view('pustaka.index', compact('pustaka'));
    }
}
