<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tipocita extends Model
{
    use HasFactory;
    protected $table = 'tipocitas';
    protected $primaryKey = 'id';

    public function cita(): HasMany
    {
        return $this->hasMany(Cita::class);
    }
}
