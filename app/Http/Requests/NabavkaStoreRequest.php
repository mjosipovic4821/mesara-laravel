<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NabavkaStoreRequest extends FormRequest
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
            'dobavljac_id' => ['required', 'integer', 'exists:dobavljacs,id'],
            'datum_nabavke' => ['required', 'date'],
            'napomena' => ['nullable', 'string'],
            'ukupno' => ['nullable', 'numeric', 'between:-9999999999.99,9999999999.99'],
        ];
    }
}
