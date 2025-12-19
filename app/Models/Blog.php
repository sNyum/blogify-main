<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'subcategory_id',
        'tag_id',
        'title',
        'slug',
        'description',
        'content',
        'thumbnail_image',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_published',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
