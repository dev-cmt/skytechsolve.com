<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_path',
        'mission_items',
        'status'
    ];

    protected $casts = [
        'mission_items' => 'array',
    ];

    /**
     * Scope for active missions
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Get the first active mission
     */
    public static function getActive()
    {
        return self::active()->first();
    }

    /**
     * Accessor for mission_items to ensure it's always an array
     */
    public function getMissionItemsAttribute($value)
    {
        // If it's already an array, return it
        if (is_array($value)) {
            return $value;
        }

        // If it's a string, try to decode it
        if (is_string($value)) {
            $decoded = json_decode($value, true);
            return is_array($decoded) ? $decoded : [];
        }

        // Fallback to empty array
        return [];
    }

    /**
     * Mutator for mission_items to ensure proper JSON encoding
     */
    public function setMissionItemsAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['mission_items'] = json_encode($value);
        } else {
            $this->attributes['mission_items'] = $value;
        }
    }
}
