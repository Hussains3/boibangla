<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookUploadRequest extends FormRequest
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
            'book_file' => 'required|mimes:csv,txt',
            'book_images.*' =>'required|image|mimes:jpg,jpeg,png,JPG,JPEG,PNG'
        ];
    }
}
