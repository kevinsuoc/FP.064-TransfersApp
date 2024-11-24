<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;
    protected $table = 'p3_transfer_reserva';
    protected $primaryKey = 'id_reserva';
    public $timestamps = false;

}
