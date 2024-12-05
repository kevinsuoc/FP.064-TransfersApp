<?php

namespace App\Http\Controllers;

use App\Models\Precio;
use App\Models\Reserva;
use App\Models\TipoReserva;
use Illuminate\Http\Request;

// Mas detalles acerca de cada método se encuentran en la clase Zona (Son análogos) y documentación.
// https://laravel.com/docs/10.x/controllers#restful-partial-resource-routes
class ReservaController extends Controller
{
    public function index()
    {
        return view('panel.reserva.index', ['reservas' => Reserva::all()]);
    }

    public function create()
    {
        $tiposReserva = TipoReserva::all();
        $precios = Precio::all();
        return view ('panel.reserva.create', ['tiposReserva' => $tiposReserva, 'precios' => $precios]);
    }

    public function store(Request $request)
    {
        $reserva = New Reserva();
        $reserva->localizador = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
        switch ($request->id_tipo_reserva){
            case 1: $this->validarTipo1($request); $this->setDataTipo1($request, $reserva); break;
            case 2: $this->validarTipo2($request); $this->setDataTipo2($request, $reserva); break;
            case 3: $this->validarTipo3($request); $this->setDataTipo3($request, $reserva); break;
        };
        return redirect()->route('reserva.index')->with('success', 'Reserva creada');

    }

    public function edit(string $id)
    {
        $reserva = Reserva::find($id);
        return view('panel.reserva.edit', ['reserva' => $reserva]);
    }

    public function update(Request $request, string $id)
    {
        $this->validar($request);
        $this->setData($request, Reserva::find($id)); 
        return redirect()->back()->with('success', 'Reserva actualizada');
    }

    public function destroy(string $id)
    {
        Reserva::destroy($id);
        return redirect()->route('reserva.index')->with('success', 'Reserva eliminada');  
    }

    private function setDataTipo1(Request $request, Reserva $reserva){
        $reserva->id_tipo_reserva = $request->id_tipo_reserva;
        $reserva->email_cliente = $request->email_cliente;
        $reserva->num_viajeros = $request->num_viajeros;
        $reserva->id_precio = $request->id_precio;
        $reserva->id_viajero = $request->id_viajero;
        $reserva->id_hotel = $request->id_hotel;

        $reserva->fecha_entrada = $request->fecha_entrada;
        $reserva->hora_entrada = $request->hora_entrada;
        $reserva->numero_vuelo_entrada = $request->numero_vuelo_entrada;
        $reserva->origen_vuelo_entrada = $request->origen_vuelo_entrada;

        $reserva->save();
    }

    private function setDataTipo2(Request $request, Reserva $reserva){
        $reserva->id_tipo_reserva = $request->id_tipo_reserva;
        $reserva->email_cliente = $request->email_cliente;
        $reserva->num_viajeros = $request->num_viajeros;
        $reserva->id_precio = $request->id_precio;
        $reserva->id_viajero = $request->id_viajero;
        $reserva->id_hotel = $request->id_hotel;

        $reserva->fecha_salida = $request->fecha_salida;
        $reserva->hora_salida = $request->hora_salida;
        $reserva->numero_vuelo_salida = $request->numero_vuelo_salida;
        $reserva->hora_recogida = $request->hora_recogida;

        $reserva->save();
    }
    
    private function setDataTipo3(Request $request, Reserva $reserva){
        $reserva->id_tipo_reserva = $request->id_tipo_reserva;
        $reserva->email_cliente = $request->email_cliente;
        $reserva->num_viajeros = $request->num_viajeros;
        $reserva->id_precio = $request->id_precio;
        $reserva->id_viajero = $request->id_viajero;
        $reserva->id_hotel = $request->id_hotel;

        $reserva->fecha_entrada = $request->fecha_entrada;
        $reserva->hora_entrada = $request->hora_entrada;
        $reserva->numero_vuelo_entrada = $request->numero_vuelo_entrada;
        $reserva->origen_vuelo_entrada = $request->origen_vuelo_entrada;

        $reserva->fecha_salida = $request->fecha_salida;
        $reserva->hora_salida = $request->hora_salida;
        $reserva->numero_vuelo_salida = $request->numero_vuelo_salida;
        $reserva->hora_recogida = $request->hora_recogida;

        $reserva->save();
    }

    private function validarTipo1(Request $request){
        $request->validateWithBag('validacion', [
            'id_tipo_reserva' => ['required'],
            'email_cliente' => ['required',  'email'],
            'num_viajeros' => ['required', 'numeric', 'between:1,3'],
            'id_precio' => ['required'],

            'fecha_entrada' => ['required', 'date'],
            'hora_entrada' => ['required'],
            'numero_vuelo_entrada' => ['required', 'between:2,50', 'string'],
            'origen_vuelo_entrada' => ['required', 'between:2,50', 'string'],
        ]);
    }

    private function validarTipo2(Request $request){
        $request->validateWithBag('validacion', [
            'id_tipo_reserva' => ['required'],
            'email_cliente' => ['required',  'email'],
            'num_viajeros' => ['required', 'numeric', 'between:1,3'],
            'id_precio' => ['required'],

            'fecha_salida' => ['required', 'date'],
            'hora_salida' => ['required'],
            'numero_vuelo_salida' => ['required',  'between:2,50', 'string'],
            'hora_recogida' => ['required'],
        ]);
    }

    private function validarTipo3(Request $request){
        $request->validateWithBag('validacion', [
            'id_tipo_reserva' => ['required'],
            'email_cliente' => ['required',  'email'],
            'num_viajeros' => ['required', 'numeric', 'between:1,3'],
            'id_precio' => ['required'],

            'fecha_entrada' => ['required', 'date'],
            'hora_entrada' => ['required'],
            'numero_vuelo_entrada' => ['required', 'between:2,50', 'string'],
            'origen_vuelo_entrada' => ['required', 'between:2,50', 'string'],

            'fecha_salida' => ['required', 'date'],
            'hora_salida' => ['required'],
            'numero_vuelo_salida' => ['required',  'between:2,50', 'string'],
            'hora_recogida' => ['required'], 
        ]);
    }
}
