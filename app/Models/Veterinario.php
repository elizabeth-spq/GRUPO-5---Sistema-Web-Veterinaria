<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Veterinario extends Model
{
    use HasFactory;
    protected $table = 'veterinarios';
    protected $primaryKey = 'id';
    protected $foreingKeyHorario = 'horario_id';
    protected $foreingKeyEspecialidad = 'espec_id';

    public function cita(): HasMany
    {
        return $this->hasMany(Cita::class);
    }
    public function especialidad(): BelongsTo
    {
        return $this->belongsTo(Especialidad::class,'espec_id');
    }

}
