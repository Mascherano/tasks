<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register',    [AuthController::class, 'register'])->name('auth.register');
Route::post('/login',       [AuthController::class, 'login'])->name('auth.login');

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/usertasks/{id}', [UserController::class, 'userTasks'])->name('users.userTasks');

    Route::get('deletedtasks', [TaskController::class, 'deletedTasks'])->name('tasks.deletedTasks'); //ruta para obtener todas las tareas eliminadas
    Route::resource('tasks', TaskController::class); //ruta tipo recurso de las tareas

    // Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    // Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    // Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');
    // Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
    // Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    Route::resource('positions', PositionController::class);
});
