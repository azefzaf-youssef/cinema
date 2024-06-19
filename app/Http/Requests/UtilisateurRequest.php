<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;


class UtilisateurRequest extends FormRequest
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

            'name' => 'required',
            'email' => ["required" ,"email",Rule::unique('users')->ignore($this->id, 'id')],
            'password' => "{$required}|min:8|required_with:password_conf|same:password_conf",
            'password_conf' => "{$required}"

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

            'name' => '" Nom "',
            'email' => '" Email "',
            'password' => '" Mot de passe "',
            'password_conf' => '"Confirmation mot de passe "',


        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
    throw new ValidationException($validator, response()->json($validator->errors(), 422));
    }
}

