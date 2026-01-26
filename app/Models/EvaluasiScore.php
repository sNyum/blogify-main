<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluasiScore extends Model
{
    protected $fillable = ['external_user_id', 'internal_user_id', 'domain', 'score_pm', 'score_pb', 'notes', 'evidence_link'];

    public function user()
    {
        return $this->belongsTo(ExternalUser::class, 'external_user_id');
    }

    public function internalUser()
    {
        return $this->belongsTo(BpsStaff::class, 'internal_user_id');
    }
}
