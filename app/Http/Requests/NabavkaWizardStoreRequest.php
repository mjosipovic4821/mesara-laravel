<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NabavkaWizardStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // bitno da nije false
    }
    protected function prepareForValidation(): void
    {
        $items = $this->input('items', []);

        $items = array_values(array_filter($items, function ($row) {
            $materijal = $row['materijal_id'] ?? null;
            $kolicina = $row['kolicina'] ?? null;
            $cena = $row['cena_po_jedinici'] ?? null;

            // ostavi samo redove gde je bar nešto uneto (a ne potpuno prazno)
            return $materijal !== null || $kolicina !== null || $cena !== null;
        }));

        $this->merge(['items' => $items]);
        
    }
    public function rules(): array
    {
        return [
            'dobavljac_id' => ['required', 'integer', 'exists:dobavljacs,id'],
            'datum_nabavke' => ['required', 'date'],
            'napomena' => ['nullable', 'string'],

            'items' => ['required', 'array', 'min:1'],
            'items.*.materijal_id' => ['required', 'integer', 'exists:materijals,id'],
            'items.*.kolicina' => ['required', 'numeric', 'gt:0'],
            'items.*.cena_po_jedinici' => ['required', 'numeric', 'gte:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'items.min' => 'Mora postojati bar jedna stavka nabavke.',
        ];
    }
}
