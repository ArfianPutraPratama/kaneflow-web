<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class EnsureTokenIsValid
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->session()->get('auth_token') ?? $request->bearerToken();

        if (!$token) {
            return redirect()->route('login')->withErrors(['error' => 'No token provided.']);
        }

        $accessToken = PersonalAccessToken::findToken($token);

        if (!$accessToken || !$accessToken->tokenable) {
            $request->session()->forget('auth_token');
            return redirect()->route('login')->withErrors(['error' => 'Invalid or expired token.']);
        }

        // Log in the user for the request
        \Illuminate\Support\Facades\Auth::login($accessToken->tokenable);

        return $next($request);
    }
}
