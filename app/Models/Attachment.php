<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_type',
        'parent_id',
        'name',
        'file_path'
    ];

    public function parent()
    {
        return $this->morphTo();
    }

    /**
     * Get the full URL to the attachment file.
     */
    public function getFileUrlAttribute()
    {
        return asset($this->file_path);
    }

    /**
     * Get the file extension.
     */
    public function getFileExtensionAttribute()
    {
        return pathinfo($this->file_path, PATHINFO_EXTENSION);
    }

    /**
     * Get the file size (if you want to add this field later).
     */
    public function getFileSizeAttribute()
    {
        if (file_exists(public_path($this->file_path))) {
            return filesize(public_path($this->file_path));
        }
        return null;
    }
}