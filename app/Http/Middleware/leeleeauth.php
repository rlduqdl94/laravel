<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class leeleeauth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $mgmt_login = $request->session()->get('mgmt-login');
        if ($mgmt_login != true) {
              return redirect('/login');
        }
        return $next($request);
    }
}
