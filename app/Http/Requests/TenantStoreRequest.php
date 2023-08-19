<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TenantStoreRequest extends FormRequest
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
            'apartmentId' => 'required|exists:apartments,id',
            'email' => 'required|email:rfc|unique:tenants,id',
            'contact' => 'required',
            'occupantsQty' => 'required',
            'startDate' => 'required|date_format:m/d/Y'
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
