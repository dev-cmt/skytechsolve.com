<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'subtitle',
        'description',
        'type',
        'price',
        'buy_link',
        'icon',
        'sort_order',
        'status'
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->title);
            }
        });

        static::updating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->title);
            }
        });
    }

    public function pricePlans()
    {
        return $this->hasMany(PricePlan::class);
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoable');
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('id', 'desc');
    }
}
