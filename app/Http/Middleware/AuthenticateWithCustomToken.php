<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateWithCustomToken
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');

        if (!$token) {
            return response()->json(['message' => 'Token not provided'], 401);
        }

        $token = str_replace('Bearer ', '', $token);
        $user = User::where('api_token', hash('sha256', $token))->first();

        if (!$user) {
            return response()->json(['message' => 'Invalid token'], 401);
        }

        Auth::setUser($user); // Set user ke Auth
        $request->merge(['user' => $user]);

        return $next($request);
    }
}
