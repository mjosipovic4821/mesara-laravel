<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RasporedStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'radnik_id' => ['required', 'integer', 'exists:radniks,id'],
            'week_start' => ['required', 'date'],
            'dan' => ['required', 'integer', 'min:0', 'max:6'],
            'smena' => ['required', 'in:jutro,vece,slobodan'],
            'zadatak' => ['nullable', 'string', 'max:255'],
        ];
    }
}
