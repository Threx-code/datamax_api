<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

   /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['bail', 'nullable', 'string'],
            'isbn' => ['bail', 'nullable', 'string'],
            'authors' => ['bail', 'nullable', 'array'],
            'authors.*' => ['bail', 'nullable', 'string'],
            'country' => ['bail', 'nullable', 'string'],
            'number_of_pages' => ['bail', 'nullable', 'numeric'],
            'publisher' => ['bail', 'nullable', 'string'],
            'release_date' => ['bail', 'nullable', 'date'],
        ];
    }


    /**
     * [failedValidation this handles the validation error if no parameter was set]
     * @param  Validator $validator [The Validation class was injected as a dependency for validating the required parameters and $validator was created as an object of the Validation class which calls the errors method]
     * @return [type]               [it throws an HttpResponseexception which shows that no parameter was set yet]
     */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json( $validator->errors(), 422) );
    }
}
