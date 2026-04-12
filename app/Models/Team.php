<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'position',
        'bio',
        'image',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'order',
        'status'
    ];

    /**
     * Scope for active team members
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Scope for ordered team members
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')->orderBy('name', 'asc');
    }

    /**
     * Get the team member's SEO information.
     */
    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoable');
    }
}
