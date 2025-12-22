<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ModulSektoral extends Model
{
    protected $fillable = [
        'judul',
        'slug',
        'deskripsi',
        'cover',
    ];

    public function files(): HasMany
    {
        return $this->hasMany(ModulFile::class);
    }
}
