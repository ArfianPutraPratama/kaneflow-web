<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    // WEB: Show login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // WEB: Process login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->route('Dashboard');
        }

        return back()->withErrors(['username' => 'Username atau password salah.'])->withInput();
    }

    // WEB: Show registration form
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // WEB: Process registration
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // WEB: Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

    // WEB: Update password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        if (!$user) {
            return back()->withErrors(['error' => 'User not authenticated.'])->withInput();
        }

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.'])->withInput();
        }

        $user->update(['password' => Hash::make($request->new_password)]);
        return redirect()->route('password.forgot')->with('success', 'Password updated successfully!');
    }

    // WEB: Google OAuth redirect
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->scopes(['email', 'profile'])
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }

    // WEB: Google OAuth callback
    public function handleGoogleCallback()
    {
        try {
            $socialUser = Socialite::driver('google')->user();
            $user = User::firstOrCreate(
                ['email' => $socialUser->getEmail()],
                [
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

    // WEB: Facebook OAuth redirect
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->scopes(['email'])->redirect();
    }

    // WEB: Facebook OAuth callback
    public function handleFacebookCallback()
    {
        try {
            $socialUser = Socialite::driver('facebook')->user();
            $user = User::firstOrCreate(
                ['email' => $socialUser->getEmail()],
                [
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

    // API: Register
    public function apiRegister(Request $request)
    {
        Log::info('API Register attempt', $request->all());
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message' => 'Registration successful',
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    // API: Login
    public function apiLogin(Request $request)
    {
        Log::info('API Login attempt', $request->all());
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message' => 'Login successful',
            'user' => $user->only(['id', 'username', 'email', 'created_at', 'updated_at']),
            'token' => $token,
        ]);
    }

    // API: Get registered users
    public function getRegisteredUsers(Request $request)
    {
        $authUser = $request->user();
        Log::info('Authenticated user in getRegisteredUsers', ['user' => $authUser]);
        $users = User::select('id', 'username', 'email', 'created_at', 'updated_at')->get();
        return response()->json([
            'message' => 'Retrieved registered users',
            'users' => $users,
        ]);
    }

    // API: Get authenticated user
    public function getAuthenticatedUser(Request $request)
    {
        $user = $request->user();
        Log::info('Authenticated user in getAuthenticatedUser', ['user' => $user]);
        return response()->json([
            'message' => 'Retrieved authenticated user',
            'user' => $user,
        ]);
    }
}
