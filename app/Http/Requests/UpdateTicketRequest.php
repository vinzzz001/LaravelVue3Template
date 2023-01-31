<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $me = auth()->user();

        if($me->is_admin == true) return true; //Admin privileges.

        if($this->user_id != $me->id) return false; //Ignore non-owner users.
        if($this->assigned_to) unset($this->assigned_to); //Removes non-admin-editable data.

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
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
