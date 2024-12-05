<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Viajero;
use Illuminate\Http\Request;

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


    public function update(Request $request, string $id)
    {
        // Validate
        // Change data
        // Return w success
    }

    public function destroy(Request $request, string $id)
    {
        // Validate
        // Destroy
        // Logout
    }
}
