<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddEtudiantRequest extends FormRequest
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
            'cne' => ['required', 'unique:etudiants', 'integer'],
            'cin' => ['required', 'string', 'max:255'],
            'lieu_de_naissance' => ['required', 'string', 'max:255'],
            'date_de_naissance' => ['required', 'date', 'max:255'],
            'filiere_id' => ['required', 'integer']
        ];
    }
}
