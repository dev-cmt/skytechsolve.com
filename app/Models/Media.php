<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
        'model_type',
        'model_id',
        'type',
        'alt_text',
        'size',
        'sort_order',
        'is_main',
        'created_by',
    ];

    /**
     * Get the associated model (Product, Project, etc.)
     */
    public function model()
    {
        return $this->morphTo();
    }
}