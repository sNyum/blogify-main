<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'external_user_id',
        'avatar',
        'position',
        'address',
        'city',
        'province',
    ];

    /**
     * Get the user that owns the profile.
     */
    public function externalUser(): BelongsTo
    {
        return $this->belongsTo(ExternalUser::class);
    }

    /**
     * Get the avatar URL.
     */
    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        }
        
        // Default avatar using UI Avatars
        $name = urlencode($this->externalUser->name ?? 'User');
        return "https://ui-avatars.com/api/?name={$name}&size=200&background=4f46e5&color=fff";
    }
}
