<?php

namespace App\Http\Requests\Admins;

use Illuminate\Foundation\Http\FormRequest;

class CouponsFormRequest extends FormRequest
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
        $id = $this->route('coupon')->id ?? null;
        $data =  [
            'description' => ['nullable' , 'string' ,'max:30'],
            'discount' => ['required' , 'numeric' ,'min:0', 'max:100'],
            'quantity' => ['required' , 'numeric' ,'min:1'],
            'valid_from' => ['required' , 'date','after_or_equal:' . now()->format('Y-m-d h:i:s')],
            'valid_to' => ['required' , 'date','after_or_equal:valid_from'],
            'user_ids' => ['required', 'array'],
            'user_ids.*' => ['required', 'numeric'],
            'type' => ['required', 'in:fixed,percent'],  // Added validation rule for 'type'

        ];
        if(request()->isMethod('post')){
            $data['code'] = ['required' , 'string', 'max:10','unique:coupons,code'];
        }else{
            $data['code'] = ['required' , 'string', 'max:10','unique:coupons,code,'.$id];
        }
        return $data;

    }
}
