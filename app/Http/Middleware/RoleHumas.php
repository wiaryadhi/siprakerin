<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class RoleHumas
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
        if (Auth::user()->privilege == 1) {
            return $next($request);
        } else {
          return redirect()->back()->with('role-error-message', 'Maaf, anda tidak dapat mengakses halaman ini :)');
        }
    
    }
}
