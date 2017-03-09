<?php

namespace App\Http\Middleware;

use Closure;

class ForceSSL
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request $request
   * @param  \Closure $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
      if (!app()->environment('local')) {
          // for Proxies
          Request::setTrustedProxies([$request->getClientIp()]);

          if (!$request->isSecure()) {
              return redirect()->secure($request->getRequestUri());
          }
      }

      return $next($request);
  }
}
