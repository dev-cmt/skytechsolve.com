<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'title',
        'sub_title',
        'slug',
        'content',
        'author_id',
        'status',
        'published_date'
    ];

    public function getMainImageAttribute()
    {
        return $this->media()->where('is_main', true)->first();
    }

    protected $casts = [
        'published_date' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function seo(): MorphOne
    {
        return $this->morphOne(Seo::class , 'seoable');
    }

    public function media(): MorphMany
    {
        return $this->morphMany(Media::class , 'model');
    }

    public function author()
    {
        return $this->belongsTo(User::class , 'author_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class , 'blog_post_tags');
    }

    public function comments()
    {
        return $this->hasMany(BlogComment::class)->whereNull('parent_id')->with('replies');
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(fn($blogPost) => $blogPost->slug = Str::slug($blogPost->title));
        static::updating(fn($blogPost) => $blogPost->slug = Str::slug($blogPost->title));
        static::deleting(fn($blogPost) => $blogPost->tags()->delete());
        static::saving(function ($blogPost) {
            if ($blogPost->status === 'published' && empty($blogPost->published_date)) {
                $blogPost->published_date = now();
            }
            elseif ($blogPost->status === 'draft') {
                $blogPost->published_date = null;
            }
        });
    }

}
