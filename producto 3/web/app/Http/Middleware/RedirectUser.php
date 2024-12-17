<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $type = $request->session()->get('userType');

        switch($type){
            case 'user': return redirect()->route('homepage.user');
            case 'admin': return redirect()->route('homepage.admin');
            case 'corporate': return redirect()->route('corporateReserva.index');
            default: return redirect()->route('login');
        }
    }
}
