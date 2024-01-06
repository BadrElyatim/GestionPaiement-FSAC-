<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRegisseurRequest extends FormRequest
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
            'prenom' => ['required', 'string', 'max:255'],
            'nom' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:255', Rule::when($this->regisseur->telephone != $this->telephone, Rule::unique('users'))],
            'email' => ['required', 'email', 'max:255', Rule::when($this->regisseur->email != $this->email, Rule::unique('users'))],
            'password' => ['required', 'string', 'max:255']
        ];
    }
}
