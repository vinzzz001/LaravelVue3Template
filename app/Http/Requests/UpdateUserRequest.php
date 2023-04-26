<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(auth()->user()->is_admin == true) return true; //Admin privileges.
        if(auth()->id == $this->id) return true; //Assigned user may change their status.
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'numeric|min:0|required',
            'email'=> 'string',
            'first_name'=> 'string',
            'last_name'=> 'string',
            'telephone_number' => 'numeric',
        ];
    }
}
