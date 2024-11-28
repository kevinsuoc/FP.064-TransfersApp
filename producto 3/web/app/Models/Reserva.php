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

    public function precio(): BelongsTo {
        return $this->belongsTo(Precio::class, 'id_precio', 'id_precio');
    }

    public function tipoReserva(): BelongsTo {
        return $this->belongsTo(TipoReserva::class, 'id_tipo_reserva', 'id_tipo_reserva');
    }
}
