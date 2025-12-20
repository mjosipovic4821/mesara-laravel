<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaterijalUpdateRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'naziv' => ['required', 'string', 'max:120', 'unique:materijals,naziv'],
            'jedinica_mere' => ['required', 'string', 'max:12'],
            'zaliha' => ['required', 'numeric', 'between:-999999999.999,999999999.999'],
            'referentna_cena' => ['nullable', 'numeric', 'between:-9999999999.99,9999999999.99'],
        ];
    }
}
