<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viajero extends Model
{
    use HasFactory;
    protected $table = 'p3_transfer_viajero';
    protected $primaryKey = 'id_viajero';
    const CREATED_AT = 'fecha_reserva';
    const UPDATED_AT = 'fecha_modificacion';
    
}
