<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|min:1|max:50|unique:users,email',
            'phone' => 'required|unique:users,phone|min:11',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ];
    }
}
