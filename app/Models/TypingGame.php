<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypingGame extends Model
{
    use HasFactory;

    protected $fillable = [
        'sentence',
        'number_of_words',
    ];
}
