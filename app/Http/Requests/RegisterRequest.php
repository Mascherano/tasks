<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * Reglas establecidas para el endpoint registro de usuario
     * 
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'], //campo email debe ser requerido, email y debe ser unico en la tabla users
            //campo password debe ser requerido, cadena de caracteres, mínimo 8, máximo 20, expresión regular que valida lo siguiente
            // debe tener al menos una mayúscula
            // debe tener al menos una minúscula
            // debe tener al menos un carácter especial (?=.*?[#\/\?¿!¡@$%^&*-.=])
            // mínimo 8 caracteres
            'password' => ['required', 'string', 'min:8', 'max:20', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#\/\?¿!¡@$%^&*-.=]).{8,}$/']
        ];
    }
}
