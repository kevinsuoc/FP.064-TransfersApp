<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Reserva;
use App\Models\Viajero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ViajeroController extends Controller
{

    public function show(string $id)
    {
        $viajero = Viajero::find($id);
        return view('panel.viajero.show', ['viajero' => $viajero]);
    }

    public function edit(string $id)
    {
        $viajero = Viajero::find($id);
        return view('panel.viajero.edit', ['viajero' => $viajero]);
    }

    public function changePassword(Request $request, string $id){
        $request->validateWithBag('validacion', [
            'password' => ['required', 'confirmed',Password::min(8)],
        ]);
        $viajero = Viajero::find($id);
        $viajero->password = Hash::make($request->password);
        $viajero->save();
        return redirect()->back()->with('success-password', 'Contraseña actualizada');
    }

    public function update(Request $request, string $id)
    {
        $this->validar($request);
        $this->setData($request, Viajero::find($id)); 
        return redirect()->back()->with('success', 'Perfil actualizado');
    }

    private function validar(Request $request){
        $request->validateWithBag('validacion', [
            'nombre' => ['required', 'between:2,50', 'string'],
            'email' => ['required', 'email', 'unique:App\Models\Viajero,email'],
            'apellido1' =>['required', 'between:2,50', 'string'],
            'apellido2' => ['required', 'between:2,50', 'string'],
            'ciudad' => ['required', 'between:2,50', 'string'],
            'pais' => ['required', 'between:2,50', 'string'],
            'direccion' => ['required', 'between:2,50'],
            'codigo_postal' => ['required', 'between:2,50'],
        ]);
    }

    private function setData(Request $request, Viajero $viajero){
        $viajero->nombre = $request->nombre;
        $viajero->apellido1 = $request->apellido1;
        $viajero->apellido2 = $request->apellido2;
        if ($viajero->email != $request->email){
            Reserva::where('email_cliente', $viajero->email)->update(['email_cliente' => $request->email]);
        }
        $viajero->email = $request->email;
        $viajero->codigo_postal = $request->codigo_postal;
        $viajero->ciudad = $request->ciudad;
        $viajero->pais = $request->pais;
        $viajero->direccion = $request->direccion;
        $viajero->save();
        $request->session()->put('user',  $viajero);
    }
}
