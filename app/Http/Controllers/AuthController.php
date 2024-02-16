<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /*
    * Función para registrar a un usuario, esta función esta validada con el RegisterRequest
    * Si la validación va bien se realiza la creación de un usuario, si falla se devolverá un arreglo con los errores encontrados
    * Luego de la creación del usuario se devuelve un json con un token de autenticación
    */
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

    /*
    * Función para loguar a un usuario en la aplicación, esta función esta validada con el LoginRequest
    * Si la validación va bien se intenta la autenticación del usuario, si falla se devolverá un arreglo con los errores encontrados
    * Si el método attempt falla, se devuelve un json con un mensaje de error
    * Si el método attempt no falla, se crea el obtjeto user en la clase Auth
    * Luego se busca al usuario por el correo entregado
    * Se eliminan los tokens generados anteriormente para el usuario encontrado
    * Se devuelve un json con un nuevo token generado para el usuario autenticado
    */
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
