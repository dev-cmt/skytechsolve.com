<?php
// app/Models/PropertyFeature.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyFeature extends Model
{
    use HasFactory;

    protected $fillable = ['service_id', 'feature_id'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function feature()
    {
        return $this->belongsTo(Service::class);
    }
}
