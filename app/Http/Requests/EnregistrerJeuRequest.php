<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class EnregistrerJeuRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nomJeu' => ['required', 'string', 'max:30'],
            'prix' => ['required', 'numeric', 'min:0'],
            'description' => ['required', 'string', 'max:200'],
            'reduction' => ['required', 'boolean'],
            'categorie' => ['required', 'string', 'in:Horreur,Action,Aventure,RPG'],
        ];
    }
}
