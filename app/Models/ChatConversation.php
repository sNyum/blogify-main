<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChatConversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'external_user_id',
        'assigned_admin_id',
        'status',
        'subject',
        'priority',
        'rating',
        'feedback',
        'closed_at',
    ];

    protected function casts(): array
    {
        return [
            'rating' => 'integer',
            'closed_at' => 'datetime',
        ];
    }

    /**
     * Get the external user who created this conversation.
     */
    public function externalUser(): BelongsTo
    {
        return $this->belongsTo(ExternalUser::class);
    }

    /**
     * Get the admin assigned to this conversation.
     */
    public function assignedAdmin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_admin_id');
    }

    /**
     * Get all messages in this conversation.
     */
    public function messages(): HasMany
    {
        return $this->hasMany(ChatMessage::class, 'conversation_id');
    }

    /**
     * Get the latest message.
     */
    public function latestMessage()
    {
        return $this->hasOne(ChatMessage::class, 'conversation_id')->latestOfMany();
    }

    /**
     * Get unread messages count.
     */
    public function unreadMessagesCount(): int
    {
        return $this->messages()->where('is_read', false)->count();
    }

    /**
     * Scope to get open conversations.
     */
    public function scopeOpen($query)
    {
        return $query->where('status', 'open');
    }

    /**
     * Scope to get assigned conversations.
     */
    public function scopeAssigned($query)
    {
        return $query->where('status', 'assigned');
    }

    /**
     * Scope to get closed conversations.
     */
    public function scopeClosed($query)
    {
        return $query->where('status', 'closed');
    }

    /**
     * Assign conversation to an admin.
     */
    public function assignToAdmin(int $adminId): void
    {
        $this->update([
            'assigned_admin_id' => $adminId,
            'status' => 'assigned',
        ]);
    }

    /**
     * Close the conversation.
     */
    public function close(): void
    {
        $this->update([
            'status' => 'closed',
            'closed_at' => now(),
        ]);
    }

    /**
     * Rate the conversation.
     */
    public function rate(int $rating, ?string $feedback = null): void
    {
        $this->update([
            'rating' => $rating,
            'feedback' => $feedback,
        ]);
    }

    /**
     * Check if conversation is active (not closed).
     */
    public function isActive(): bool
    {
        return $this->status !== 'closed';
    }
}
