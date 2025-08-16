<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Actif;

class ActifRequest extends FormRequest
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
        // Determine current Actif (for update) via route-model binding
        /** @var Actif|null $actif */
        $actif = $this->route('actif');

        $typeMarcheRule = ['required', 'string', 'max:100', 'exists:type_marches,Nom'];
        $symboleRule = ['required', 'string', 'max:50'];
        $nomRule = ['required', 'string', 'max:100'];

        // Unique composite (TypeMarche, Symbole). We enforce via custom unique rule on Symbole field.
        if ($this->isMethod('post')) {
            $symboleRule[] = Rule::unique('actifs')->where(function ($q) {
                return $q->where('TypeMarche', $this->input('TypeMarche'));
            });
        } elseif ($actif) {
            $symboleRule[] = Rule::unique('actifs')->where(function ($q) {
                return $q->where('TypeMarche', $this->input('TypeMarche'));
            })->ignore($actif->id);
        }

        return [
            'TypeMarche' => $typeMarcheRule,
            'Symbole' => $symboleRule,
            'Nom' => $nomRule,
        ];
    }

    public function messages(): array
    {
        return [
            'TypeMarche.required' => 'Le type de marché est obligatoire.',
            'TypeMarche.exists' => 'Le type de marché sélectionné est invalide.',
            'Symbole.required' => 'Le symbole est obligatoire.',
            'Symbole.unique' => 'Ce symbole existe déjà pour ce type de marché.',
            'Nom.required' => 'Le nom est obligatoire.',
        ];
    }
}
