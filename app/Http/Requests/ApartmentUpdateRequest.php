<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApartmentUpdateRequest extends FormRequest
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
            'unit' => 'sometimes|required',
            'address' => 'sometimes|required',
            'description' => 'sometimes|required',
            'price' => 'sometimes|required',
            'ownerId' => 'sometimes|required|exists:owners,id',
            'isOccupied' => 'sometimes|required|boolean',
        ];
    }
    protected function failedValidation(Validator $validator)
     {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'data' => $validator->errors()

            ])
        );
     }
}