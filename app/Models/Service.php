<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Str;

class Service extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'icon', 'sort_order', 'status', 'is_menu'
    ];

    public function features(): BelongsToMany
    {
        return $this->belongsToMany(Feature::class, 'service_features');
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'model')->where('type', 'image');
    }

    public function attachments()
    {
        return $this->morphMany(Media::class, 'model')->where('type', 'document');
    }

    public function seo(): MorphOne
    {
        return $this->morphOne(Seo::class, 'seoable');
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

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('title');
    }
}