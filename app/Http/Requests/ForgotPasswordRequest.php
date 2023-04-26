<?php

namespace App\Http\Requests;

use App\Rules\EmailExistsOnUser;

class ForgotPasswordRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules()
    {
        return ['email' => [
            'required',
            'string',
            new EmailExistsOnUser($this->email),
            ],
        ];
    }
}
