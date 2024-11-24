<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;
    protected $table = 'p3_transfer_vehiculo';
    protected $primaryKey = 'id_vehiculo';
    public $timestamps = false;

}
