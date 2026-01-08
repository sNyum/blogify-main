<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Chat\ChatController;
use App\Http\Controllers\Chat\AdminChatController;

// Public Authentication Routes
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

// Protected Routes (External Users)
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/me', [AuthController::class, 'me']);
    Route::put('/auth/profile', [AuthController::class, 'updateProfile']);
    Route::put('/auth/change-password', [AuthController::class, 'changePassword']);
    
    // User Chat
    Route::prefix('chat')->group(function () {
        Route::post('/conversations', [ChatController::class, 'startConversation']);
        Route::get('/conversations', [ChatController::class, 'getConversations']);
        Route::get('/conversations/{id}/messages', [ChatController::class, 'getMessages']);
        Route::post('/messages', [ChatController::class, 'sendMessage']);
        Route::post('/messages/upload', [ChatController::class, 'uploadFile']);
        Route::put('/messages/{id}/read', [ChatController::class, 'markAsRead']);
        Route::post('/conversations/{id}/close', [ChatController::class, 'closeConversation']);
        Route::post('/conversations/{id}/rate', [ChatController::class, 'rateConversation']);
        Route::post('/typing', [ChatController::class, 'typing']);
    });
    
    // Admin Chat (requires admin role)
    Route::prefix('admin/chat')->middleware('role:super_admin|panel_user')->group(function () {
        Route::get('/conversations/open', [AdminChatController::class, 'getOpenConversations']);
        Route::get('/conversations/mine', [AdminChatController::class, 'getMyConversations']);
        Route::get('/conversations/{id}/messages', [AdminChatController::class, 'getMessages']);
        Route::post('/conversations/{id}/assign', [AdminChatController::class, 'assignToMe']);
        Route::post('/messages', [AdminChatController::class, 'sendMessage']);
        Route::post('/messages/upload', [AdminChatController::class, 'uploadFile']);
        Route::post('/canned-response', [AdminChatController::class, 'sendCannedResponse']);
        Route::post('/conversations/{id}/close', [AdminChatController::class, 'closeConversation']);
        Route::get('/statistics', [AdminChatController::class, 'getStatistics']);
        Route::get('/canned-responses', [AdminChatController::class, 'getCannedResponses']);
        Route::post('/typing', [AdminChatController::class, 'typing']);
    });
});
