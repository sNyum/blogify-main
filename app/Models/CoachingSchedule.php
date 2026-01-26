<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoachingSchedule extends Model
{
    protected $fillable = [
        'date',
        'time',
        'topic',
        'location',
        'participants',
        'status',
        'created_by'
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
