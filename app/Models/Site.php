<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'url',
        'is_up',
        'last_down_at',
        'response_time_ms',
        'last_checked_at',
        'alert_email',
        'is_down_notified',
    ];

    protected $casts = [
        'is_up' => 'boolean',
        'is_down_notified' => 'boolean',
        'last_down_at' => 'datetime',
        'last_checked_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
