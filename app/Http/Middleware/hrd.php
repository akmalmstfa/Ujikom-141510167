<?php

namespace App\Http\Middleware;

use Closure;

class hrd
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
        if (auth()->check() && $request->user()->permission == 'hrd') {
        return $next($request);
        }
            return redirect()->guest(route('cannotacces'));
    }
}
