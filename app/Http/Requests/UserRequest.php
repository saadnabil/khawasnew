<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $id = $this->route('user')->id ?? null;
        if(request()->isMethod('post')){
            return [
                'name' => 'required|string|max:250',
                'email' => 'required|email|unique:users',
                'phone' => 'required',
                'image' => 'nullable|image|mimes:png,jpg,gif,svg',
                'status' => 'nullable',
                'password' =>  ['required' , 'string'],
                'confirmpassword' =>  ['required_with:password' , 'string','same:password'],
            ];
        }else
            return [
                'name' => 'required|string|max:250',
                'email' => ['required' , 'email' ,'unique:users,email,'.$id],
                'phone' => 'required',
                'image' => 'nullable|image|mimes:png,jpg,gif,svg',
                'status' => 'nullable',
                'password' =>  ['nullable' , 'string'],
                'confirmpassword' =>  ['nullable','required_with:password' , 'string','same:password'],
            ];
        }
}
