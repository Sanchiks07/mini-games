<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemoryScore extends Model
{
    protected $fillable = ['user_id', 'mode', 'time_seconds'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
