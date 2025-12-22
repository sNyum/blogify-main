<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{

   protected $table = 'beritas';

protected $fillable = ['judul', 'konten', 'foto'];
}
