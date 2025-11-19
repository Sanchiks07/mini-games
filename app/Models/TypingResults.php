<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypingResult extends Model
{
    protected $fillable = [
        'user_id',
        'time_seconds',
        'accuracy',
        'wpm',
        'incorrect_words',
        'incorrect_letters',
        'difficulty'
    ];
}
