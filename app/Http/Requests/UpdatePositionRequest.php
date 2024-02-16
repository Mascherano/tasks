<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePositionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * Reglas establecidas para actualizar una posición
     * 
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'position' => ['required', 'string', 'min:3', 'max:100', 'unique:positions,position,' . $this->position]
        ];
    }
}
