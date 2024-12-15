<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Models\Precio;
use App\Models\Vehiculo;
use App\Models\Hotel;
use App\Models\TipoReserva;
use Carbon\Carbon;



class CalendarioController extends Controller
{

    public function index(Request $request)
    {
        if (!$request->has('tipo')){
            $request->merge([
                'tipo' => 'mensual',
                'anyo' => now()->year,
                'mes' => now()->month,
                'semana' => now()->weekOfYear,
                'dia' => now()->toDateString(),
            ]);
        }
        return $this->mostrarCalendario($request);
        //return view('panel.calendario.index', compact('filtroData', 'filtroData'));
    }
    private function mostrarCalendario($request)
    {
        
        $filtroData = $this->obtenerDataFiltro($request);
        //error_log(print_r($filtroData,true));
        //Preparar los trayectos
        $reservas = match ($filtroData['tipo']) {
            'diaria' => Reserva::getByTrayectoDate($filtroData['dia']),
            'mensual' => Reserva::getByTrayectoMonth($filtroData['anyo'], $filtroData['mes']),
            'semanal' => Reserva::getByTrayectoWeek($filtroData['anyo'], $filtroData['semana']),
            default => [],
        };

        $trayectos = $this->procesarTrayectos($reservas, $filtroData);

        error_log(print_r($filtroData,true));
        error_log(print_r($trayectos,true));

        return view('panel.calendario.index', ['trayectos'=>$trayectos, 'filtroData'=>$filtroData]);
    }

    private function obtenerDataFiltro($request): array
    {
        return [
            'tipo' => $request->input('tipo', 'diaria'),
            'dia' => $request->input('dia', now()->toDateString()),
            'anyo' => $request->input('anyo', now()->year),
            'mes' => $request->input('mes', now()->month),
            'semana' => $request->input('semana', now()->weekOfYear),
        ];
    }

    private function procesarTrayectos(Collection $reservas, array $filtroData): array
    {
        //error_log('He llegado a procesar trayectos');

        $trayectos = [];

        foreach ($reservas as $reserva) {
            if($this->dentroDeFecha($filtroData, $reserva->fecha_entrada) || $this->dentroDeFecha($filtroData, $reserva->fecha_salida)){
            $precio = Precio::find($reserva->id_precio);
            $vehiculo = Vehiculo::find($precio->id_vehiculo);
            $hotel = Hotel::find($precio->id_hotel);

            $trayecto = [];
            $trayecto['id'] = $reserva->id_reserva;
            $trayecto['tipoid'] =  $reserva->id_tipo_reserva;
            $trayecto['tipo'] = TipoReserva::find($reserva->id_tipo_reserva)->descripcion;
            $trayecto['localizador'] = $reserva->localizador;
            $trayecto['email'] = $reserva->email_cliente;
            $trayecto['num_viajeros'] = $reserva->num_viajeros;
            if (isset($vehiculo) && $vehiculo !== null){
                $trayecto['vehiculo'] = $vehiculo->descripcion;
                $trayecto['email_conductor'] = $vehiculo->email_conductor;
            }

			if ($reserva->id_tipo_reserva == 1 || $reserva->id_tipo_reserva ==3){
				$trayecto['dia_entrada'] = $reserva->fecha_entrada;
				$trayecto['hora_entrada'] = $reserva->hora_entrada;
				$trayecto['origen_entrada'] = $reserva->origen_vuelo_entrada;
				$trayecto['destino'] = $hotel->usuario;
				$trayecto['numero_vuelo_entrada'] = $reserva->numero_vuelo_entrada;
                $trayecto['dia'] = $reserva->fecha_entrada;
                $trayecto['hora'] = $reserva->hora_entrada;


				
			};
            if($reserva->id_tipo_reserva == 2 || $reserva->id_tipo_reserva == 3){
				$trayecto['dia_salida'] = $reserva->fecha_salida;
				$trayecto['hora_salida'] = $reserva->hora_salida;
				$trayecto['hora_recogida'] = $reserva->hora_recogida;
				$trayecto['origen'] = $hotel->usuario;
				$trayecto['numero_vuelo_salida'] = $reserva->numero_vuelo_salida;
                if($reserva->id_tipo_reserva == 2){
                $trayecto['dia'] = $reserva->fecha_salida;
				$trayecto['hora'] = $reserva->hora_salida;
                }
			}
            $trayectos[] = $trayecto;
        }
		}
        //print_r($trayectos);
		usort($trayectos, callback: [$this, 'comparar']);
        //print_r($trayectos);


        return $trayectos;
    }

    private function comparar($a, $b)
    {
        return strtotime($a['dia'] . ' ' . $a['hora']) <=> strtotime($b['dia'] . ' ' . $b['hora']);
    }


    private function dentroDeFecha($filtroData, $fecha) {
        if($fecha == null)return false;
		$fechaDate = Carbon::parse($fecha);
		switch ($filtroData['tipo']) {
			case 'diaria': 
				$filtroDate = Carbon::parse($filtroData['dia']);
				return $fechaDate->isSameDay($filtroData['dia']);
			case 'semanal':
				$anyoReserva = $fechaDate->year;
				$semanaReserva = $fechaDate->weekOfYear;
				return $filtroData['anyo'] == strval($anyoReserva) && $filtroData['semana'] == strval($semanaReserva);
			case 'mensual':
				$month = str_pad($filtroData['mes'], 2, '0', STR_PAD_LEFT);
				$year = $filtroData['anyo'];
				return $fechaDate->format('Y-m') === "$year-$month";
			default:
				return false;
		}
	}
}
