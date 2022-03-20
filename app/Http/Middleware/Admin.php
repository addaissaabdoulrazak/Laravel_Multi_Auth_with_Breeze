<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
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
        // if you are not admin redirect to route login_from => see a file web
        // observe the route name "login_from"
        //go to look the record Middleware in the file RedirectifAuthentificated 
        if (!Auth::guard('admin')->check()) :

            return redirect()->route("login_from")->with('error', "vous n'êtes administrateur");

        endif;
        return $next($request);
    }
}
