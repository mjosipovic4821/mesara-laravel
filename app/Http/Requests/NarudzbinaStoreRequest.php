<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NarudzbinaStoreRequest extends FormRequest
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
        return [
            'kupac_id' => ['required', 'exists:kupacs,id'],
            'radnik_id' => ['required', 'exists:radniks,id'],
            'napomena' => ['nullable', 'string', 'max:1000'],

            'items' => ['required', 'array', 'min:1'],
            'items.*.proizvod_id' => ['required', 'exists:proizvods,id'],
            'items.*.kolicina' => ['required', 'numeric', 'gt:0'],
        ];
    }
}
