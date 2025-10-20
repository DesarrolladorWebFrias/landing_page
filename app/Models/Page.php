<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'meta_description',
        'meta_keywords',
        'is_published'
    ];

    protected $casts = [
        'is_published' => 'boolean'
    ];

    public function sections(): HasMany
    {
        return $this->hasMany(PageSection::class);
    }

    // Helper para obtener sección por key
    public function getSection($key)
    {
        return $this->sections()->where('section_key', $key)->first();
    }

    // Scope para páginas publicadas
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    // Scope para buscar por slug
    public function scopeSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }

    // Accesores
    public function getUrlAttribute(): string
    {
        return url('/' . $this->slug);
    }

    public function getHeroSectionAttribute()
    {
        return $this->getSection('hero');
    }

    public function getAboutSectionsAttribute()
    {
        return $this->sections()->where('page_id', $this->id)->get();
    }
}