<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Precio;
use App\Models\Vehiculo;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

// Mas detalles acerca de cada método se encuentran en la clase Zona (Son análogos) y documentación.
// https://laravel.com/docs/10.x/controllers#restful-partial-resource-routes
class PrecioController extends Controller
{
    public function index()
    {
        $precios = Precio::all();
        return view('admin.panel.precio.index', ['precios' => $precios]);    
    }

    public function create()
    {
        $vehiculos = Vehiculo::all();
        $hoteles = Hotel::all();
        return view ('admin.panel.precio.create', ['vehiculos' => $vehiculos, 'hoteles' => $hoteles]);
    }

    public function store(Request $request)
    {
        $this->validar($request);
        $this->setData($request, new Precio());
        return redirect()->route('precio.index')->with('success', 'Precio creado');
    }

    public function edit(string $id)
    {
        $vehiculos = Vehiculo::all();
        $hoteles = Hotel::all();
        $precio = Precio::find($id);
        return view ('admin.panel.precio.edit', ['precio' => $precio, 'vehiculos' => $vehiculos, 'hoteles' => $hoteles]);
    }

    public function update(Request $request, string $id)
    {
        $this->validar($request);
        $this->setData($request, Precio::find($id)); 
    }

    public function destroy(string $id)
    {
        Precio::destroy($id);
        return redirect()->route('precio.index')->with('success', 'Precio eliminado');
    }

    private function validar(Request $request){
        $request->validateWithBag('validacion',[
            'id_hotel' => ['required'],
            'id_vehiculo' => ['required'],
            'precio' => ['required', 'numeric', 'min:0'],
        ]);
        if (!Precio::isUnique($request->id_hotel, $request->id_vehiculo)){
            return redirect()->back()->withErrors(['precio_unico' => 'El hotel y vehículo ya tienen precio.'], 'validacion');
        }
    }

    private function setData(Request $request, Precio $precio){
        $precio->id_hotel = $request->id_hotel;
        $precio->id_vehiculo = $request->id_vehiculo;
        $precio->precio = $request->precio;
        $precio->save();
    }
}