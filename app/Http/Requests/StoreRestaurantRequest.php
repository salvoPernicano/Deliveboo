<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRestaurantRequest extends FormRequest
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
            'name' => ['required', 'unique:restaurants', 'max:250'],
            'address' => ['required', 'max:150'],
            'p_iva' => ['required', 'unique:restaurants','max:11'],
            'image' => ['nullable', 'image'],
            'description' => ['nullable','max:1024'],
            'user_id' => ['required', 'exists:users,id'],
        ];
    }
}
