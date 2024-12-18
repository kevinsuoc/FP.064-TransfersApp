<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use Exception;
use Illuminate\Http\Request;

// Mas detalles acerca de cada método se encuentran en la clase Zona (Son análogos) y documentación.
// https://laravel.com/docs/10.x/controllers#restful-partial-resource-routes
class VehiculoController extends Controller
{
    public function index()
    {
        $vehiculos = Vehiculo::all();
        return view('panel.vehiculo.index', ['vehiculos' => $vehiculos]);
    }

    public function create()
    {
        return view('panel.vehiculo.create');
    }

    public function store(Request $request)
    {
        $this->validar($request);
        $this->setData($request, new Vehiculo());
        return redirect()->route('vehiculo.index')->with('success', 'Vehiculo creado');
    }

    public function edit(string $id)
    {
        $vehiculo = Vehiculo::find($id);
        return view('panel.vehiculo.edit', ['vehiculo' => $vehiculo]);
    }

    public function update(Request $request, string $id)
    {
        $vehiculo = Vehiculo::find($id);

        $this->validarUpdate($request, $vehiculo);
        $this->setData($request, $vehiculo); 
        return redirect()->back()->with('success', 'Vehiculo actualizado');
    }

    public function destroy(string $id)
    {
        try {
            Vehiculo::destroy($id);
        } catch (Exception $e){
            return redirect()->route('vehiculo.index')->with('error', 'No se puede eliminar el vehiculo');
        }
        return redirect()->route('vehiculo.index')->with('success', 'Vehiculo eliminado');
    }

    
    private function validar(Request $request){
        $request->validateWithBag('validacion', [
            'descripcion' => ['required', 'between:2,50', 'string'],
            'email_conductor' => ['required', 'email', 'unique:App\Models\Vehiculo,email_conductor'],
        ], [
            'between' => 'El campo debe tener entre :min y :max caracteres.',
            'email_conductor.unique' => 'El correo electrónico ya está registrado.',
        ]);
    }

    private function validarUpdate(Request $request, Vehiculo $vehiculo){
        $rules = [
            'descripcion' => ['required', 'between:2,50', 'string'],
        ];

        $mensajes = [
            'between' => 'El campo debe tener entre :min y :max caracteres.',
            'email_conductor.unique' => 'El correo electrónico ya está registrado.',
        ];

        if ($request->email_conductor != $vehiculo->email_conductor){
            $rules['email_conductor'] = ['required', 'email', 'unique:App\Models\Vehiculo,email_conductor'];
        }

        $request->validateWithBag('validacion', $rules,$mensajes );
    }

    private function setData(Request $request, Vehiculo $vehiculo){
        $vehiculo->descripcion = $request->descripcion;
        $vehiculo->email_conductor = $request->email_conductor;
        $vehiculo->save();
    }
}
