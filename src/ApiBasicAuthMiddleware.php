<?php

namespace Azzarip\ApiBasicAuth;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiBasicAuthMiddleware
{ 
/**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $user): Response
    {
        $password = config("services.{$user}.inbound_password");

        if (
            $request->getUser() !== $user ||
            $request->getPassword() !== $password
        ) {
            return response('Unauthorized', 401);
        }

        return $next($request);
    }
}

