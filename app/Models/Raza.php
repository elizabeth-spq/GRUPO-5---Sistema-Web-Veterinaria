<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Raza extends Model
{
    use HasFactory;
    protected $table = 'razas';
    protected $primaryKey = 'id';
    protected $foreingKey = 'animal_id';

    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }

}
