<?php

namespace App\Http\Middleware;

use Closure;
use Brian2694\Toastr\Facades\Toastr;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class RedirectIfOfficeNotApproved
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
            if (Sentinel::getUser()->office->is_approved == 0) {
                Toastr::warning('الرجاء الانتظار حتى تحصل الجهة على الموافقة من لجمنة الأمناء.', 'انتطار الموافقة');
                return redirect(url('office'));
            }
        }
        return $next($request);
    }
}
