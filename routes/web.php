<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\ModulSektoralController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\Chat\ChatController;

Route::get('/', [App\Http\Controllers\LandingController::class, 'index'])->name('landing');

// Login Selection Page
// Login Selection Page
Route::get('/login-select', [App\Http\Controllers\Auth\LoginSelectController::class, 'index'])->name('login.select');

// Authentication Routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Pendaftaran (Public Registration)
Route::get('/pendaftaran', [App\Http\Controllers\Pendaftaran\PendaftaranController::class, 'index'])->name('pendaftaran.index');
Route::get('/pendaftaran/download-template', [App\Http\Controllers\Pendaftaran\PendaftaranController::class, 'downloadTemplate'])->name('pendaftaran.download-template');

// User Dashboard (Protected)
Route::middleware(['auth:external'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    


    Route::get('/dashboard/pembinaan', [DashboardController::class, 'pembinaan'])->name('pembinaan.index');
    Route::get('/dashboard/jadwal', [App\Http\Controllers\User\CoachingScheduleController::class, 'index'])->name('schedule.list');
    Route::get('/chat', [ChatController::class, 'index'])->name('chat');
    
    // Chat API
    Route::get('/chat/conversations', [ChatController::class, 'getConversations'])->name('chat.conversations');
    Route::post('/chat/start-conversation', [ChatController::class, 'startConversation'])->name('chat.start');
    Route::get('/chat/conversations/{conversationId}/messages', [ChatController::class, 'getMessages'])->name('chat.messages');
    Route::post('/chat/send-message', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::post('/chat/upload-file', [ChatController::class, 'uploadFile'])->name('chat.upload');
    Route::post('/chat/conversations/{conversationId}/rate', [ChatController::class, 'rateConversation'])->name('chat.rate');
});

// Evaluasi Module Routes (Shared Access for External & Internal Users)
Route::group([], function () {
    Route::get('/dashboard/evaluasi', [App\Http\Controllers\User\EvaluasiController::class, 'dashboard'])->name('evaluasi.dashboard');
    Route::get('/dashboard/evaluasi/login', [App\Http\Controllers\User\EvaluasiController::class, 'loginForm'])->name('evaluasi.login');
    Route::post('/dashboard/evaluasi/auth', [App\Http\Controllers\User\EvaluasiController::class, 'authenticate'])->name('evaluasi.authenticate');
    Route::post('/dashboard/evaluasi/logout', [App\Http\Controllers\User\EvaluasiController::class, 'logout'])->name('evaluasi.logout');
    
    // Evaluasi Pages
    Route::get('/dashboard/evaluasi/prinsip-sdi/standar-data', [App\Http\Controllers\User\EvaluasiController::class, 'standarData'])->name('evaluasi.sdi.standar-data');
    Route::get('/dashboard/evaluasi/prinsip-sdi/standar-data/pm', [App\Http\Controllers\User\EvaluasiController::class, 'editPM'])->name('evaluasi.pm.edit');
     Route::post('/dashboard/evaluasi/prinsip-sdi/standar-data/pm', [App\Http\Controllers\User\EvaluasiController::class, 'updatePM'])->name('evaluasi.pm.update');

     // Penilaian Badan (PB)
     Route::get('/dashboard/evaluasi/prinsip-sdi/standar-data/pb', [App\Http\Controllers\User\EvaluasiController::class, 'editPB'])->name('evaluasi.pb.edit');
     Route::post('/dashboard/evaluasi/prinsip-sdi/standar-data/pb', [App\Http\Controllers\User\EvaluasiController::class, 'updatePB'])->name('evaluasi.pb.update');

     // Pengguna
     Route::get('/dashboard/evaluasi/pengguna/profil', [App\Http\Controllers\User\EvaluasiController::class, 'profil'])->name('evaluasi.pengguna.profil');
     Route::post('/dashboard/evaluasi/pengguna/profil', [App\Http\Controllers\User\EvaluasiController::class, 'updateProfil'])->name('evaluasi.pengguna.update-profil');
     
     Route::get('/dashboard/evaluasi/pengguna/daftar', [App\Http\Controllers\User\EvaluasiController::class, 'daftarPengguna'])->name('evaluasi.pengguna.index');
     Route::post('/dashboard/evaluasi/pengguna/daftar', [App\Http\Controllers\User\EvaluasiController::class, 'storePengguna'])->name('evaluasi.pengguna.store');
     Route::put('/dashboard/evaluasi/pengguna/daftar/{id}', [App\Http\Controllers\User\EvaluasiController::class, 'updatePengguna'])->name('evaluasi.pengguna.update');
     Route::delete('/dashboard/evaluasi/pengguna/daftar/{id}', [App\Http\Controllers\User\EvaluasiController::class, 'destroyPengguna'])->name('evaluasi.pengguna.destroy');
     
     Route::get('/dashboard/evaluasi/pengguna/password', [App\Http\Controllers\User\EvaluasiController::class, 'ubahPassword'])->name('evaluasi.pengguna.password');
     Route::post('/dashboard/evaluasi/pengguna/password', [App\Http\Controllers\User\EvaluasiController::class, 'updatePassword'])->name('evaluasi.pengguna.update-password');
     
     Route::get('/dashboard/evaluasi/nilai-ips', [App\Http\Controllers\User\EvaluasiController::class, 'nilaiIPS'])->name('evaluasi.nilai-ips');
     
     // Instansi Management (BPS Only)
     Route::get('/dashboard/evaluasi/instansi', [App\Http\Controllers\User\EvaluasiInstansiController::class, 'index'])->name('evaluasi.instansi.index');
     Route::post('/dashboard/evaluasi/instansi', [App\Http\Controllers\User\EvaluasiInstansiController::class, 'store'])->name('evaluasi.instansi.store');
     Route::put('/dashboard/evaluasi/instansi/{id}', [App\Http\Controllers\User\EvaluasiInstansiController::class, 'update'])->name('evaluasi.instansi.update');
     Route::delete('/dashboard/evaluasi/instansi/{id}', [App\Http\Controllers\User\EvaluasiInstansiController::class, 'destroy'])->name('evaluasi.instansi.destroy');
     Route::get('/dashboard/evaluasi/instansi/{id}/nilai', [App\Http\Controllers\User\EvaluasiInstansiController::class, 'setTarget'])->name('evaluasi.instansi.nilai');
     Route::get('/dashboard/evaluasi/instansi/hasil', [App\Http\Controllers\User\EvaluasiInstansiController::class, 'hasilPenilaian'])->name('evaluasi.instansi.hasil');
     Route::get('/dashboard/evaluasi/instansi/hasil', [App\Http\Controllers\User\EvaluasiInstansiController::class, 'hasilPenilaian'])->name('evaluasi.instansi.hasil');
     Route::get('/dashboard/evaluasi/instansi/{id}/detail', [App\Http\Controllers\User\EvaluasiInstansiController::class, 'detailInstansi'])->name('evaluasi.instansi.detail');
     Route::get('/dashboard/evaluasi/instansi/{id}/detail/{domain_id}', [App\Http\Controllers\User\EvaluasiInstansiController::class, 'detailDomain'])->name('evaluasi.instansi.detail.domain');
     Route::get('/dashboard/evaluasi/instansi/{id}/detail/{domain_id}', [App\Http\Controllers\User\EvaluasiInstansiController::class, 'detailDomain'])->name('evaluasi.instansi.detail.domain');
     Route::get('/dashboard/evaluasi/instansi/{id}/detail/{domain_id}/{aspek_id}', [App\Http\Controllers\User\EvaluasiInstansiController::class, 'detailAspek'])->name('evaluasi.instansi.detail.aspek');
     
     // Proses (Refresh)
     Route::get('/dashboard/evaluasi/instansi/proses', [App\Http\Controllers\User\EvaluasiInstansiController::class, 'refreshProses'])->name('evaluasi.instansi.proses');
     // Reset Target (Back to own view if needed, but 'Nilai' switches context)
});

Route::prefix('admin')->group(function () {
    Route::get('berita/create', [BeritaController::class, 'create'])->name('admin.berita.create');
    Route::post('berita', [BeritaController::class, 'store'])->name('admin.berita.store');
    
    // Admin Live Chat
    Route::middleware(['auth'])->group(function () {
        Route::get('live-chat', [App\Http\Controllers\Admin\AdminChatViewController::class, 'index'])->name('admin.live-chat');
    });
});

// BPS Admin Routes
Route::prefix('bps-admin')->name('bps-admin.')->group(function () {
    Route::get('/login', [App\Http\Controllers\BpsAdmin\RegistrationApprovalController::class, 'showLogin'])->name('login');
    Route::post('/login', [App\Http\Controllers\BpsAdmin\RegistrationApprovalController::class, 'login']);
    
    Route::middleware(['auth:web,bps'])->group(function () {
        // Dashboard Home
        Route::get('/dashboard', [App\Http\Controllers\BpsAdmin\DashboardController::class, 'index'])->name('dashboard');

        Route::get('/registrations', [App\Http\Controllers\BpsAdmin\RegistrationApprovalController::class, 'index'])->name('registrations');
        Route::post('/registrations/{id}/approve', [App\Http\Controllers\BpsAdmin\RegistrationApprovalController::class, 'approve'])->name('registrations.approve');
        Route::post('/registrations/{id}/reject', [App\Http\Controllers\BpsAdmin\RegistrationApprovalController::class, 'reject'])->name('registrations.reject');
        Route::delete('/registrations/{id}', [App\Http\Controllers\BpsAdmin\RegistrationApprovalController::class, 'destroy'])->name('registrations.destroy');
        Route::get('/registrations/{id}/whatsapp', [App\Http\Controllers\BpsAdmin\RegistrationApprovalController::class, 'getWhatsAppMessage'])->name('registrations.whatsapp');
        Route::get('/registrations/{id}/surat', [App\Http\Controllers\BpsAdmin\RegistrationApprovalController::class, 'viewSurat'])->name('registrations.surat');

        // Pembinaan Routes
        Route::get('/pembinaan', [App\Http\Controllers\BpsAdmin\PembinaanController::class, 'index'])->name('pembinaan.index');
        Route::get('/pembinaan/{id}', [App\Http\Controllers\BpsAdmin\PembinaanController::class, 'show'])->name('pembinaan.show');
        Route::post('/pembinaan/{id}/upload', [App\Http\Controllers\BpsAdmin\PembinaanController::class, 'store'])->name('pembinaan.store');
        Route::post('/logout', [App\Http\Controllers\BpsAdmin\RegistrationApprovalController::class, 'logout'])->name('logout');
    });
});

// BPS Staff Routes
Route::prefix('bps')->name('bps.')->group(function () {
    Route::get('/login', [App\Http\Controllers\BpsStaff\BpsStaffAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [App\Http\Controllers\BpsStaff\BpsStaffAuthController::class, 'login']);
    Route::post('/logout', [App\Http\Controllers\BpsStaff\BpsStaffAuthController::class, 'logout'])->name('logout');
    
    Route::middleware(['auth:bps'])->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\BpsStaff\BpsStaffDashboardController::class, 'index'])->name('dashboard');

        // Staff Pembinaan Routes
        Route::get('/pembinaan', [App\Http\Controllers\BpsStaff\PembinaanController::class, 'index'])->name('pembinaan.index');
        Route::get('/pembinaan/{id}', [App\Http\Controllers\BpsStaff\PembinaanController::class, 'show'])->name('pembinaan.show');
        Route::get('/pembinaan/{id}', [App\Http\Controllers\BpsStaff\PembinaanController::class, 'show'])->name('pembinaan.show');
        Route::post('/pembinaan/{id}/upload', [App\Http\Controllers\BpsStaff\PembinaanController::class, 'store'])->name('pembinaan.store');

        // Staff Schedule Routes
        Route::get('/schedule', [App\Http\Controllers\BpsStaff\CoachingScheduleController::class, 'index'])->name('schedule.index');
        Route::get('/schedule/create', [App\Http\Controllers\BpsStaff\CoachingScheduleController::class, 'create'])->name('schedule.create');
        Route::post('/schedule', [App\Http\Controllers\BpsStaff\CoachingScheduleController::class, 'store'])->name('schedule.store');
        Route::get('/schedule/{id}/edit', [App\Http\Controllers\BpsStaff\CoachingScheduleController::class, 'edit'])->name('schedule.edit');
        Route::put('/schedule/{id}', [App\Http\Controllers\BpsStaff\CoachingScheduleController::class, 'update'])->name('schedule.update');
        Route::delete('/schedule/{id}', [App\Http\Controllers\BpsStaff\CoachingScheduleController::class, 'destroy'])->name('schedule.destroy');
        
        // BPS Live Chat
        Route::get('/live-chat', [App\Http\Controllers\BpsStaff\BpsStaffChatController::class, 'index'])->name('live-chat');
        Route::prefix('chat')->name('chat.')->group(function() {
             Route::get('/conversations', [App\Http\Controllers\BpsStaff\BpsStaffChatController::class, 'getConversations']);
             Route::get('/conversations/{id}/messages', [App\Http\Controllers\BpsStaff\BpsStaffChatController::class, 'getMessages']);
             Route::post('/conversations/{id}/messages', [App\Http\Controllers\BpsStaff\BpsStaffChatController::class, 'sendMessage']);
             Route::post('/conversations/{id}/close', [App\Http\Controllers\BpsStaff\BpsStaffChatController::class, 'closeConversation']);
        });
    });
});

Route::get('/modul-sektoral', [ModulSektoralController::class, 'index']);
Route::get('/modul-sektoral/{slug}', [ModulSektoralController::class, 'show']);
Route::get('/berita', [App\Http\Controllers\BeritaController::class, 'index'])->name('berita.index');
Route::get('/pustaka', [App\Http\Controllers\PustakaController::class, 'index'])->name('pustaka.index');
Route::post('/chatbot/chat', [App\Http\Controllers\ChatbotController::class, 'chat'])->name('chatbot.chat');
Route::post('/chatbot/feedback', [App\Http\Controllers\ChatbotController::class, 'submitFeedback'])->name('chatbot.feedback');
Route::get('/data/download/population', [App\Http\Controllers\DataController::class, 'downloadPopulationData'])->name('data.download.population');