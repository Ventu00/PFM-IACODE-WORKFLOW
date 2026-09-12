<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('X-Content-Type-Options', 'nosniff');

        $response->headers->set(
            'Content-Security-Policy',
            "default-src 'self'; " .
            "base-uri 'self'; " .
            "form-action 'self'; " .
            "frame-ancestors 'self'; " .
            "object-src 'none'; " .
            "style-src 'self'; " .
            "script-src 'self'; " .
            "img-src 'self' data:; " .
            "font-src 'self'; " .
            "connect-src 'self'"
        );

        $response->headers->set('Cross-Origin-Embedder-Policy', 'require-corp');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->remove('X-Powered-By');

        return $response;
    }
}
