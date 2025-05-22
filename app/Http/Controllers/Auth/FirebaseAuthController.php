<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth as FirebaseAuth;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class FirebaseAuthController extends Controller
{
    protected $firebaseAuth;

    public function __construct()
    {
        try {
            $factory = (new Factory)
                ->withServiceAccount(config('services.firebase.credentials'))
                ->withDatabaseUri(config('services.firebase.database_url')); // Tambahkan jika menggunakan Realtime DB

            $this->firebaseAuth = $factory->createAuth();
        } catch (\Throwable $e) {
            Log::error('Firebase initialization error: ' . $e->getMessage());
            abort(500, 'Failed to initialize Firebase');
        }
    }

    public function handleFirebaseCallback(Request $request)
    {
        try {
            $request->validate([
                'idToken' => 'required|string'
            ]);

            $idToken = $request->input('idToken');
            $verifiedIdToken = $this->firebaseAuth->verifyIdToken($idToken);

            // Untuk versi terbaru kreait/firebase-php
            $firebaseUser = $verifiedIdToken->claims()->all();

            // Validasi data user
            if (empty($firebaseUser['email'])) {
                throw new \Exception('Email not provided by Firebase');
            }

            $user = $this->findOrCreateUser($firebaseUser);
            Auth::login($user, true);

            return response()->json([
                'success' => true,
                'redirect' => route('dashboard') // Tambahkan redirect URL
            ]);

        } catch (\Exception $e) {
            Log::error('Firebase Auth Error: ' . $e->getMessage());
            return response()->json([
                'error' => $e->getMessage(),
                'trace' => config('app.debug') ? $e->getTrace() : null
            ], 401);
        }
    }

    protected function findOrCreateUser(array $firebaseUser): User
    {
        return User::firstOrCreate(
            ['email' => $firebaseUser['email']],
            [
                'google_id' => $firebaseUser['sub'],
                'username' => $this->generateUsername($firebaseUser),
                'password' => Hash::make(Str::random(24)),
                'email_verified_at' => now(),
                'name' => $firebaseUser['name'] ?? null,
                'avatar' => $firebaseUser['picture'] ?? null
            ]
        );
    }

    protected function generateUsername(array $firebaseUser): string
    {
        if (isset($firebaseUser['name'])) {
            return Str::slug($firebaseUser['name'], '_');
        }

        $emailPrefix = explode('@', $firebaseUser['email'])[0];
        return 'user_' . Str::slug($emailPrefix, '_') . '_' . Str::random(4);
    }
}
