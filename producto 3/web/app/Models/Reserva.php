<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;


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

    public static function getByTrayectoMonth(int $anyo, int $mes)
    {
        $result = self::getByTrayectoMonthEntrada($anyo,$mes);
        $result2 = self::getByTrayectoMonthSalida($anyo,$mes);
        $result = $result->merge($result2);

       return $result;                      // Devuelve la colección de resultados.
    }
    public static function getByTrayectoMonthEntrada(int $anyo, int $mes)
    {
        return self::whereYear('fecha_entrada', $anyo) // Filtra por el año de la columna 'fecha'.
            ->whereMonth('fecha_entrada', $mes)       // Filtra por el mes de la columna 'fecha'.
            ->get();                          // Devuelve la colección de resultados.
    }
    public static function getByTrayectoMonthSalida(int $anyo, int $mes)
    {
        return self::whereYear('fecha_salida', $anyo) // Filtra por el año de la columna 'fecha'.
            ->whereMonth('fecha_salida', $mes)       // Filtra por el mes de la columna 'fecha'.
            ->get();                          // Devuelve la colección de resultados.
    }
    public static function getByTrayectoDate(string $dia)
    {
        $result = self::getByTrayectoDateEntrada($dia);
        $result2 = self::getByTrayectoDateSalida($dia);
        $result = $result->merge($result2);

       return $result;                        // Devuelve la colección de resultados.
    } 
    public static function getByTrayectoDateEntrada(string $dia)
    {
        return self::whereDate('fecha_entrada', $dia) // Filtra por el año de la columna 'fecha'.
            ->get();                          // Devuelve la colección de resultados.
    }
    public static function getByTrayectoDateSalida(string $dia)
    {
        return self::whereDate('fecha_salida', $dia) // Filtra por el año de la columna 'fecha'.
            ->get();                          // Devuelve la colección de resultados.
    }
    public static function getByTrayectoWeek(int $anyo, int $semana)
    {
        $result = self::getByTrayectoWeekEntrada($anyo,$semana);
        $result2 = self::getByTrayectoWeekSalida($anyo,$semana);
        $result = $result->merge($result2);

       return $result; 
    }
    public static function getByTrayectoWeekEntrada(int $anyo, int $semana)
    {
        // Obtener el inicio y fin de la semana especificada
        $fechaInicio = Carbon::now()->setISODate($anyo, $semana, 1)->startOfDay();
        $fechaFin = Carbon::now()->setISODate($anyo, $semana, 7)->endOfDay();

        return self::whereBetween('fecha_entrada', [$fechaInicio, $fechaFin])->get();
    }
    public static function getByTrayectoWeekSalida(int $anyo, int $semana)
    {
        // Obtener el inicio y fin de la semana especificada
        $fechaInicio = Carbon::now()->setISODate($anyo, $semana, 1)->startOfDay();
        $fechaFin = Carbon::now()->setISODate($anyo, $semana, 7)->endOfDay();

        return self::whereBetween('fecha_salida', [$fechaInicio, $fechaFin])->get();
    }
}
