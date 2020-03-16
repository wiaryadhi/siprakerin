<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class RoleKepalaP
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
        if (Auth::user()->privilege == 3) {
            return $next($request);
        } else {
          return redirect()->back()->with('role-error-message', 'Maaf, anda tidak dapat mengakses halaman ini :)');
        }
    }
}
