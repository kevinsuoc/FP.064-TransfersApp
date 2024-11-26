<?php

namespace App\Http\Controllers;

use App\Models\TipoReserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function user(){
        return  view ('homepage.user');
    }

    public function corporate(){
        return  view ('homepage.corporate');
    }

    public function admin(){
        $tiposReserva = TipoReserva::all();

        return  view ('homepage.admin', ['tiposReserva' => $tiposReserva]);
    }

}
