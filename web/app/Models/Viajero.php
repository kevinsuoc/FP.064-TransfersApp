<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Viajero extends Model
{
    use HasFactory;
    protected $table = 'p3_transfer_viajero';
    protected $primaryKey = 'id_viajero';
    public $timestamps = false;

    public function reservas(): HasMany {
        return $this->hasMany(Reserva::class, 'id_reserva', 'id_reserva');
    }
    
}
