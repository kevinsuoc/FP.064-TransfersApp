<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reserva extends Model
{
    use HasFactory;
    protected $table = 'p3_transfer_reserva';
    protected $primaryKey = 'id_reserva';
    const CREATED_AT = 'fecha_reserva';
    const UPDATED_AT = 'fecha_modificacion';

    public function viajero(): BelongsTo {
        return $this->belongsTo(Viajero::class, 'id_viajero', 'id_viajero');
    }

    public function hotel(): BelongsTo {
        return $this->belongsTo(Hotel::class, 'id_hotel', 'id_hotel');
    }

    public function destino(): BelongsTo {
        return $this->belongsTo(Hotel::class, 'id_destino', 'id_hotel');
    }

    public function origen(): BelongsTo {
        return $this->belongsTo(Hotel::class, 'id_origen', 'id_hotel');
    }

    public function vehiculo(): BelongsTo {
        return $this->belongsTo(Vehiculo::class, 'id_vehiculo', 'id_vehiculo');
    }

    public function tipoReserva(): BelongsTo {
        return $this->belongsTo(TipoReserva::class, 'id_tipo_reserva', 'id_tipo_reserva');
    }
}
