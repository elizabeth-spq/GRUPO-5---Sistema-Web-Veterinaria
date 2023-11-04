<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Historia extends Model
{
    use HasFactory;
    protected $table = 'historias';
    protected $primaryKey = 'id';
    protected $foreingKeyMascota = 'mascota_id';

    public function mascota(): BelongsTo
    {
    return $this->belongsTo(Mascota::class);
    }

}
