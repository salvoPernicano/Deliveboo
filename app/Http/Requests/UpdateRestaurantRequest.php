<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRestaurantRequest extends FormRequest
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
            'name' => 'required|max:250',
            'address' => 'required|max:150',
            'p_iva' => 'required|size:11',
            'image' => 'nullable',
            'description' => 'nullable|max:1024',
            'user_id' => 'required',
            'selectedTypologies' => 'required|array',
            'selectedTypologies.*' => 'exists:typologies,id'
        ];
    }
}
