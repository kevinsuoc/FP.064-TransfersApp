<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrayectoController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->tipoCalendario){
            $request->tipoCalendario = "mensual";
            $request->anyo = date('Y');
            $request->mes = date('m');
        }
        
        return view('panel.trayectos.index');
    }
}
