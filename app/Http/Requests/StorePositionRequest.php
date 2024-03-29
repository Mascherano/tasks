<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePositionRequest extends FormRequest
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
     * Reglas establecidas para grabar una posición
     * 
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'position' => ['required', 'string', 'min:3', 'max:100']
        ];
    }
}
