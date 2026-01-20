<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatbotFeedback extends Model
{
    protected $fillable = ['user_query', 'bot_response', 'rating'];
}
