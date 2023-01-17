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
        //todo: Test if another, no auth user, can change his/her tickets.
        $me = auth()->user();
        if($this->user_id != $me->id && $me->is_admin != true) return false;
        // if($me->is_admin != true && $this->assigned_to) unset($this->assigned_to);

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
