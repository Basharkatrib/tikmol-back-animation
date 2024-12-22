<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'User registered successfully']);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'token' => $token,
        ]);
    }

    public function userProfile()
    {
        return response()->json(Auth::user());
    }



    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleCallback()
    {
        $google_user = Socialite::driver('google')->user();
    
        $user = User::where('email', $google_user->email)->first();
    
        if (!$user) {
            $user = User::create([
                'google_id' => $google_user->id,
                'name' => $google_user->name,
                'email' => $google_user->email,
                'google_token' => $google_user->token,
                'password' => bcrypt('default_password'),  
            ]);
        } else {
            $user->update([
                'google_id' => $google_user->id,
                'google_token' => $google_user->token,
            ]);
        }
    
        Auth::login($user);
    
        $token = $user->createToken('auth_token')->plainTextToken;
    
        return redirect('http://localhost:3000?token=' . $token);
    }
    
    
    public function deleteAccount(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'No authenticated user found'], 404);
        }

        $user->delete();

        Auth::logout();

        return response()->json(['message' => 'User account deleted successfully']);
    }
}
