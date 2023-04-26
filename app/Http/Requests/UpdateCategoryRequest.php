<?php

namespace App\Http\Requests;

use App\Rules\UnusedForeignKey;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(auth()->user()->is_admin == true) return true; //Admin privileges.
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
            'title' => 'string|required',
        ];
    }
}
