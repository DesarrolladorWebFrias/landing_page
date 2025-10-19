<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
        'admin_notes',
        'responded_by',
        'responded_at',
        'ip_address',
        'user_agent'
    ];

    protected $casts = [
        'responded_at' => 'datetime'
    ];

    // Relaciones
    public function responder(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responded_by');
    }

    // Scopes
    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    public function scopeResolved($query)
    {
        return $query->where('status', 'resolved');
    }

    // Métodos
    public function markAsInProgress($adminId = null): void
    {
        $this->update([
            'status' => 'in_progress',
            'responded_by' => $adminId,
            'responded_at' => now()
        ]);
    }

    public function markAsResolved($adminId = null): void
    {
        $this->update([
            'status' => 'resolved',
            'responded_by' => $adminId,
            'responded_at' => now()
        ]);
    }

    public function isNew(): bool
    {
        return $this->status === 'new';
    }

    // Accesores
    public function getShortMessageAttribute(): string
    {
        return str($this->message)->limit(100);
    }
}
