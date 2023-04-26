<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateResponseRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(auth()->user()->is_admin == true) return true; //Admin privileges.
        if(auth()->id == $this->user_id) return true; //Response owner may change Response.

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id'=> 'required|numeric',
            'content'=> 'required|string',
            'ticket_id'=> 'required|numeric',
            'user_id'=> 'required|numeric',
        ];
    }
}
