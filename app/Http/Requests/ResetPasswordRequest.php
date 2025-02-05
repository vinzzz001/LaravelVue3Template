<?php


namespace App\Http\Requests;


class ResetPasswordRequest extends BaseFormRequest
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
    public function rules(): array
    {
        return [
            'email'=> 'required|string',
            'password'=> 'required|string',
            'token'=> 'required|string',
        ];
    }
}
