<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FakturaUpdateRequest extends FormRequest
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
            'kupac_id' => ['required', 'integer', 'exists:kupacs,id'],
            'radnik_id' => ['required', 'integer', 'exists:radniks,id'],
            'datum' => ['required', 'date'],
            'napomena' => ['nullable', 'string'],
            'ukupno' => ['nullable', 'numeric', 'between:-9999999999.99,9999999999.99'],
            'kupac_radnik_id' => ['required', 'integer', 'exists:kupac_radniks,id'],
        ];
    }
}
