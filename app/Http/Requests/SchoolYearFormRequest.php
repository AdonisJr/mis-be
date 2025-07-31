<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SchoolYearFormRequest extends FormRequest
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
        $schoolYearId = $this->route('id'); // get the ID from the route if named 'id'

        return [
            'name' => 'required|string|unique:school_years,name,' . $schoolYearId,
            'active' => 'nullable|boolean'
        ];
    }

    public function messages(): array
    {
        return[
            'name.required' => 'The school year name is required.',
            'name.unique' => 'The school year already exist.'
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
