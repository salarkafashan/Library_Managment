<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\loginRequest;
use App\Http\Requests\V1\Auth\RegisterRequest;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest  $request)
    {
        $validated = $request->validated();
        $validated['password'] = bcrypt($validated['password']);
        $user = User::create($validated);
        $accessToken = $user->createToken('UserToken')->accessToken;

        return response()->json([
            'user' => new UserResource($user),
            'token' => $accessToken,
            'token_type' => 'Bearer'
        ]);
    }

    public function login(loginRequest  $request)
    {
        $validated = $request->validated();
        if(Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']]))
        {
            $accessToken = Auth::user()->createToken('UserToken')->accessToken;
            return response()->json(['token' => $accessToken,'token_type' => 'Bearer']);
        }
        else
            return response()->json(['error' => 'Username / Password is incorrect']);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json('You are Logged out');
    }
}
