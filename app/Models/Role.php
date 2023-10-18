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

    public static function crearRol($datos)
    {
        $validacion = validator($datos, [
            'nombre' => 'required|string|max:250',
            'modulos' => 'required|string',
            'estado' => 'integer',
        ]);

        if ($validacion->fails()) {
            return ['error' => $validacion->errors()->all()];
        }

        $role = self::create($datos);

        return $role;

    }

    public function user()
    {
        return $this->belongsTo(User::class, 'rol_id');
    }

}
