<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class SecurityHeaders
{
    /** @param Closure(Request): Response $next */
    public function handle(Request $request, Closure $next): Response
    {
        return tap($next($request), fn (Response $response) => $response->headers->add([
            'x-content-type-options' => 'nosniff',
            'x-frame-options' => 'DENY',
            'referrer-policy' => 'strict-origin-when-cross-origin',
        ]));
    }
}
