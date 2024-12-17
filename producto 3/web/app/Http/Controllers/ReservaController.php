<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Precio;
use App\Models\Reserva;
use App\Models\TipoReserva;
use DateTime;
use Exception;
use Illuminate\Http\Request;

// Mas detalles acerca de cada método se encuentran en la clase Zona (Son análogos) y documentación.
// https://laravel.com/docs/10.x/controllers#restful-partial-resource-routes
class ReservaController extends Controller
{
    public function index(Request $request)
    {
        switch (session('userType')){
            case 'admin':
                return $this->indexAdmin($request);
            case 'user':
                $reservas = Reserva::where('email_cliente', operator: session()->get('user')->email)->get();
                return view('panel.reserva.user.index', ['reservas' => $reservas]);
            case 'corporate':
                return $this->indexCorporate($request);
            default: return redirect()->route('homepage');
        }
    }

    private function indexCorporate(Request $request){
        if ($request->mes){
            $reservas = Reserva::where(function ($query) use ($request) {
                $query->whereRaw('YEAR(fecha_entrada) = ?', [$request->anyo])
                      ->whereRaw('MONTH(fecha_entrada) = ?', [$request->mes])
                ->orWhere(function ($query) use ($request) {
                    $query->whereRaw('YEAR(fecha_salida) = ?', [$request->anyo])
                          ->whereRaw('MONTH(fecha_salida) = ?', [$request->mes]);
                });
            })
            ->where('id_hotel', session('user')->id_hotel)
            ->get();
            $totalComisiones = 0;
            foreach($reservas as $reserva){
                if ($reserva->id_tipo_reserva == 3){
                    $diaEntrada = new DateTime($reserva->fecha_entrada);
                    $diaSalida = new DateTime($reserva->fecha_salida);
                    if ($diaEntrada->format('Y') == $request->anyo && 
                    $diaEntrada->format('m') == str_pad($request->mes, 2, '0', STR_PAD_LEFT)) {
                        $totalComisiones += ($reserva->precio->precio) * session('user')->comision / 100;
                    }
                    if ($diaSalida->format('Y') == $request->anyo && 
                    $diaSalida->format('m') == str_pad($request->mes, 2, '0', STR_PAD_LEFT)) {
                        $totalComisiones += ($reserva->precio->precio) * session('user')->comision / 100;
                    }
                }
                else{ 
                    $totalComisiones += ($reserva->precio->precio) * session('user')->comision / 100;
                }
            }
            return view('panel.reserva.corporate.index', [
                'reservas' => $reservas,
                'mes' => $request->mes,
                'anyo' => $request->anyo,
                'totalComisiones' => $totalComisiones]);
        }
        $reservas = Reserva::where('id_hotel', 
        session('user')->id_hotel)->orWhereHas('precio',
        function($query) {
            $query->where('id_hotel', session('user')->id_hotel);
        })->get();
        return view('panel.reserva.corporate.index', ['reservas' => $reservas]);
    }

    private function indexAdmin($request){
        if ($request->mes){
            $hotel = Hotel::find($request->id_hotel);
            $reservas = Reserva::where(function ($query) use ($request) {
                $query->whereRaw('YEAR(fecha_entrada) = ?', [$request->anyo])
                      ->whereRaw('MONTH(fecha_entrada) = ?', [$request->mes])
                ->orWhere(function ($query) use ($request) {
                    $query->whereRaw('YEAR(fecha_salida) = ?', [$request->anyo])
                          ->whereRaw('MONTH(fecha_salida) = ?', [$request->mes]);
                });
            })
            ->where('id_hotel', $hotel->id_hotel)
            ->get();
            $totalComisiones = 0;
            foreach($reservas as $reserva){
                if ($reserva->id_tipo_reserva == 3){
                    $diaEntrada = new DateTime($reserva->fecha_entrada);
                    $diaSalida = new DateTime($reserva->fecha_salida);
                    if ($diaEntrada->format('Y') == $request->anyo && 
                    $diaEntrada->format('m') == str_pad($request->mes, 2, '0', STR_PAD_LEFT)) {
                        $totalComisiones += ($reserva->precio->precio) * $hotel->comision / 100;
                    }
                    if ($diaSalida->format('Y') == $request->anyo && 
                    $diaSalida->format('m') == str_pad($request->mes, 2, '0', STR_PAD_LEFT)) {
                        $totalComisiones += ($reserva->precio->precio) * $hotel->comision / 100;
                    }
                }
                else{ 
                    $totalComisiones += ($reserva->precio->precio) * $hotel->comision / 100;
                }
            }
            return view('panel.reserva.admin.index', [
            'reservas' => $reservas,
            'mes' => $request->mes,
            'anyo' => $request->anyo,
            'hotel' => $hotel,
            'id_hotel' => $request->id_hotel,
            'hoteles' => Hotel::all(), 
            'totalComisiones' => $totalComisiones]);
        }
        return view('panel.reserva.admin.index', ['reservas' => Reserva::all(), 'hoteles' => Hotel::all()]);
    }

    public function create()
    {
        $tiposReserva = TipoReserva::all();
        switch (session('userType')){
            case 'admin':
                $precios = Precio::all();
                return view ('panel.reserva.admin.create', ['tiposReserva' => $tiposReserva, 'precios' => $precios]);
            case 'user':
                $precios = Precio::all();
                return view ('panel.reserva.user.create', ['tiposReserva' => $tiposReserva, 'precios' => $precios]);
            case 'corporate':
                $precios = Precio::where('id_hotel', session('user')->id_hotel)->get();
                return view ('panel.reserva.corporate.create', ['tiposReserva' => $tiposReserva, 'precios' => $precios]);
            default: return redirect()->route('homepage');
        }
    }

    public function store(Request $request)
    {
        $reserva = New Reserva();
        $reserva->localizador = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
        if (!$this->validarFechaYHoraFromData($request)){
            return redirect()->back()->withErrors(['fecha' => 'Se deben agregar reservas con 48 horas de antelación'], 'validacion')->withInput();
        }
        switch ($request->id_tipo_reserva){
            case 1: $this->validarTipo1($request); $this->setDataTipo1($request, $reserva); break; 
            case 2: $this->validarTipo2($request); $this->setDataTipo2($request, $reserva); break;
            case 3: $this->validarTipo3($request); $this->setDataTipo3($request, $reserva); break;
        };
        $reserva->save();
        switch (session('userType')){
            case 'admin': return redirect()->route('reserva.index')->with('success', 'Reserva creada');
            case 'user': return redirect()->route('userReserva.index')->with('success', 'Reserva creada');
            case 'corporate': return redirect()->route('corporateReserva.index')->with('success', 'Reserva creada');
            default: return redirect()->route('homepage');
        }
    }

    public function edit(string $id)
    {
        $reserva = Reserva::find($id);
        switch (session('userType')){
            case 'admin':
                $precios = Precio::all();
                return view('panel.reserva.admin.edit', ['reserva' => $reserva, 'precios' => $precios]);
            case 'user':
                $precios = Precio::all();
                return view('panel.reserva.user.edit', ['reserva' => $reserva, 'precios' => $precios]);
            case 'corporate':
                $precios = Precio::where('id_hotel', session('user')->id_hotel)->get(); 
                return view('panel.reserva.corporate.edit', ['reserva' => $reserva, 'precios' => $precios]);
            default: return redirect()->route('homepage');
        }
    }

    public function update(Request $request, string $id)
    {
        $reserva = Reserva::find($id);
        if (!$this->validarFechaYHoraFromData($request) || !$this->validarFechaYHoraFromData($reserva)){
            return redirect()->back()->withErrors(['fecha' => 'Se deben modificar reservas con 48 horas de antelación'], 'validacion');
        }
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
        $reserva = Reserva::find($id);
        if (!$this->validarFechaYHoraFromData($reserva)){
            return redirect()->back()->withErrors(['fecha' => 'Se deben eliminar reservas con 48 horas de antelación'], 'validacion');
        }
        Reserva::destroy($id);
        switch(session('userType')){
            case 'admin': return redirect()->route('reserva.index')->with('success', 'Reserva eliminada');
            case 'user': return redirect()->route('userReserva.index')->with('success', 'Reserva eliminada');
            case 'corporate': return redirect()->route('corporateReserva.index')->with('success', 'Reserva eliminada');
            default: return redirect()->route('homepage');
        }
    }

    private function setDataOfAllTypes(Request $request, Reserva $reserva){
        switch (session('userType')){
            case 'admin':
                $reserva->email_cliente = $request->email_cliente;
                break;
            case 'user':
                $reserva->email_cliente = session()->get('user')->email;
                $reserva->id_viajero = session()->get('user')->id_viajero;
                break;
            case 'corporate':
                $reserva->email_cliente = $request->email_cliente;
                $reserva->id_hotel = session()->get('user')->id_hotel;
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
    }

    private function validarTipo1(Request $request){
        $rules = [
            'id_tipo_reserva' => ['required'],
            'num_viajeros' => ['required', 'numeric', 'between:1,3'],
            'id_precio' => ['required'],

            'fecha_entrada' => ['required', 'date', 'after:today'],
            'hora_entrada' => ['required'],
            'numero_vuelo_entrada' => ['required', 'between:2,50', 'string'],
            'origen_vuelo_entrada' => ['required', 'between:2,50', 'string'],
        ];

        $mensajes = [
            'between' => 'El campo debe ser entre :min y :max.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'after' => 'La fecha debe ser luego de hoy'
        ];

        if (session('userType') != 'user'){
            $rules['email_cliente'] = ['required', 'email'];
        }

        $request->validateWithBag('validacion', $rules, $mensajes);
    }

    private function validarTipo2(Request $request){
        $rules = [
            'id_tipo_reserva' => ['required'],
            'num_viajeros' => ['required', 'numeric', 'between:1,3'],
            'id_precio' => ['required'],

            'fecha_salida' => ['required', 'date', 'after:today'],
            'hora_salida' => ['required'],
            'numero_vuelo_salida' => ['required',  'between:2,50', 'string'],
            'hora_recogida' => ['required'],
        ];

        $mensajes = [
            'between' => 'El campo debe ser entre :min y :max.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'after' => 'La fecha debe ser luego de hoy'
        ];

        if (session('userType') != 'user'){
            $rules['email_cliente'] = ['required', 'email'];
        }

        $request->validateWithBag('validacion', $rules, $mensajes);
    }

    private function validarTipo3(Request $request){
        $rules = [
            'id_tipo_reserva' => ['required'],
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

        $mensajes = [
            'between' => 'El campo debe ser entre :min y :max.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'after.fecha_entrada' => 'La fecha debe ser luego de hoy',
            'after.fecha_salida' => 'La fecha de salida debe ser luego que la de entrada',
        ];

        if (session('userType') != 'user'){
            $rules['email_cliente'] = ['required', 'email'];
        }

        $request->validateWithBag('validacion', $rules, $mensajes);
    }

    private function validarFechaYHoraFromData($data){
        if (session('userType') != 'user')
            return true;
        switch ($data->id_tipo_reserva){
            case 1:
                $diaReserva = $data->fecha_entrada;
                $horaReserva = $data->hora_entrada;
                break;
            case 2:
            case 3:
            default:
                $diaReserva = $data->fecha_salida;
                $horaReserva = $data->hora_salida;
                break ;
        }

        if (strlen($horaReserva) == 8) {
            $horaReserva = substr($horaReserva, 0, 5);
        }
        
        $fechaHoraReserva = DateTime::createFromFormat('Y-m-d H:i', "$diaReserva $horaReserva");
        $fechaHoraActual = new DateTime();

        $diferenciaHoras = $fechaHoraActual->diff($fechaHoraReserva)->h + $fechaHoraActual->diff($fechaHoraReserva)->days * 24;

        return $diferenciaHoras >= 48;
    }
}
