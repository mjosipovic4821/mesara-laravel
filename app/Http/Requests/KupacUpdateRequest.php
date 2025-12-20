<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KupacUpdateRequest extends FormRequest
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
            'naziv_kupca' => ['required', 'string', 'max:120'],
            'telefon' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:120'],
            'adresa' => ['nullable', 'string', 'max:160'],
            'grad' => ['nullable', 'string', 'max:80'],
            'pib' => ['nullable', 'string', 'max:20', 'unique:kupacs,pib'],
        ];
    }
}
