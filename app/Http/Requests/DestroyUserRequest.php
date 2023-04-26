<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DestroyUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(auth()->user()->is_admin == true) return true; //Admin privileges.
        if(auth()->id == $this->id) return true; //Assigned user may delete their account.
        return false;
    }


}
