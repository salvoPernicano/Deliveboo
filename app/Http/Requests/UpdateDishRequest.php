<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDishRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Imposta l'autorizzazione a true se vuoi consentire sempre l'aggiornamento del piatto
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
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric|min:1',
            'visible' => 'required|boolean',
            'category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,webp,jpg,gif|max:2048'
        ];
    }
}
