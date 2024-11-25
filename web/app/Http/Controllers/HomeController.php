<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        if (Auth::guard('regular')->check())
            return $this->user();
        else if (Auth::guard('corporate')->check())
            return  $this->corporate();
        else if (Auth::guard('admin')->check())
            return  $this->admin();
        else
            return  $this->login();
    }

    public function login(){
        return view ('login');
    }

    public function user(){
        return redirect()->route('homepage.user');
    }

    public function corporate(){
        return redirect()->route('homepage.corporate');
    }

    public function admin(){
        return redirect()->route('homepage.admin');
    }

}
