<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $socialUser = Socialite::driver('google')->user();
            $user = User::updateOrCreate(
                ['google_id' => $socialUser->getId()],
                [
                    'email' => $socialUser->getEmail(),
                    'username' => $socialUser->getName() ?? 'user_' . uniqid(),
                    'password' => Hash::make(uniqid()),
                    'email_verified_at' => now(),
                ]
            );

            Auth::login($user, true);
            return redirect()->route('Dashboard');
        } catch (\Exception $e) {
            Log::error('Google login error: ' . $e->getMessage());
            return redirect()->route('login')->withErrors(['error' => 'Google login failed.']);
        }
    }

    public function handleFacebookCallback()
    {
        try {
            $socialUser = Socialite::driver('facebook')->user();
            $user = User::updateOrCreate(
                ['facebook_id' => $socialUser->getId()],
                [
                    'email' => $socialUser->getEmail(),
                    'username' => $socialUser->getName() ?? 'user_' . uniqid(),
                    'password' => Hash::make(uniqid()),
                    'email_verified_at' => now(),
                ]
            );

            Auth::login($user, true);
            return redirect()->route('Dashboard');
        } catch (\Exception $e) {
            Log::error('Facebook login error: ' . $e->getMessage());
            return redirect()->route('login')->withErrors(['error' => 'Facebook login failed.']);
        }
    }
}
