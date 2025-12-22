<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'  => 'required|string|max:255',
            'konten' => 'required|string',
            'foto'   => 'nullable|image|max:2048',
        ]);

        $data = $request->only('judul', 'konten');

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nama = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('images/berita'), $nama);
            $data['foto'] = $nama;
        }

        Berita::create($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan');
    }
}
