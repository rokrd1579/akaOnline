<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Validation\ValidationException;

class AdminMiddleware
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
        if (auth()->user()->active == 0) {
            // usuario con sesión iniciada pero inactivo
            // invalidamos su sesión
            $request->session()->invalidate();
            throw ValidationException::withMessages([
                'email' => 'Usuario bloqueado',
            ]);
        }
        //if (auth()->check() && auth()->user()->hasRole('admin')){
        if(auth()->check() && $request->user()->hasRole('admin')){
            return $next($request);
            //return redirect('login');
        }
        if(auth()->check() && $request->user()->hasRole('seller')){
            return $next($request);
            //return redirect('login');
        }
        return redirect('login');
    }
}
