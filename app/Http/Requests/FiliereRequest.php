<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FiliereRequest extends FormRequest
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
            'nom' => ['required', 'string', 'max:255'],
            'date_accreditation' => ['required', 'date'],
            'type' => ['required', 'string', 'max:255'],
            'duree' => ['required', 'integer'],
            'annee_universitaire' => ['required', 'string', 'max:255'],
            'professeur_id' => ['required', 'integer'],
            'cout' => ['required', 'numeric', 'between:0.00,99999999.99']
        ];
    }
}
