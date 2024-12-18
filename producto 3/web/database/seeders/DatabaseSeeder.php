<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Reserva;
use App\Models\Hotel;
use App\Models\TipoReserva;
use App\Models\Precio;
use App\Models\Vehiculo;
use App\Models\Viajero;
use App\Models\Zona;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $sqlFile = database_path('seeders/codecrafters.sql');

        DB::unprepared(file_get_contents($sqlFile));

        // DB::transaction(function () {
        //     TipoReserva::insert([
        //         ['descripcion' => 'aeropuerto-hotel'],
        //         ['descripcion' => 'hotel-aeropuerto'],
        //         ['descripcion' => 'ida-y-vuelta'],
        //     ]);

        //     Vehiculo::insert([
        //         ['descripcion' => 'Matricula T4874EMD', 'email_conductor' => 'isabelgonzales@appuoc.edu'],
        //         ['descripcion' => 'Matricula K2453RFA', 'email_conductor' => 'saraygutierrez@appuoc.edu'],
        //         ['descripcion' => 'Matricula L7637EHK', 'email_conductor' => 'juansantos@appuoc.edu'],
        //         ['descripcion' => 'Matricula D1187HRY', 'email_conductor' => 'mariamejia@appuoc.edu'],
        //         ['descripcion' => 'Matricula W9365GEW', 'email_conductor' => 'rogeliofuster@appuoc.edu'],
        //         ['descripcion' => 'Matricula A0590KTD', 'email_conductor' => 'antoniogamero@appuoc.edu'],
        //     ]);

        //     Zona::insert([
        //         ['descripcion' => 'Bosque'],
        //         ['descripcion' => 'Playa'],
        //         ['descripcion' => 'Montaña'],
        //         ['descripcion' => 'Cabañas'],
        //         ['descripcion' => 'Palmeras'],
        //     ]);

        //     Hotel::insert([
        //         ['id_zona' => Zona::where('descripcion', 'Bosque')->value('id_zona'),
        //         'comision' => 5.5,
        //         'usuario' => 'Hotel de los bosques',
        //         'password' => null],
        //         ['id_zona' => Zona::where('descripcion', 'Bosque')->value('id_zona'),
        //         'comision' => 3.5,
        //         'usuario' => 'Hotel escondido',
        //         'password' => '$2y$12$5QSli.mu77xWMBOQfJCIqOnIQOUU5XUIXw8VpC3DobGDMw8GSEQFW'],
        //         ['id_zona' => Zona::where('descripcion', 'Playa')->value('id_zona'),
        //         'comision' => 10,
        //         'usuario' => 'Resort Playa',
        //         'password' => '$2y$12$9IG5xnLaByMO85AogjHkr.D50l2O.xWlPquecYk5juVYpY5E8.f1e'],
        //         ['id_zona' => Zona::where('descripcion', 'Montaña')->value('id_zona'),
        //         'comision' => 15,
        //         'usuario' => 'Pico montaña',
        //         'password' => null],
        //         ['id_zona' => Zona::where('descripcion', 'Cabañas')->value('id_zona'),
        //         'comision' => 10,
        //         'usuario' => 'Centro Isla',
        //         'password' => null],
        //         ['id_zona' => Zona::where('descripcion', 'Palmeras')->value('id_zona'),
        //         'comision' => 20.5,
        //         'usuario' => 'Casa Del Arbol',
        //         'password' => null],
        //     ]);

        //     Precio::insert([
        //         ['id_vehiculo' => Vehiculo::where('email_conductor', 'isabelgonzales@appuoc.edu')->value('id_vehiculo'),
        //         'id_hotel' => Hotel::where('usuario', 'Hotel de los bosques')->value('id_hotel'),
        //         'precio' => 15],
        //         ['id_vehiculo' => Vehiculo::where('email_conductor', 'saraygutierrez@appuoc.edu')->value('id_vehiculo'),
        //         'id_hotel' => Hotel::where('usuario', 'Hotel escondido')->value('id_hotel'),
        //         'precio' => 25,],
        //         ['id_vehiculo' => Vehiculo::where('email_conductor', 'juansantos@appuoc.edu')->value('id_vehiculo'),
        //         'id_hotel' => Hotel::where('usuario', 'Resort Playa')->value('id_hotel'),
        //         'precio' => 5,],
        //         ['id_vehiculo' => Vehiculo::where('email_conductor', 'mariamejia@appuoc.edu')->value('id_vehiculo'),
        //         'id_hotel' => Hotel::where('usuario', 'Pico montaña')->value('id_hotel'),
        //         'precio' => 10.5,],
        //         ['id_vehiculo' => Vehiculo::where('email_conductor', 'rogeliofuster@appuoc.edu')->value('id_vehiculo'),
        //         'id_hotel' => Hotel::where('usuario', 'Centro Isla')->value('id_hotel'),
        //         'precio' => 11.2,],
        //         ['id_vehiculo' => Vehiculo::where('email_conductor', 'antoniogamero@appuoc.edu')->value('id_vehiculo'),
        //         'id_hotel' => Hotel::where('usuario', 'Casa Del Arbol')->value('id_hotel'),
        //         'precio' => 23,],
        //     ]);
        // });
    }
}
