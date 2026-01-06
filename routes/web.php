<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\ModulSektoralController;

Route::get('/', [App\Http\Controllers\LandingController::class, 'index'])->name('landing');

Route::prefix('admin')->group(function () {
    Route::get('berita/create', [BeritaController::class, 'create'])->name('admin.berita.create');
    Route::post('berita', [BeritaController::class, 'store'])->name('admin.berita.store');
});

Route::get('/modul-sektoral', [ModulSektoralController::class, 'index']);
Route::get('/modul-sektoral/{slug}', [ModulSektoralController::class, 'show']);
Route::get('/berita', [App\Http\Controllers\BeritaController::class, 'index'])->name('berita.index');
Route::get('/pustaka', [App\Http\Controllers\PustakaController::class, 'index'])->name('pustaka.index');
Route::post('/chatbot/chat', [App\Http\Controllers\ChatbotController::class, 'chat'])->name('chatbot.chat');