<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
        $validateArr =  [
            'title' => 'required|string|min:5|max:100',
            'sub_title' => 'required|string|min:5|max:100',
            'button_label' => 'required|string|min:5|max:20',
            'button_link' => 'required|url',
        ];
        if (!$this->pre_file){
            $validateArr['media'] = 'sometimes|image|mimes:jpg,jpeg,png,JPG,JPEG,PNG|dimensions:width=805,height=280';
        }
        return $validateArr;
    }
}
