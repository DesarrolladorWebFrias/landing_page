<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'author_name',
        'author_position',
        'organization',
        'created_by',
        'updated_by',
        'is_published',
        'is_featured',
        'published_at',
        'view_count'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
        'published_at' => 'datetime'
    ];

    // Relaciones
    public function media(): HasMany
    {
        return $this->hasMany(TestimonialMedia::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function socialShares(): HasMany
    {
        return $this->hasMany(SocialShare::class);
    }

    // Scopes
    public function scopePublished(Builder $query): void
    {
        $query->where('is_published', true)
              ->whereNotNull('published_at')
              ->where('published_at', '<=', now());
    }

    public function scopeFeatured(Builder $query): void
    {
        $query->where('is_featured', true);
    }

    public function scopeDraft(Builder $query): void
    {
        $query->where('is_published', false);
    }

    // Helpers
    public function publish(): void
    {
        $this->update([
            'is_published' => true,
            'published_at' => now()
        ]);
    }

    public function unpublish(): void
    {
        $this->update([
            'is_published' => false,
            'published_at' => null
        ]);
    }

    public function incrementViewCount(): void
    {
        $this->increment('view_count');
    }

    // Accesores
    public function getExcerptAttribute(): string
    {
        return str($this->body)->limit(150);
    }

    public function getFeaturedImageAttribute()
    {
        return $this->media->where('is_featured', true)->first();
    }
}