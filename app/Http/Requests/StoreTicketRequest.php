<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
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
        //todo: Create validation rules.
        return [
            'title'=> 'required|string' ,
            'content'=> 'nullable|string',
            'category_id'=> 'required|numeric',
            'status_id'=> 'required|numeric',
            'user_id'=> 'nullable|numeric',
            'assigned_to'=> 'nullable|numeric'
        ];
    }
}
