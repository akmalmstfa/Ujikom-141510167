<?php

namespace App\Http\Middleware;

use Closure;

class pegawai
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
        if (auth()->check() && $request->user()->permission == 'pegawai') {
        return $next($request);
        }
            return redirect()->guest(route('cannotacces'));
    }
}
