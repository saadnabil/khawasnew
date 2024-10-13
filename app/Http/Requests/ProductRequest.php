<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'title.*' => ['required', 'string', 'max:250'],
            'item_type_id' => ['required', 'numeric'],
            'description.*' => ['nullable', 'string'],
            'unit.*' => ['required', 'string', 'max:250'],
            'units_number' => ['required', 'numeric', 'min:1'],
            'total_price' => ['required', 'numeric'],
            'tax' => ['required', 'numeric', 'min:0'],
            'unit_price' => ['required', 'numeric', 'min:1'],
            'quantity' => ['required', 'numeric', 'min:1'],
            'min' => 'nullable|integer|min:0',
            'max' => 'nullable|integer|min:0',
            'admin_id' => ['numeric'],
            'editor_id' => ['numeric'],
            'barcode' => ['required', 'string'],
            'selected_image' => 'nullable|string',
            'image' => ['nullable', 'image', 'mimes:png,jpg,giv,svg'],
            //
        ];
    }
}
