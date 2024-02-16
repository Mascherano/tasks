<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name'      => $request->validated('name'),
            'email'     => $request->validated('email'),
            'password'  => Hash::make($request->validated('password'))
        ]);

        return response()->json([
            'status'    => true,
            'message'   => 'Usuario creado correctamente.',
            'token'     => $user->createToken("API TOKEN")->plainTextToken
        ], 200);
    }

    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json([
                'status' => false,
                'message' => 'Email or password do not match with our records',
            ], 401);
        }

        $user = User::where('email', $request->validated('email'))->first();

        $user->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'User logged in successfully',
            'token' => $user->createToken("API TOKEN")->plainTextToken
        ], 200);
    }
}
