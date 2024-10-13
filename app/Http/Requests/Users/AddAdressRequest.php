<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class AddAdressRequest extends FormRequest
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
            'label' => ['required' ,'string'],
            'address' => ['required' ,'string'],
            'country_id' => ['required', 'integer', 'exists:countries,id'],
            'city_id' => ['required', 'integer', 'exists:cities,id'],
            'state_id' => ['required', 'integer', 'exists:areas,id'],
            'zip' => ['required' ,'string'],

            //
        ];
    }
}
