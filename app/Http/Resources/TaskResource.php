<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     * 
     * Cree este resource que me permite manipular una respuesta json para el endpoint en donde desee usarlo
     * por ejemplo deseo entregar en nombre del usuario que tiene asignada la tarea
     * Sin haber editado la tarea, esta entregaria el id de usuario asignado
     * O el id de la posición asignada
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'assigned user' => $this->user->name, //Muestro el nombre del usuario asignado, utilizando la relación entre la tarea y el usuario
            'position'      => $this->position->position, //Muestro en nombre de la posición, utlizando la relación entre la tarea y la posición
            'title'         => $this->title,
            'description'   => $this->description,
            'end_date'      => $this->end_date,
            'created_at'    => $this->created_at
        ];
    }
}
