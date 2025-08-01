<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email'
            ],
            'password' => 'required',
        ];
    }

    public function message(): array
    {
        return [
            'email.required' => 'The email failed is required.',
            'email.email' => 'The email must be a valid email address.',
            'password.required' => 'The password field is required.'
        ];
    }
    /**
      * Handle a failed validation attempt
      *
      * @param
      * @return void

      * @throws
    */
    protected function failedValidation(Validator $validator)
      {
        throw new HttpResponseException(response()->json([
            'status' => 'failed',
            'statuscode' => 422,
            'errors' => $validator->errors()
        ], 422));
      }
}
