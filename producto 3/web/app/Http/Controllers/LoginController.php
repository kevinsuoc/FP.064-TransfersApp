<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Viajero;
use Auth;
use Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(){
        return  view ('login');
    }

    public function authenticate(Request $request): RedirectResponse {
        $credentials = $request->validate([
            'username' => ['required'], 
            'password' => ['required'],
        ]);

        if ($credentials['username'] === env('ADMIN_USERNAME')){
            if($credentials['password'] === env('ADMIN_PASSWORD')){
                return $this->redirectValidAuth($request, 'admin');
            }
            return $this->loginError('Contraseña incorrecta');
        }

        $user = Viajero::where('email', $credentials['username'])->first();
        if ($user){
            if ($user && $this->validatePassword($credentials['password'], $user->password)){
                $request->session()->put('user',  $user);
                return $this->redirectValidAuth($request, 'user');
            }
            return $this->loginError('Contraseña incorrecta');
        }

        $user = Hotel::where('usuario', $credentials['username'])->first();
        if ($user){
            if  (!$user->password){
                return $this->loginError('Usuario corporativo no en alta. Hable con el administrador');
            }
            if ($this->validatePassword( $credentials['password'], $user->password, )){
                $request->session()->put('user', $user);
                return $this->redirectValidAuth($request, 'corporate');
            }
            return $this->loginError('Contraseña incorrecta');
        }

        return $this->loginError('Usuario no encontrado');
    }

    public function logout(Request $request): RedirectResponse {
        $request->session()->forget('userType');
        $request->session()->forget('user');
        $request->session()->regenerate();
        return redirect()->route('homepage');
    }

    private function redirectValidAuth(Request $request, String $type): RedirectResponse{
        $request->session()->regenerate();
        $request->session()->put('userType', $type);
        return redirect()->route('homepage.' . $type);
    }

    private function loginError(String $message): RedirectResponse{
        return back()->withErrors([
            'username' => $message,
        ])->onlyInput('username');
    }

    private function validatePassword(String $password, String $original): bool{
        return Hash::check($password, $original);
    }

}
