<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TimeframeRequest extends FormRequest
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
        $currentNom = $this->route('timeframe'); // route model binding (string PK)

        $nomRule = ['required', 'string', 'max:50'];
        if ($this->isMethod('post')) {
            $nomRule[] = Rule::unique('timeframes', 'Nom');
        } else {
            if ($currentNom) {
                $nomRule[] = Rule::unique('timeframes', 'Nom')->ignore($currentNom, 'Nom');
            }
        }

        return [
            'Nom' => $nomRule,
            'Description' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'Nom.required' => 'Le nom est obligatoire.',
            'Nom.unique' => 'Ce timeframe existe déjà.',
            'Nom.max' => 'Le nom ne doit pas dépasser 50 caractères.',
            'Description.max' => 'La description ne doit pas dépasser 255 caractères.',
        ];
    }
}
