<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageSectionVersion extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_section_id',
        'content',
        'created_by',
        'status',
        'notes'
    ];

    protected $casts = [
        'content' => 'string'
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(PageSection::class, 'page_section_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Scope para versiones publicadas
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    // Scope para drafts
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }
}
