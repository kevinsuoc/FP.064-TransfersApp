<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AppAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $instruction): Response
    {
        switch ($instruction){
            case 'self': return $this->handleSelfAuth($request, $next);
            case 'any':
            case 'admin':
            case 'user':
            case 'corporate':
            case 'guest': return $this->handleTypeAuth($request, $next, $instruction);
        }
        return redirect()->route('homepage');
    }

    private function handleSelfAuth(Request $request, Closure $next){
        if ($request->session()->has('user')){
            $type = $request->session()->get('userType');
            if ($type === 'user')
                $id = $request->session()->get('user')->id_viajero;
            else if ($type === 'corporate')
                $id = $request->session()->get('user')->id_hotel;
            else
                $id = -1;
            if ($id == $request->route('perfil'))
                return $next($request);
        }
        return redirect()->route('homepage');
    }

    private function handleTypeAuth(Request $request, Closure $next, string $userType){
        if ($request->session()->has(key: 'userType')){
            $type = $request->session()->get('userType');
        
            if ($userType === $type || $userType === 'any'){
                return $next($request);
            }
        } else if ($userType === 'guest'){
            return $next($request);
        }
        return redirect()->route('homepage');
    }
}
