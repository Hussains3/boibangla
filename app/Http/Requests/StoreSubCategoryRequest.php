<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubCategoryRequest extends FormRequest
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
        $subCategoryCheckArray =  [
            'subCategory' => 'required|min:2',
            'slug' => 'required',
            'category' => 'required',
            'description' => 'sometimes',
        ];
        if ($this->method() == 'PATCH') {
            $subCategoryCheckArray['editId'] = 'required|integer|min:1|exists:sub_categories,id';
        }
        return $subCategoryCheckArray;
    }
}
