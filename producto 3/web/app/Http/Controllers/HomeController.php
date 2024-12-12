<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function user(){
        return  view ('homepage.user', ['viajero' => session()->get('user')]);
    }

    public function corporate(){
        return  redirect("/");
    }

    public function admin(){
        return  view ('homepage.admin');
    }

}
