<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDishRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Imposta l'autorizzazione a true se vuoi consentire sempre la creazione del piatto
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
            'restaurant_id' => 'required|exists:restaurants,id',
            'name' => 'required|max:255',
            'description' => 'required|nullable',
            'price' => 'required|numeric|min:1',
            'visible' => 'required|boolean',
            'category' => 'required',
            'image' => 'required|nullable|image', // Esempio di regola per validare un'immagine
        ];
    }
}
