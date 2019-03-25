<?php

namespace App\Http\Middleware;

use Closure;

class AuthSuscribers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->session()->get('prenom')===null){
            return redirect()->route('root');
        }
        return $next($request);
    }
}
