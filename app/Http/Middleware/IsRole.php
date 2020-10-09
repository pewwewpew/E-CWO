<?php

namespace App\Http\Middleware;

use Closure;

class IsRole
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
        if(auth()->user()->roles_id = 'Admin')
        {
            return $next($request);
        }
        return redirect('/');
    }
}
