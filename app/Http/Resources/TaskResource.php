<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'assigned user' => $this->user->name,
            'position'      => $this->position->position,
            'title'         => $this->title,
            'description'   => $this->description,
            'end_date'      => $this->end_date,
            'created_at'    => $this->created_at
        ];
    }
}
