<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    /*
    * Función que devuelve listado de todas las tareas no eliminadas en el sistema
    * Se devuelve un json con la colección de datos formateada por el TaskResource
    * Si no hay tareas creadas devuelve json con mensaje
    */
    public function index(): JsonResponse
    {
        $tasks = Task::all();
        return response()->json([
            'success' => true,
            'tasks' => (!$tasks->isEmpty()) ? TaskResource::collection($tasks) : "there are no tasks"
        ], 200);
    }

    /*
    * Función que crea una nueva tarea en la bd, esta funcíon esta validada por el StoreTaskRequest
    * Si la validación no falla, se creará una nueva tarea y se devolverá un json con la nueva tarea creada y formateada por el Taskresource
    * Si la validación falla se devolvera un arreglo con todos los errores encontrados
    */
    public function store(StoreTaskRequest $request): JsonResponse
    {
        $task = Task::create([
            'user_id'       => $request->validated('user_id'),
            'position_id'   => $request->validated('position_id'),
            'title'         => $request->validated('title'),
            'description'   => $request->validated('description'),
            'end_date'      => $request->validated('end_date')
        ]);

        return response()->json([
            'success' => true,
            'message' => 'task created successfully',
            'task' => new TaskResource($task)
        ], 200);
    }

    /*
    * Función que devuelve una tarea, esta función recibe el id de la tarea a buscar
    * Se realiza la búsqueda en la bd
    * Si la tarea se encuentra se devuelve un json con la tarea formateado por el TaskResource
    * S la tarea no es encontrada se devuelve json con un mensaje de error
    */
    public function show($id): JsonResponse
    {
        $task = Task::find($id);

        if ($task) {
            return response()->json([
                'success' => true,
                'task' => new TaskResource($task)
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'task' => 'The searched task does not exist'
            ], 401);
        }
    }

    /*
    * Función que actualiza una tarea en la bd, esta función esta validada por el UpdateTaskRequest
    * Si la validación falla se devuelve un arreglo con todos los errores encontrados
    * Si la validación no falla, se realiza la búsqueda de la tarea en la bd
    * Si la tarea es encontrada, se actualizan los valores deseados
    * Si la tarea no es encontrada se devuelve un json con mensaje de error
    */
    public function update(UpdateTaskRequest $request, $id): JsonResponse
    {
        $task = Task::find($id);

        if($task){
            $task->user_id      = $request->validated('user_id');
            $task->position_id  = $request->validated('position_id');
            $task->title        = $request->validated('title');
            $task->description  = $request->validated('description');
            $task->end_date     = $request->validated('end_date');
            $task->save();

            return response()->json([
                'success' => true,
                'message' => 'task edited successfully',
                'task' => new TaskResource($task)
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'The searched task does not exist',
            ], 401);
        }
        
    }

    /*
    * Función que elimina una tarea, esta función recibe el id de una tarea a eliminar
    * Se realiza la búsqueda de la tarea y se elimina
    * Se devuelve un json con mensaje
    */
    public function destroy($id): JsonResponse
    {
        Task::find($id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'task successfully deleted'
        ], 200);
    }

    /*
    * Función que devuelve listado de tareas eliminadas
    * Se realiza una búsqueda en la tabla Tasks ocupando además en método onlyTrashed que trae como resultado todos los objetos eliminados
    * Con el cammpo deleted_at completado (fecha de eliminación)
    * Se devuelve json con la colección de datos formateada con el TaskResource
    */
    public function deletedTasks(): JsonResponse
    {
        $tasks = Task::onlyTrashed()->get();

        return response()->json([
            'success' => true,
            'tasks' => TaskResource::collection($tasks)
        ], 200);
    }
}
