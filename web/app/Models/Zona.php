<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Zona extends Model
{
    use HasFactory;
    protected $table = 'p3_transfer_zona';
    protected $primaryKey = 'id_zona';
    public $timestamps = false;

    public function hoteles(): HasMany {
        return $this->hasMany(Hotel::class, 'id_hotel', 'id_hotel');
    }
}
