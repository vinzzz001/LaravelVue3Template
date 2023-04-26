<?php

namespace App\Http\Requests;

use App\Rules\CategoryExistsOnTicket;
use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

class DestroyCategoryRequest extends BaseFormRequest
{
    protected $id ;
/**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (auth()->user()->is_admin == true) {
            return true;
//Admin privileges.
        }
        return false;
    }




    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $this->id = $this->category->id;
        return
        [      'id' => [
            'required',
            'numeric',
            new CategoryExistsOnTicket($this->id),
            ]
        ];
    }
}
