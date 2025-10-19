<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SocialShare extends Model
{
    use HasFactory;

    protected $fillable = [
        'testimonial_id',
        'social_platform',
        'share_count'
    ];

    // Relaciones
    public function testimonial(): BelongsTo
    {
        return $this->belongsTo(Testimonial::class);
    }

    // Métodos
    public function incrementShareCount(): void
    {
        $this->increment('share_count');
    }

    // Scopes
    public function scopePlatform($query, $platform)
    {
        return $query->where('social_platform', $platform);
    }

    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    // Accesores
    public function getPlatformNameAttribute(): string
    {
        return ucfirst($this->social_platform);
    }
}