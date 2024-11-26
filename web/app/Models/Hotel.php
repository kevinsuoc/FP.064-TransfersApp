<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hotel extends Model
{
    use HasFactory;
    protected $table = 'p3_transfer_hotel';
    protected $primaryKey = 'id_hotel';
    public $timestamps = false;

    public function zona(): BelongsTo {
        return $this->belongsTo(Zona::class, 'id_zona', 'id_zona');
    }

    public function precio(): HasMany {
        return $this->hasMany(Precio::class, 'id_hotel', 'id_hotel');
    }

    public function reservas(): HasMany {
        return $this->hasMany(Reserva::class, 'id_hotel', 'id_hotel');
    }
}
