<?php

namespace App\Http\Middleware;

use Closure;

class Checkone
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        $use=session('use');
        if(!$use){
            return redirect('/onelogin');
        }
        return $next($request);
    }
}
