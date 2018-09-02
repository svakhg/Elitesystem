<?php

namespace App\Http\Middleware;

use Closure;

class IsBar
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
        if(auth()->user()->is_superuser() || auth()->user()->is_bar())
        {
            return $next($request);
        }
        return back();        
    }
}
