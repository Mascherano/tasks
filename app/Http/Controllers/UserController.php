<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /*
    * Función que devuelve el listado de usuarios en formato json
    */
    public function index()
    {
        $users = User::all();
        return response()->json([
            'success' => true,
            'users' => $users
        ], 200);
    }

    /*
    * Función que devuelve un listado de tareas asignadas al usuario por el que se consulta
    * Esta función recibe un id, luego se realiza una búsqueda del usuario con sus tareas (with('tasks')) en la bd
    * Si se encuentra al usuario se devuelve en un json
    * Si no se encuentra se devuelve un json con un mensaje de error
    */
    public function userTasks($id)
    {
        $user = User::where('id', $id)->with('tasks')->get();

        if (!$user->isEmpty()) {
            return response()->json([
                'success' => true,
                'user' => $user,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User does not exist',
            ], 401);
        }
    }
}
