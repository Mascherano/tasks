<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePositionRequest;
use App\Http\Requests\UpdatePositionRequest;
use App\Models\Position;
use Illuminate\Http\JsonResponse;

class PositionController extends Controller
{
    
    public function index(): JsonResponse
    {
        $positions = Position::all();
        return response()->json([
            'success' => true,
            'positions' => (!$positions->isEmpty()) ? $positions : "there are no positions"
        ], 200);
    }

    public function store(StorePositionRequest $request): JsonResponse
    {
        $position = Position::create([
            'position' => $request->validated('position'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'position created successfully',
            'position' => $position
        ], 200);
    }

    
    public function show($id): JsonResponse
    {
        $position = Position::find($id);

        if ($position) {
            return response()->json([
                'success' => true,
                'position' => $position
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'position' => 'The searched position does not exist'
            ], 401);
        }
    }

    public function update(UpdatePositionRequest $request, $id): JsonResponse
    {
        $position = Position::find($id);

        if($position){
            $position->position = $request->validated('position');
            $position->save();

            return response()->json([
                'success' => true,
                'message' => 'position edited successfully',
                'position' => $position
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'The searched position does not exist',
            ], 401);
        }
    }

    public function destroy($id): JsonResponse
    {
        Position::find($id)->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'position successfully deleted'
        ], 200);
    }
}
