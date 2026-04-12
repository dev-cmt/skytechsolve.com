<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'category_id',
        'client_name',
        'location',
        'tech_stack',
        'launch_year',
        'project_budget',
        'live_link',
        'status',
    ];

    public function seo(): MorphOne
    {
        return $this->morphOne(Seo::class, 'seoable');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function media()
    {
        return $this->morphMany(Media::class, 'model');
    }
    protected static function boot(): void
    {
        parent::boot();

        static::creating(fn($service) => $service->slug = Str::slug($service->title));
        static::updating(fn($service) => $service->slug = Str::slug($service->title));
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}
