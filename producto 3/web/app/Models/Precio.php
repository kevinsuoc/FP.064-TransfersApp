<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Precio extends Model
{
    use HasFactory;
    protected $table = 'p3_transfer_precio';
    protected $primaryKey = 'id_precio';
    public $timestamps = false;

    public function vehiculo(): BelongsTo {
        return $this->belongsTo(Vehiculo::class, 'id_vehiculo', 'id_vehiculo');
    }

    public function hotel(): BelongsTo {
        return $this->belongsTo(Hotel::class, 'id_hotel', 'id_hotel');
    }

    public static function isUnique($hotel, $vehiculo)
    {
        return !self::where('id_hotel', $hotel)
                    ->where('id_vehiculo', $vehiculo)
                    ->exists();
    }
    
    public static function isUniqueAndDifferent($hotel, $vehiculo, $precio)
    {
        return !self::where('id_hotel', $hotel)
                    ->where('id_vehiculo', $vehiculo)
                    ->where('id_precio', '!=', $precio)
                    ->exists();
    }
}
