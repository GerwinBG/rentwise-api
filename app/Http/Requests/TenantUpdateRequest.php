<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TenantUpdateRequest extends FormRequest
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
            'name' => 'sometimes|required',
            'apartmentId' => 'sometimes|required|exists:apartments,id',
            'email' => 'sometimes|required|email:rfc|unique:tenants,id',
            'contact' => 'sometimes|required',
            'occupantsQty' => 'sometimes|required',
            'startDate' => 'sometimes|required|date_format:m/d/Y'
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
