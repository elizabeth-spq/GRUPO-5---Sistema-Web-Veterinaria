<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $fillable = ['nombre', 'modulos', 'estado', 'usu_registro', 'usu_ult_mod'];

    public static function crearRol($datos)
    {
        $validacion = validator($datos, [
            'nombre' => 'required|string|max:250',
            'modulos' => 'required|string', 
            'estado' => 'integer',
            'usu_registro' => 'integer|nullable',
            'usu_ult_mod' => 'integer|nullable',
        ]);

        if ($validacion->fails()) {
            return ['error' => $validacion->errors()->all()];
        }

        // Crea un nuevo rol en la base de datos
        $rol = self::create($datos);

        return $rol;
    }

}
