<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{

   protected $table = 'beritas';

    protected $fillable = ['judul', 'konten', 'foto', 'youtube_url', 'channel_name'];
}
