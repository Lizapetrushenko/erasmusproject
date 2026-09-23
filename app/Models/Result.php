<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'user_id',
        'score',
        'correct_answers',
        'remaining_lives',
        'bonus_points',
        'is_daily_bonus',
        'date',
    ];

    protected $casts = [
        'date' => 'date',
        'is_daily_bonus' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
