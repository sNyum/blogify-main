<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BeritaController;

Route::get('/', function () {
    return redirect('/admin/login');
});

Route::prefix('admin')->group(function () {
    Route::get('berita/create', [BeritaController::class, 'create'])->name('admin.berita.create');
    Route::post('berita', [BeritaController::class, 'store'])->name('admin.berita.store');
});
