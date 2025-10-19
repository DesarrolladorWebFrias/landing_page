<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean'
        ];
    }

    /**
     * Relación muchos a muchos con Roles
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    /**
     * Testimonios creados por el usuario
     */
    public function testimonials(): HasMany
    {
        return $this->hasMany(Testimonial::class, 'created_by');
    }

    /**
     * Testimonios actualizados por el usuario
     */
    public function updatedTestimonials(): HasMany
    {
        return $this->hasMany(Testimonial::class, 'updated_by');
    }

    /**
     * Versiones de secciones de página creadas por el usuario
     */
    public function pageSectionVersions(): HasMany
    {
        return $this->hasMany(PageSectionVersion::class, 'created_by');
    }

    /**
     * Mensajes de contacto respondidos por el usuario
     */
    public function contactMessages(): HasMany
    {
        return $this->hasMany(ContactMessage::class, 'responded_by');
    }

    /**
     * Logs de actividad donde el usuario es el causante
     */
    public function activityLogs(): HasMany
    {
        return $this->hasMany(ActivityLog::class, 'causer_id');
    }

    /**
     * Verificar si el usuario tiene un rol específico
     */
    public function hasRole($role): bool
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }

        if ($role instanceof Role) {
            return $this->roles->contains('id', $role->id);
        }

        return false;
    }

    /**
     * Verificar si el usuario es administrador
     */
    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    /**
     * Verificar si el usuario es editor
     */
    public function isEditor(): bool
    {
        return $this->hasRole('editor');
    }

    /**
     * Asignar un rol al usuario
     */
    public function assignRole($role): void
    {
        if (is_string($role)) {
            $role = Role::where('name', $role)->firstOrFail();
        }

        $this->roles()->syncWithoutDetaching([$role->id]);
    }

    /**
     * Remover un rol del usuario
     */
    public function removeRole($role): void
    {
        if (is_string($role)) {
            $role = Role::where('name', $role)->firstOrFail();
        }

        $this->roles()->detach($role->id);
    }

    /**
     * Obtener todos los permisos del usuario (a través de roles)
     */
    public function getPermissions(): array
    {
        $permissions = [];

        foreach ($this->roles as $role) {
            // Aquí puedes expandir para incluir permisos específicos si los agregas en el futuro
            $permissions[] = 'role.' . $role->name;
        }

        return array_unique($permissions);
    }

    /**
     * Verificar si el usuario está activo
     */
    public function isActive(): bool
    {
        return $this->is_active;
    }

    /**
     * Activar usuario
     */
    public function activate(): void
    {
        $this->update(['is_active' => true]);
    }

    /**
     * Desactivar usuario
     */
    public function deactivate(): void
    {
        $this->update(['is_active' => false]);
    }

    /**
     * Scope para usuarios activos
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope para usuarios administradores
     */
    public function scopeAdmins($query)
    {
        return $query->whereHas('roles', function ($q) {
            $q->where('name', 'admin');
        });
    }

    /**
     * Obtener el nombre completo (puedes personalizar según necesites)
     */
    public function getFullNameAttribute(): string
    {
        return $this->name;
    }

    /**
     * Obtener el rol principal (primer rol)
     */
    public function getMainRoleAttribute(): ?string
    {
        return $this->roles->first()?->name;
    }

    /**
     * Boot del modelo para eventos
     */
    protected static function boot()
    {
        parent::boot();

        // Asignar rol de usuario por defecto al crear
        static::created(function ($user) {
            if ($user->roles->isEmpty()) {
                $userRole = Role::where('name', 'user')->first();
                if ($userRole) {
                    $user->roles()->attach($userRole->id);
                }
            }
        });
    }
}