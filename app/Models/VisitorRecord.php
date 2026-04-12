<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorRecord extends Model
{
    protected $fillable = [
        'ip_address',
        'user_agent',
        'device_type',
        'browser',
        'platform',
        'page_url',
        'referrer_url',
        'country',
        'city',
        'latitude',
        'longitude',
        'session_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeLast24Hours($query)
    {
        return $query->where('created_at', '>=', now()->subDay());
    }

    public function scopeUnique($query)
    {
        return $query->select('ip_address')->distinct();
    }
}
