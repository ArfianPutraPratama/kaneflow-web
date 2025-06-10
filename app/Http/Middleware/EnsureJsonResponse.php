<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureJsonResponse
{
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan semua respons adalah JSON
        $request->headers->set('Accept', 'application/json');

        $response = $next($request);

        // Jika autentikasi gagal dan respons adalah redirect (302),
        // ubah menjadi JSON dengan status 401
        if ($response->getStatusCode() === 302 && $request->expectsJson()) {
            return response()->json([
                'message' => 'Unauthenticated.',
            ], 401);
        }

        return $response;
    }
}
