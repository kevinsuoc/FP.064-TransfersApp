<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Precio extends Model
{
    use HasFactory;
    protected $table = 'p3_transfer_precio';
    protected $primaryKey = 'id_precio';
    public $timestamps = false;

}
