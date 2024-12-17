<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Precio;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

// TODO: Los precios se agregan como enteros

// Mas detalles acerca de cada método se encuentran en la clase Zona (Son análogos) y documentación.
// https://laravel.com/docs/10.x/controllers#restful-partial-resource-routes
class PrecioController extends Controller
{
    public function index()
    {
        $precios = Precio::all();
        return view('panel.precio.index', ['precios' => $precios]);    
    }

    public function show(){

    }

    public function create()
    {
        $vehiculos = Vehiculo::all();
        $hoteles = Hotel::all();
        return view ('panel.precio.create', ['vehiculos' => $vehiculos, 'hoteles' => $hoteles]);
    }

    public function store(Request $request)
    {
        $this->validar($request);
        if (!Precio::isUnique($request->id_hotel, $request->id_vehiculo)){
            return redirect()->back()->withErrors(['precio_unico' => 'El hotel y vehículo ya tienen precio.'], 'validacion');
        }
        $this->setData($request, new Precio());
        return redirect()->route('precio.index')->with('success', 'Precio creado');
    }

    public function edit(string $id)
    {
        $vehiculos = Vehiculo::all();
        $hoteles = Hotel::all();
        $precio = Precio::find($id);
        return view ('panel.precio.edit', ['precio' => $precio, 'vehiculos' => $vehiculos, 'hoteles' => $hoteles]);
    }

    public function update(Request $request, string $id)
    {
        $this->validar($request);
        if (!Precio::isUniqueAndDifferent($request->id_hotel, $request->id_vehiculo, $id)){
            return redirect()->back()->withErrors(['precio_unico' => 'El hotel y vehículo ya tienen precio.'], 'validacion');
        }
        $this->setData($request, Precio::find($id));
        return redirect()->back()->with('success', 'Precio actualizado');
    }

    public function destroy(string $id)
    {
        Precio::destroy($id);
        return redirect()->route( 'precio.index')->with('success', 'Precio eliminado');
    }

    private function validar(Request $request){
        $request->validateWithBag('validacion',[
            'id_hotel' => ['required'],
            'id_vehiculo' => ['required'],
            'precio' => ['required', 'decimal:0,2', 'min:0'],
        ], [
            'between' => 'El campo debe ser entre :min y :max.',
            'decimal' => 'Formto de precio incorrecto',
            'min' => 'El precio minimo es 0',
        ]);
    }

    private function setData(Request $request, Precio $precio){
        $precio->id_hotel = $request->id_hotel;
        $precio->id_vehiculo = $request->id_vehiculo;
        $precio->precio = $request->precio;
        $precio->save();
    }
}
