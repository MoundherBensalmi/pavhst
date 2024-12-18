<?php

namespace Moundherb\Pavhst\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Moundherb\Pavhst\DomainGuard;

class DomainGuardMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $domainGuard = new DomainGuard($request);
        $domainGuard->check();

        return $next($request);
    }
}
