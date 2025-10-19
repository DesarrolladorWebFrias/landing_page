<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class PageSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'section_key',
        'title',
        'content',
        'sort_order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function versions(): HasMany
    {
        return $this->hasMany(PageSectionVersion::class);
    }

    // Obtener la última versión publicada
    public function publishedVersion()
    {
        return $this->versions()
            ->where('status', 'published')
            ->latest()
            ->first();
    }

    // Obtener la última versión (draft o published)
    public function latestVersion()
    {
        return $this->versions()->latest()->first();
    }
}