<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPasscode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
      $routeName = $request->route()->getName();
      if (Auth::user()->passcode == "000000")
      {
        return redirect("/passcode?route=". $routeName);
      }
      if (!$request->session()->has('passcode_for_route_' . $routeName)) {
        // redirect to passcode entry page
        return redirect('/enterPasscode?route='. $routeName);
      }

      return $next($request);

    }
}
