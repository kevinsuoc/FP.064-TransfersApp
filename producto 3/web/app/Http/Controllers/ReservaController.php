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
    private $userType; 

    public function __construct()
    {
        $this->userType = session('userType');
    }

    public function index()
    {
        switch ($this->userType){
            case 'admin':
                return view('panel.reserva.admin.index', ['reservas' => Reserva::all()]);
            case 'user':
                $reservas = Reserva::where('email_cliente', operator: session()->get('user')->email)->get();
                return view('panel.reserva.user.index', ['reservas' => $reservas]);
            case 'corporate':
                //
            default: return redirect()->route('homepage');
        }
    }

    public function create()
    {
        $tiposReserva = TipoReserva::all();
        $precios = Precio::all();
        switch ($this->userType){
            case 'admin':
                return view ('panel.reserva.admin.create', ['tiposReserva' => $tiposReserva, 'precios' => $precios]);
            case 'user':
                return view ('panel.reserva.user.create', ['tiposReserva' => $tiposReserva, 'precios' => $precios]);
            case 'corporate':
                return view ('panel.reserva.admin.create', ['tiposReserva' => $tiposReserva, 'precios' => $precios]);
            default: return redirect()->route('homepage');
        }
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
        switch ($this->userType){
            case 'admin': return redirect()->route('reserva.index')->with('success', 'Reserva creada');
            case 'user': return redirect()->route('userReserva.index')->with('success', 'Reserva creada');
            case 'corporate': //
            default: return redirect()->route('homepage');
        }
    }

    public function edit(string $id)
    {
        $reserva = Reserva::find($id);
        $precios = Precio::all();
        switch ($this->userType){
            case 'admin':  return view('panel.reserva.admin.edit', ['reserva' => $reserva, 'precios' => $precios]);
            case 'user': return view('panel.reserva.user.edit', ['reserva' => $reserva, 'precios' => $precios]);;
            case 'corporate': //
            default: return redirect()->route('homepage');
        }
    }


    public function update(Request $request, string $id)
    {
        $reserva = Reserva::find($id);
        switch ($reserva->id_tipo_reserva){
            case 1:
                $this->validarTipo1($request);
                $this->setDataTipo1($request, $reserva);
                break;
            case 2:
                $this->validarTipo2($request);
                $this->setDataTipo2($request, $reserva);
                break;
            case 3:
                $this->validarTipo3($request);
                $this->setDataTipo1($request, $reserva);
                $this->setDataTipo2($request, $reserva); 
                break;
        };
        $reserva->save();
        return redirect()->back()->with('success', 'Reserva actualizada');
    }

    public function destroy(string $id)
    {
        Reserva::destroy($id);
        switch($this->userType){
            case 'admin': return redirect()->route('reserva.index')->with('success', 'Reserva eliminada');
            case 'user': return redirect()->route('userReserva.index')->with('success', 'Reserva eliminada');
            case 'corporate':
            default: return redirect()->route('homepage');
        }
    }

    private function setDataOfAllTypes(Request $request, Reserva $reserva){
        switch ($this->userType){
            case 'admin':
                $reserva->email_cliente = $request->email_cliente;
                break;
            case 'user':
                $reserva->email_cliente = session()->get('user')->email;
                $reserva->id_viajero = session()->get('user')->id_viajero;
                break;
            case 'corporate':
                break;
        }
        $reserva->id_tipo_reserva = $request->id_tipo_reserva;
        $reserva->num_viajeros = $request->num_viajeros;
        $reserva->id_precio = $request->id_precio;
    }

    private function setDataTipo1(Request $request, Reserva $reserva){
        $this->setDataOfAllTypes($request, $reserva);

        $reserva->fecha_entrada = $request->fecha_entrada;
        $reserva->hora_entrada = $request->hora_entrada;
        $reserva->numero_vuelo_entrada = $request->numero_vuelo_entrada;
        $reserva->origen_vuelo_entrada = $request->origen_vuelo_entrada;
    }

    private function setDataTipo2(Request $request, Reserva $reserva){
        $this->setDataOfAllTypes($request, $reserva);

        $reserva->fecha_salida = $request->fecha_salida;
        $reserva->hora_salida = $request->hora_salida;
        $reserva->numero_vuelo_salida = $request->numero_vuelo_salida;
        $reserva->hora_recogida = $request->hora_recogida;
    }
    
    private function setDataTipo3(Request $request, Reserva $reserva){
        $this->setDataOfAllTypes($request, $reserva);
        $this->setDataTipo1($request, $reserva);
        $this->setDataTipo2($request, $reserva);
        $reserva->save();
    }

    private function validarTipo1(Request $request){
        $rules = [
            'id_tipo_reserva' => ['required'],
            'email_cliente' => ['required',  'email'],
            'num_viajeros' => ['required', 'numeric', 'between:1,3'],
            'id_precio' => ['required'],

            'fecha_entrada' => ['required', 'date', 'after:today'],
            'hora_entrada' => ['required'],
            'numero_vuelo_entrada' => ['required', 'between:2,50', 'string'],
            'origen_vuelo_entrada' => ['required', 'between:2,50', 'string'],
        ];

        $request->validateWithBag('validacion', $rules);
    }

    private function validarTipo2(Request $request){
        $rules = [
            'id_tipo_reserva' => ['required'],
            'email_cliente' => ['required',  'email'],
            'num_viajeros' => ['required', 'numeric', 'between:1,3'],
            'id_precio' => ['required'],

            'fecha_salida' => ['required', 'date', 'after:today'],
            'hora_salida' => ['required'],
            'numero_vuelo_salida' => ['required',  'between:2,50', 'string'],
            'hora_recogida' => ['required'],
        ];

        $request->validateWithBag('validacion', $rules);
    }

    private function validarTipo3(Request $request){
        $rules = [
            'id_tipo_reserva' => ['required'],
            'email_cliente' => ['required',  'email'],
            'num_viajeros' => ['required', 'numeric', 'between:1,3'],
            'id_precio' => ['required'],

            'fecha_entrada' => ['required', 'date', 'after:today'],
            'hora_entrada' => ['required'],
            'numero_vuelo_entrada' => ['required', 'between:2,50', 'string'],
            'origen_vuelo_entrada' => ['required', 'between:2,50', 'string'],

            'fecha_salida' => ['required', 'date', 'after:today', 'after:fecha_entrada'],
            'hora_salida' => ['required'],
            'numero_vuelo_salida' => ['required',  'between:2,50', 'string'],
            'hora_recogida' => ['required'], 
        ];

        $request->validateWithBag('validacion', $rules);
    }
}
