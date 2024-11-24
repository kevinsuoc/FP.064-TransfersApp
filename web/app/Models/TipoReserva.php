<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoReserva extends Model
{
    use HasFactory;
    protected $table = 'p3_transfer_tipo_reserva';
    protected $primaryKey = 'id_tipo_reserva';
    public $timestamps = false;

}
