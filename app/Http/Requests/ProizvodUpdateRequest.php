<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProizvodUpdateRequest extends FormRequest
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
            'naziv_proizvoda' => ['required', 'string', 'max:120', 'unique:proizvods,naziv_proizvoda'],
            'tip' => ['nullable', 'string', 'max:30'],
            'prodajna_cena' => ['required', 'numeric', 'between:-9999999999.99,9999999999.99'],
            'zaliha' => ['required', 'numeric', 'between:-999999999.999,999999999.999'],
            'aktivan' => ['required'],
        ];
    }
}
