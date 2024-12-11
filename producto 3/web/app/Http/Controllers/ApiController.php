<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Reserva;
use App\Models\Zona;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index(){
        $totalTraslados = Reserva::count();
        $zonas = Zona::all();
        $data = [];

        foreach ($zonas as $zona){
            $trasladosTotalesEnZona = 0;
            $hoteles = [];
            $hotelesZona = Hotel::where('id_zona', $zona->id_zona)->get();

            foreach ($hotelesZona as $hotel){
                $trasladosHotel = 0;
                $reservasHotel = Reserva::whereHas('precio',
                function($query) use ($hotel) {
                    $query->where('id_hotel', $hotel->id_hotel);
                })->get();

                foreach ($reservasHotel as $reserva){
                    $trasladosTotalesEnZona++;
                    $trasladosHotel++;
                }

                $hoteles[] = [
                    'nombre_hotel' => $hotel->usuario,
                    'numero_traslados' => $trasladosHotel,
                ];
            }
            $porcentajeZona = $totalTraslados > 0 ? ($trasladosTotalesEnZona / $totalTraslados) * 100 : 0;

            $data[] = [
                'zona' => $zona->descripcion, 
                'numero_traslados' => $trasladosTotalesEnZona,
                'porcentaje' => $porcentajeZona,
                'hoteles' => $hoteles
            ];
        }
        return response()->json(['data' => $data]);
    }
}
