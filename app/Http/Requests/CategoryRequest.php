<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;


class CategoryRequest extends FormRequest
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
        // Merge the additional 'langue' rule with the existing rules
        $required = $this->has('id') ? "nullable" : "required";

        return [

            'category' => 'required',

        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function attributes()
    {
        return [

            'category' => '" Catégorie "',


        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
    throw new ValidationException($validator, response()->json($validator->errors(), 422));
    }
}

