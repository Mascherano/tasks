<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        dd($this->task);
        return [
            'user_id'       => ['sometimes'],
            'position_id'   => ['required', 'integer'],
            'title'         => ['required', 'string', 'min:10', 'max:255', 'unique:tasks,title,' . $this->task],
            'description'   => ['required', 'string', 'min:10', 'max:255'],
            'end_date'      => ['required', 'date']
        ];
    }
}
