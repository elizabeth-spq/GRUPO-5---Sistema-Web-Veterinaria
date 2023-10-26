<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $fillable = ['nombre', 'modulos', 'estado'];


    public function user()
    {
        return $this->belongsTo(User::class, 'rol_id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function hasPermission($permissionSlug)
    {
        return $this->permissions->contains('slug', $permissionSlug);
    }

}
