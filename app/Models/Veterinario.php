<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Veterinario extends Model
{
    use HasFactory;
    protected $table = 'veterinarios';
    protected $primaryKey = 'id';

    public function cita(): HasMany
    {
        return $this->hasMany(Cita::class);
    }

}
