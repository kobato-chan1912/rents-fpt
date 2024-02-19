<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UpdateBank
{
  /**
   * Handle an incoming request.
   *
   * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    if (Auth::check()) {
        if (Auth::user()->account_bin == null)
        {
          $routeName = $request->route()->getName();
          return redirect("/config-bank?route=$routeName");
        }
      return $next($request);
    }
    return $next($request);
  }
}
