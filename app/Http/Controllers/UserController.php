<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json([
            'success' => true,
            'users' => $users
        ], 200);
    }

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
