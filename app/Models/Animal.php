<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Animal extends Model
{
    use HasFactory;
    protected $table = 'animales';
    protected $primaryKey = 'id';

    public function mascota(): HasMany
    {
        return $this->hasMany(Mascota::class);
    }

    public function raza(): HasMany
    {
        return $this->hasMany(Raza::class);
    }

}
