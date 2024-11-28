<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\TipoReserva;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

// Mas detalles acerca de cada método se encuentran en la clase Zona (Son análogos) y documentación.
// https://laravel.com/docs/10.x/controllers#restful-partial-resource-routes
class ReservaController extends Controller
{
    public function index()
    {
        return view('panel.reserva.index');
    }

    public function create()
    {
        $tiposReserva = TipoReserva::all();
        $vehiculos = Vehiculo::all();
        $hoteles = Hotel::add();
    }

    public function store(Request $request)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}