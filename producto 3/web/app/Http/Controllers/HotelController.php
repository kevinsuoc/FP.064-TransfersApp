<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Zona;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

// Mas detalles acerca de cada método se encuentran en la clase Zona (Son análogos) y documentación.
// https://laravel.com/docs/10.x/controllers#restful-partial-resource-routes
class HotelController extends Controller
{

    public function index()
    {  
        $zonas = Zona::all();
        $hoteles = Hotel::all();
        return view('panel.hotel.index', ['hoteles' => $hoteles, 'zonas' => $zonas]);
    }

    public function create()
    {
        $zonas = Zona::all();
        return view('panel.hotel.create', ['zonas' => $zonas]);
    }

    public function store(Request $request)
    {
        $this->validar($request);
        $this->setData($request, new Hotel());
        return redirect()->route('hotel.index')->with('success', 'Hotel creado');
    }

    public function edit(string $id)
    {
        $zonas = Zona::all();
        $hotel = Hotel::find($id);
        return view('panel.hotel.edit', ['hotel' => $hotel, 'zonas' => $zonas]);
    }


    public function update(Request $request, string $id)
    {
        if (isset($request->isPassword)){
            $this->validarPassword($request);
            $this->setDataPassword($request, Hotel::find($id)); 
        }
        else{
            $this->validar($request);
            $this->setData($request, Hotel::find($id)); 
        }
        
        return redirect()->back()->with('success', 'Hotel actualizado');  
    }

    public function destroy(string $id)
    {
        try {
            Hotel::destroy($id);
        } catch (Exception $e){
            return redirect()->route('hotel.index')->with('error', 'No se puede eliminar el hotel');
        }

        return redirect()->route('hotel.index')->with('success', 'Hotel eliminado');
    }

    private function validar(Request $request){
        $request->validateWithBag('validacion', [
            'id_zona' => ['required'],
            'comision' => ['required', 'between:0,100', 'decimal:0,2'],
            'usuario' => ['required', 'between:2,50', 'string'],
            'password' => ['nullable', Password::min(8)],
        ], [
            'between' => 'El campo debe ser entre :min y :max.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'password' => 'La contraseña debe tener más de 7 caracteres',
        ]);
    }

    private function validarPassword(Request $request){
        $request->validateWithBag('validacion', [
            'password' => ['nullable', Password::min(8)],
        ], [
            'password' => 'La contraseña debe tener más de 7 caracteres',
        ]);
    }

    private function setData(Request $request, Hotel $hotel){
        $hotel->id_zona = $request->id_zona;
        $hotel->comision = $request->comision;
        $hotel->usuario = $request->usuario;
        if ($request->filled('password')){
            $hotel->password = Hash::make($request->password);
        }
        $hotel->save();
    }

    private function setDataPassword(Request $request, Hotel $hotel){
        if ($request->filled('password')){
            $hotel->password = Hash::make($request->password);
        } else {
            $hotel->password = null;
        }
        $hotel->save();
    }
}
