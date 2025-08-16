<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TypeMarchRequest extends FormRequest
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
        // Since the primary key of the model is the 'Nom' field (string),
        // we must ignore the current value when updating. Resource route param name is 'type_march'.
        $currentNom = $this->route('type_march'); // Will be null on create

        $nomRule = [
            'required',
            'string',
            'max:100',
        ];

        if ($this->isMethod('post')) {
            // Create: enforce uniqueness
            $nomRule[] = Rule::unique('type_marches', 'Nom');
        } else {
            // Update: Nom is not editable (readonly in form). Still validate existence & uniqueness ignoring itself.
            if ($currentNom) {
                $nomRule[] = Rule::unique('type_marches', 'Nom')->ignore($currentNom, 'Nom');
            }
        }

        return [
            'Nom' => $nomRule,
            'Description' => ['nullable', 'string', 'max:255'],
        ];
    }

    /**
     * Custom messages.
     */
    public function messages(): array
    {
        return [
            'Nom.required' => 'Le nom est obligatoire.',
            'Nom.unique' => 'Ce nom de type de marché existe déjà.',
            'Nom.max' => 'Le nom ne doit pas dépasser 100 caractères.',
            'Description.max' => 'La description ne doit pas dépasser 255 caractères.',
        ];
    }
}
