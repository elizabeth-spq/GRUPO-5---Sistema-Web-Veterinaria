<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cita extends Model
{
    use HasFactory;
    protected $table = 'citas';
    protected $primaryKey = 'id';
    protected $foreingKeyTipo = 'tipo_id';
    protected $foreingKeyCliente = 'cliente_id';
    protected $foreingKeyMascota = 'mascota_id';
    protected $foreingKeyEspec = 'espec_id';
    protected $foreingKeyVet = 'vet_id';

    public function especialidad(): BelongsTo
    {
        return $this->belongsTo(Especialidad::class,'espec_id');
    }
    public function tipo(): BelongsTo
    {
        return $this->belongsTo(Tipocita::class);
    }
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }
    public function mascota(): BelongsTo
    {
        return $this->belongsTo(Mascota::class);
    }
    public function veterinario(): BelongsTo
    {
        return $this->belongsTo(Veterinario::class,'vet_id');
    }

}
