<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(auth()->user() != null) return true; //Any user can create a ticket
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

    public function messages()
    {
        return [
            "status_id.required" => "The status is required.",
            "category_id.required" => "The category is required.",
        ];
    }
}
