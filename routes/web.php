<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\ModulSektoralController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\Chat\ChatController;

Route::get('/', [App\Http\Controllers\LandingController::class, 'index'])->name('landing');

// Authentication Routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// User Dashboard (Protected)
Route::middleware(['auth:external'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/evaluasi', [DashboardController::class, 'evaluasi'])->name('evaluasi.index');
    Route::get('/dashboard/pembinaan', [DashboardController::class, 'pembinaan'])->name('pembinaan.index');
    Route::get('/chat', [ChatController::class, 'index'])->name('chat');
    
    // Chat API
    Route::get('/chat/conversations', [ChatController::class, 'getConversations'])->name('chat.conversations');
    Route::post('/chat/start-conversation', [ChatController::class, 'startConversation'])->name('chat.start');
    Route::get('/chat/conversations/{conversationId}/messages', [ChatController::class, 'getMessages'])->name('chat.messages');
    Route::post('/chat/send-message', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::post('/chat/upload-file', [ChatController::class, 'uploadFile'])->name('chat.upload');
    Route::post('/chat/conversations/{conversationId}/rate', [ChatController::class, 'rateConversation'])->name('chat.rate');
});

Route::prefix('admin')->group(function () {
    Route::get('berita/create', [BeritaController::class, 'create'])->name('admin.berita.create');
    Route::post('berita', [BeritaController::class, 'store'])->name('admin.berita.store');
    
    // Admin Live Chat
    Route::middleware(['auth'])->group(function () {
        Route::get('live-chat', [App\Http\Controllers\Admin\AdminChatViewController::class, 'index'])->name('admin.live-chat');
    });
});

Route::get('/modul-sektoral', [ModulSektoralController::class, 'index']);
Route::get('/modul-sektoral/{slug}', [ModulSektoralController::class, 'show']);
Route::get('/berita', [App\Http\Controllers\BeritaController::class, 'index'])->name('berita.index');
Route::get('/pustaka', [App\Http\Controllers\PustakaController::class, 'index'])->name('pustaka.index');
Route::post('/chatbot/chat', [App\Http\Controllers\ChatbotController::class, 'chat'])->name('chatbot.chat');
Route::post('/chatbot/feedback', [App\Http\Controllers\ChatbotController::class, 'submitFeedback'])->name('chatbot.feedback');
Route::get('/data/download/population', [App\Http\Controllers\DataController::class, 'downloadPopulationData'])->name('data.download.population');