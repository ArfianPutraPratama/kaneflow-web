<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class ProfilController extends Controller
{
    // Web route: Display the profile page
    public function profil()
    {
        return view('profil.Profil');
    }

    // API route: Return profile data as JSON
    public function apiProfil(Request $request, $id = null)
    {
        Log::info('Fetching profile', ['id' => $id, 'user' => $request->user()]);

        if (is_null($id)) {
            $user = $request->user();
            if (!$user instanceof User) {
                return response()->json(['message' => 'User not authenticated'], 401);
            }
        } else {
            $user = User::find($id);
            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }

            $authenticatedUser = $request->user();
            if (!$authenticatedUser instanceof User) {
                return response()->json(['message' => 'User not authenticated'], 401);
            }

            if ($authenticatedUser->id !== $user->id) {
                if (!$authenticatedUser->role || $authenticatedUser->role !== 'admin') {
                    return response()->json(['message' => 'Unauthorized to view this profile'], 403);
                }
            }
        }

        return response()->json([
            'message' => 'Profile retrieved successfully',
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
                'full_name' => $user->full_name,
                'email' => $user->email,
                'address' => $user->address ?? 'Belum diatur',
                'whatsapp' => $user->whatsapp ?? 'Belum diatur',
                'website' => $user->website ?? 'Belum diatur',
                'facebook' => $user->facebook ?? 'Belum diatur',
                'twitter' => $user->twitter ?? 'Belum diatur',
                'instagram' => $user->instagram ?? 'Belum diatur',
                'profile_photo' => $user->profile_photo ? asset('storage/' . $user->profile_photo) : asset('images/default-profile.png'),
            ],
        ], 200);
    }

    // Web route: Display the edit profile page
    public function ubahProfil()
    {
        return view('profil.Ubah-Profil');
    }

    // API route: Return profile data for editing as JSON
    public function apiUbahProfil(Request $request)
    {
        Log::info('Fetching profile data for editing', ['user' => $request->user()]);

        $user = $request->user();
        if (!$user instanceof User) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        return response()->json([
            'message' => 'Profile data for editing retrieved successfully',
            'user' => [
                'full_name' => $user->full_name,
                'username' => $user->username,
                'email' => $user->email,
                'address' => $user->address,
                'whatsapp' => $user->whatsapp,
                'website' => $user->website,
                'facebook' => $user->facebook,
                'twitter' => $user->twitter,
                'instagram' => $user->instagram,
                'profile_photo' => $user->profile_photo ? asset('storage/' . $user->profile_photo) : null,
            ],
        ], 200);
    }

    // Web route: Update the profile
    public function update(Request $request)
    {
        Log::info('Updating profile via web route', ['request' => $request->all()]);

        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'username' => 'required|string|max:191|unique:users,username,' . Auth::id(),
            'email' => 'required|email|max:191|unique:users,email,' . Auth::id(),
            'address' => 'required|string',
            'whatsapp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:20',
            'website' => 'required|url',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'profile_photo' => 'nullable|image|mimes:jpg,png|max:1024',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();

        if (!$user instanceof User) {
            return redirect()->back()->with('error', 'User instance not found.');
        }

        $data = $request->only([
            'full_name',
            'username',
            'email',
            'address',
            'whatsapp',
            'website',
            'facebook',
            'twitter',
            'instagram',
        ]);

        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo) {
                Storage::delete('public/' . $user->profile_photo);
            }
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $data['profile_photo'] = $path;
        }

        $user->update($data);

        return redirect()->route('profil')->with('success', 'Profil berhasil diperbarui.');
    }

    // API route: Update the profile via API
    public function apiUpdate(Request $request, $id = null)
    {
        Log::info('Updating profile via API', ['id' => $id, 'request' => $request->all()]);

        // Determine which user to update
        if (is_null($id)) {
            $user = $request->user();
            if (!$user instanceof User) {
                return response()->json(['message' => 'User not authenticated'], 401);
            }
        } else {
            $user = User::find($id);
            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }

            // Authorization check
            $authenticatedUser = $request->user();
            if (!$authenticatedUser instanceof User) {
                return response()->json(['message' => 'User not authenticated'], 401);
            }

            // Allow update if the authenticated user is updating their own profile
            // or if the authenticated user is an admin
            if ($authenticatedUser->id !== $user->id) {
                if (!$authenticatedUser->role || $authenticatedUser->role !== 'admin') {
                    return response()->json(['message' => 'Unauthorized to update this profile'], 403);
                }
            }
        }

        // Validate the request
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'username' => 'required|string|max:191|unique:users,username,' . $user->id,
            'email' => 'required|email|max:191|unique:users,email,' . $user->id,
            'address' => 'required|string',
            'whatsapp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:20',
            'website' => 'required|url',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'profile_photo' => 'nullable|image|mimes:jpg,png|max:1024',
        ]);

        if ($validator->fails()) {
            Log::warning('Validation failed for profile update', ['errors' => $validator->errors()]);
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Prepare data for update
        $data = $request->only([
            'full_name',
            'username',
            'email',
            'address',
            'whatsapp',
            'website',
            'facebook',
            'twitter',
            'instagram',
        ]);

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo) {
                Storage::delete('public/' . $user->profile_photo);
            }
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $data['profile_photo'] = $path;
        }

        // Update the user
        $user->update($data);

        Log::info('Profile updated successfully', ['user_id' => $user->id]);

        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
                'full_name' => $user->full_name,
                'email' => $user->email,
                'address' => $user->address,
                'whatsapp' => $user->whatsapp,
                'website' => $user->website,
                'facebook' => $user->facebook,
                'twitter' => $user->twitter,
                'instagram' => $user->instagram,
                'profile_photo' => $user->profile_photo ? asset('storage/' . $user->profile_photo) : null,
            ],
        ], 200);
    }
}
