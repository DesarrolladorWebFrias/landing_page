<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TestimonialMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'testimonial_id',
        'media_type',
        'file_name',
        'original_name',
        'mime_type',
        'path',
        'url',
        'alt_text',
        'file_size',
        'sort_order',
        'is_featured'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'file_size' => 'integer'
    ];

    public function testimonial(): BelongsTo
    {
        return $this->belongsTo(Testimonial::class);
    }

    // Accesores
    public function getFileSizeInKbAttribute(): float
    {
        return round($this->file_size / 1024, 2);
    }

    public function getFileSizeInMbAttribute(): float
    {
        return round($this->file_size / 1048576, 2);
    }

    public function isImage(): bool
    {
        return str_starts_with($this->mime_type, 'image/');
    }

    public function isVideo(): bool
    {
        return str_starts_with($this->mime_type, 'video/');
    }
}