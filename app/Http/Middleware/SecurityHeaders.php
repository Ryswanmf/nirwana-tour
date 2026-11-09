<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Proteksi Keamanan Web Modern & Live Production
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=(self)');

        // Cegah caching untuk halaman Admin & Auth agar LiteSpeed / CDN tidak membuang cookie session CSRF
        if ($request->is('admin*') || $request->is('admin/*') || $request->is('login')) {
            $response->headers->set('Cache-Control', 'no-cache, private, no-store, must-revalidate');
            $response->headers->set('Pragma', 'no-cache');
            $response->headers->set('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
        }

        // HSTS jika koneksi aman (HTTPS)
        if ($request->isSecure()) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        }

        // Hapus header finger-printing server
        $response->headers->remove('X-Powered-By');
        if (function_exists('header_remove')) {
            @header_remove('X-Powered-By');
        }

        return $response;
    }
}
