<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
        $passwordCheckArray = [
            'current_password' => 'required|string|min:4|max:20',
            'new_password' => ['nullable','required_if:currentPasswordStatus,verified','string','min:4', 'max:20'],
            'confirm_password' => ['nullable','required_if:currentPasswordStatus,verified','same:new_password','string','min:4', 'max:20'],

        ];

        return $passwordCheckArray;
    }
}
