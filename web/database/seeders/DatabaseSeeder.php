<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('p3_transfer_tipo_reserva')->insert([
            ['descripcion' => 'aeropuerto-hotel'],
            ['descripcion' => 'hotel-aeropuerto'],
            ['descripcion' => 'ida-y-vuelta'],
        ]);
    }
}
