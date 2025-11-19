<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class TypingResults extends Model
{
    protected $fillable = [
        'user_id',
        'time_seconds',
        'accuracy',
        'wpm',
        'incorrect_words',
        'incorrect_letters',
        'difficulty',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
