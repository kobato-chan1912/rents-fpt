<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForgotPasscode
{
  /**
   * Handle an incoming request.
   *
   * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    $keys = array_keys(session()->all()); // Get all session keys
    foreach ($keys as $key) {
      if (str_starts_with($key, 'passcode_for_route_')) { // Check if the key starts with 'passcode_for_route_'
        session()->forget($key); // Remove the session
      }
    }
    return $next($request);
  }
}
