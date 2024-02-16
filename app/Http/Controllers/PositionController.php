<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePositionRequest;
use App\Http\Requests\UpdatePositionRequest;
use App\Models\Position;
use Illuminate\Http\JsonResponse;

class PositionController extends Controller
{
    /*
    * Funcion que entrega un json con todas las posiciones en la bd
    */
    public function index(): JsonResponse
    {
        $positions = Position::all();
        return response()->json([
            'success' => true,
            'positions' => (!$positions->isEmpty()) ? $positions : "there are no positions"
        ], 200);
    }

    /*
    * Función que crea una pocición el la bd, esta validada con el StorePositionReques
    * Si la validación falla, se devuelve un arreglo con todos los errores encontrados
    * Si la validación no falla se crea una posición en la bd
    * Finalmente devuelve un json con la posición creada
    */
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

    /*
    * Función que devuelve una posición buscada, esta función recibe el id de la posición a buscar
    * Se realiza una búsqueda en la tabla positions para obetener la posición deseada
    * Si se encuentra, esta se devuelve en un objeto json
    * Si no se encuentre devuelve un json con mensaje de error
    */
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

    /*
    * Función que actualiza una posición, esta función esta validada con el UpdatePositionRequest
    * Si la validación no falla, se busca la posición en la bd
    * Si se encuentra la posición, se actualiza la posición y se retorn un json con la posición editada
    * Si no se encuentra la posición se devuelve un json con un mensaje de error
    */
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

    /*
    * Función que elimina una posición, esta función recibe el id de la posición que se desea eliminar
    * Se realiza la búsqueda y eliminación de la posición
    * Se devuelve un json con mensaje
    */
    public function destroy($id): JsonResponse
    {
        Position::find($id)->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'position successfully deleted'
        ], 200);
    }
}
