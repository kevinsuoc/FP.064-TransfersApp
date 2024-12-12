<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Corporativo extends Model
{
    use HasFactory;

    // Tabla personalizada
    protected $table = 'p3_transfer_corporativo';

    // Clave primaria personalizada
    protected $primaryKey = 'id_corporativo';

    // Desactivar timestamps
    public $timestamps = false;

    // Definición de relación
    public function reservas(): HasMany
    {
        return $this->hasMany(Reserva::class, 'id_corporativo', 'id_corporativo');
    }
}
