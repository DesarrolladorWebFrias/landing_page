<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'log_name',
        'description',
        'subject_type',
        'subject_id',
        'causer_type',
        'causer_id',
        'properties',
        'ip_address',
        'user_agent'
    ];

    protected $casts = [
        'properties' => 'array',
        'created_at' => 'datetime'
    ];

    public $timestamps = false;

    // Relaciones
    public function subject(): MorphTo
    {
        return $this->morphTo();
    }

    public function causer(): MorphTo
    {
        return $this->morphTo();
    }

    // Scopes
    public function scopeInLog($query, $logName)
    {
        return $query->where('log_name', $logName);
    }

    public function scopeCausedBy($query, $causer)
    {
        return $query->where('causer_type', get_class($causer))
                    ->where('causer_id', $causer->getKey());
    }

    // Helpers
    public function getExtraProperty($key, $default = null)
    {
        return data_get($this->properties, $key, $default);
    }
}
