<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'apellido', 'estado', 'rol_id', 'usu_registro', 'usu_ult_mod',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function rol()
    {
        return $this->belongsTo(Role::class, 'rol_id');
    }

    public function hasRole($role)
    {
        return $this->rol->nombre === $role;
    }

    public function hasAnyRole($role)
    {
        if (is_array($role)) {
            return in_array($this->rol->nombre, $role);
        }

        return $this->rol->nombre === $role;
    }
    /*
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function canEditRecord($model)
    {
        $permissionSlug = 'editar-' . $model->getTable();

        if ($this->hasRole('administrador')) {
            return true;
        }

        if ($this->hasRole('veterinario') && $this->hasPermission($permissionSlug)) {
            return true;
        }

        if ($this->hasRole('recepcionista') && $this->hasPermission($permissionSlug)) {
            return true;
        }


        return false;
    }

    public function canDeleteRecord($model)
    {
        $permissionSlug = 'eliminar-' . $model->getTable();

        if ($this->hasRole('administrador')) {
            return true;
        }

        if ($this->hasRole('veterinario') && $this->hasPermission($permissionSlug)) {
            return true;
        }

        if ($this->hasRole('recepcionista') && $this->hasPermission($permissionSlug)) {
            return true;
        }

        return false;
    }

    public function hasPermission($permission)
    {
        return $this->permissions->contains('slug', $permission);
    }

    public function hasPermission($permission)
    {
        return $this->permissions ? $this->permissions->contains('slug', $permission) : false;
    }

    public function hasPermission($permissionSlug)
    {
        return $this->permissions()->where('slug', $permissionSlug)->count() > 0;
    }*/




}
