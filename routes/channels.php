<?php

use App\Models\ChatConversation;
use App\Models\ExternalUser;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

// Private chat channel - only conversation participants can listen
Broadcast::channel('chat.{conversationId}', function ($user, $conversationId) {
    $conversation = ChatConversation::find($conversationId);
    
    if (!$conversation) {
        return false;
    }
    
    // Check if user is the external user who created the conversation
    if ($user instanceof ExternalUser && $user->id === $conversation->external_user_id) {
        return true;
    }
    
    // Check if user is the assigned admin
    if ($user instanceof User && $user->id === $conversation->assigned_admin_id) {
        return true;
    }
    
    // Allow any admin to listen (for unassigned conversations)
    if ($user instanceof User && $user->hasRole(['super_admin', 'panel_user'])) {
        return true;
    }
    
    return false;
});

// Admin chat channel - only admins can listen
Broadcast::channel('admin.chat', function ($user) {
    // Only admins can listen to this channel
    if ($user instanceof User && $user->hasRole(['super_admin', 'panel_user'])) {
        return ['id' => $user->id, 'name' => $user->name];
    }
    
    return false;
});
