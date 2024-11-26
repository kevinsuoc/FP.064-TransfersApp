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
    public function handle(Request $request, Closure $next, string $userType): Response
    {
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
