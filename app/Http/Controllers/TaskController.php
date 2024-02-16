<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{

    public function index(): JsonResponse
    {
        $tasks = Task::all();
        return response()->json([
            'success' => true,
            'tasks' => (!$tasks->isEmpty()) ? TaskResource::collection($tasks) : "there are no tasks"
        ], 200);
    }

    public function store(StoreTaskRequest $request): JsonResponse
    {
        $task = Task::create([
            'user_id' => $request->validated('user_id'),
            'position_id' => $request->validated('position_id'),
            'title' => $request->validated('title'),
            'description' => $request->validated('description'),
            'end_date' => $request->validated('end_date')
        ]);

        return response()->json([
            'success' => true,
            'message' => 'task created successfully',
            'task' => new TaskResource($task)
        ], 200);
    }

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

    public function update(UpdateTaskRequest $request, $id): JsonResponse
    {
        $task = Task::find($id);

        if($task){
            $task->user_id = $request->validated('user_id');
            $task->position_id = $request->validated('position_id');
            $task->title = $request->validated('title');
            $task->description = $request->validated('description');
            $task->end_date = $request->validated('end_date');
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

    public function destroy($id): JsonResponse
    {
        Task::find($id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'task successfully deleted'
        ], 200);
    }

    public function deletedTasks(): JsonResponse
    {
        $tasks = Task::onlyTrashed()->get();

        return response()->json([
            'success' => true,
            'tasks' => TaskResource::collection($tasks)
        ], 200);
    }
}
