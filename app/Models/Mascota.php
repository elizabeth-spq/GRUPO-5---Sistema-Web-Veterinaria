<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mascota extends Model
{
    use HasFactory;


    protected $table = 'mascotas';
    protected $primaryKey = 'id';
    protected $foreignKeyAnimal = 'animal_id';
    protected $foreignKeyCliente = 'cliente_id';

    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }
    public function cita(): HasMany
    {
        return $this->hasMany(Cita::class);
    }
}
