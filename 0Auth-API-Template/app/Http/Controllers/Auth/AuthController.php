<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'User registered successfully.',
            'token' => $token
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'User logged in successfully.',
                'token' => $token,
            ]);
        }

        return response()->json(['message' => 'Invalid login credentials.'], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'User logged out successfully.',
        ]);
    }
}
