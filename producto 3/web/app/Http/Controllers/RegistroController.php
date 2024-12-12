<?php

//TODO: Boton registrarse

namespace App\Http\Controllers;

use App\Models\Viajero;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class RegistroController extends Controller
{
    public function registrarse() {
        return view('registrarse');
    }

    public function registrarRegular(Request $request){
        $request->validateWithBag('error-registro', [
            'nombre' => ['required', 'between:2,50', 'string'],
            'email' => ['required', 'email', 'unique:App\Models\Viajero,email'],
            'apellido1' =>['required', 'between:2,50', 'string'],
            'apellido2' => ['required', 'between:2,50', 'string'],
            'ciudad' => ['required', 'between:2,50', 'string'],
            'pais' => ['required', 'between:2,50', 'string'],
            'direccion' => ['required', 'between:2,50'],
            'codigo_postal' => ['required', 'between:2,50'],
            'password' => ['required', 'confirmed',Password::min(8)],
//            'password' => ['required', 'confirmed',Password::min(8)->numbers()->mixedCase()],
        ]);
        $viajero = new Viajero();

        $viajero->nombre = $request->nombre;
        $viajero->email = $request->email;
        $viajero->apellido1 = $request->apellido1;
        $viajero->apellido2 = $request->apellido2;
        $viajero->ciudad = $request->ciudad;
        $viajero->pais = $request->pais;
        $viajero->direccion = $request->direccion;
        $viajero->codigo_postal = $request->codigo_postal;
        $viajero->password = Hash::make($request->password);

        $viajero->save();
        
        return redirect()->route('login')->with('success', 'Registrado correctamente');;
    }
}
