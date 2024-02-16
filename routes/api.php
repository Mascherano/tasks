<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; //Llamada a controlador que uso para registrar y autenticar a un usuario
use App\Http\Controllers\PositionController; //Llamada a controlador para manejar posiciones de tareas (estados de tareas)
use App\Http\Controllers\TaskController; //Llamada a controlador para manejar tareas
use App\Http\Controllers\UserController; //Llamada a controlador  para manejar usuarios

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

Route::post('/register',    [AuthController::class, 'register'])->name('auth.register'); //Endpoint para registrar nuevos usuarios en la bd
Route::post('/login',       [AuthController::class, 'login'])->name('auth.login'); //Endpoint para loguear un usuario registrado

/*
* Creo un grupo de url's y les aplico el middleware auth:sanctum para evitar que alguien acceda sin tener un token de acceso.
*/
Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/users', [UserController::class, 'index'])->name('users.index'); //Endpoint para obtener listado de usuarios
    Route::get('/usertasks/{id}', [UserController::class, 'userTasks'])->name('users.userTasks'); //Endpoint para obtener listado de tareas por id de usuario

    Route::get('deletedtasks', [TaskController::class, 'deletedTasks'])->name('tasks.deletedTasks'); //Endpoint para obtener todas las tareas eliminadas
    Route::resource('tasks', TaskController::class); //ruta tipo recurso de las tareas

    /*
    * Listado de url's para las tareas individualizadas, las dejo como ejemplo.
    */
    // Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    // Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    // Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');
    // Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
    // Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    Route::resource('positions', PositionController::class); //ruta tipo recurso para posiciones de tareas (estados de tareas).
});
