<?php

namespace App\Http\Middleware;

use Closure;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class RedirectIfNoOffice
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
        if (!Sentinel::check()) {
            return redirect(url('login'));
        }
        if (!Sentinel::getUser()->inRole('admin')){
            if (count(Sentinel::getUser()->office) == 0) {
                return redirect(url('office/create'));
            }
        }
        return $next($request);
    }
}
