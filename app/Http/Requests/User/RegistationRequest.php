<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RegistationRequest extends FormRequest
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
            'name' => ['required'],
            'phone' => ['required', 'numeric', 'min:11', 'unique:users,phone'],
            'password' => ['required', 'confirmed'],
//            'role' => ['required'], // Add this line to validate the 'role' field
            'city' => ['required'],
            'shopping_address' => ['required'],
        ];
    }
}
