<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class UserRegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => [['required'], ['email'], Rule::unique('users', 'email')],
            'password' => 'required|min:8',
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'check your email or try login instead.'
        ];
    }


    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json(['errors'=>$validator->errors()], 422));
    }

}
