<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoachingDocument extends Model
{
    protected $fillable = [
        'external_user_id',
        'category',
        'title',
        'file_path',
        'file_name',
        'file_type',
        'file_size',
        'description',
        'uploaded_by_user_id',
        'uploaded_by_bps_staff_id',
    ];

    public function externalUser()
    {
        return $this->belongsTo(ExternalUser::class);
    }
}
