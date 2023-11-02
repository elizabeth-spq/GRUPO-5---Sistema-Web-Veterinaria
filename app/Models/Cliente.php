<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'clientes';
    protected $primaryKey = 'id';

    public function mascota(): HasMany
    {
        return $this->hasMany(Mascota::class);
    }
    public function cita(): HasMany
    {
        return $this->hasMany(Cita::class);
    }

}
