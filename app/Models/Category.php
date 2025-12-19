<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_active',
        'order',
        'meta_title',
        'meta_description',
    ];
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
