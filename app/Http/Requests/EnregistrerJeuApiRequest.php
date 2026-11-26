<?php

namespace App\Http\Requests;

use App\Models\Jeu;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EnregistrerJeuApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->isMethod('post')) {
            return Gate::allows('create', Jeu::class);
        }

        return Gate::allows('update', $this->route('jeu'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $presence = $this->isMethod('post') ? 'required' : 'sometimes';

        return [
            'nomJeu' => [
                $presence,
                'string',
                'max:50',
                Rule::unique('jeux', 'nomJeu')->ignore($this->route('jeu'))
            ],
            'prix' => [$presence, 'numeric', 'min:1'],
            'description' => [$presence, 'string', 'max:150'],
            'reduction' => [$presence, 'boolean'],
            'prixRabais' => ['sometimes', 'nullable', 'numeric', 'min:0', 'lte:prix'],
            'categorie' => [$presence, 'string', 'max:50'],
            'image' => ['sometimes', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }
}
