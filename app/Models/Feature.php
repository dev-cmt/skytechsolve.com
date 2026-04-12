<?php
// app/Models/Feature.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    protected $fillable = [
        'feature_name',
        'icon_class',
        'status'
    ];

    protected $casts = [
        'status' => 'string'
    ];
}
