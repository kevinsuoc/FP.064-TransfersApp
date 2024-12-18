<?php

namespace App\Http\Controllers;

use App\Models\Zona;
use Exception;
use Illuminate\Http\Request;

class ZonaController extends Controller
{
    // Muestra todos los recursos
    public function index()
    {
        $zonas = Zona::all();
        return view('panel.zona.index', data: ['zonas' => $zonas]);
    }

    // Muestra el formulario de creación
    public function create()
    {
        return view('panel.zona.create');
    }

    // Guarda lo nuevo
    public function store(Request $request)
    {
        $this->validar($request);
        $this->setData($request, new Zona());
        return redirect()->route('zona.index')->with('success', 'Zona creada');
    }

    // Muestra el formulario de edición
    public function edit(string $id)
    {
        $zona = Zona::find($id);
        return view('panel.zona.edit', ['zona' => $zona]);
    }

    // Actualiza el recurso
    public function update(Request $request, string $id)
    {
        $this->validar($request);
        $this->setData($request, zona::find($id)); 
        return redirect()->back()->with('success', 'Zona actualizada');
    }

    // Elimina el recurso
    public function destroy(string $id)
    {
        try {
            Zona::destroy($id);
        } catch (Exception $e){
            return redirect()->route('zona.index')->with('error', 'No se puede eliminar la zona');
        }
        
        return redirect()->route('zona.index')->with('success', 'Zona eliminada');
    }

    private function validar(Request $request){
        $request->validateWithBag('validacion', [
            'descripcion' => ['required', 'between:2,50', 'string'],
        ], [
            'between' => 'El campo debe tener entre :min y :max caracteres.',
        ]);
    }

    private function setData(Request $request, Zona $zona){
        $zona->descripcion = $request->descripcion;
        $zona->save();
    }
}
