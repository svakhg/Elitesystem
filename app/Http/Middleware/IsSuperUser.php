<?php

namespace App\Http\Middleware;
use Closure;

class IsSuperUser
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
        if(auth()->user()->is_superuser())
        {
            return $next($request);
        }
        return back();
    }
}
