<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriesRequest extends FormRequest
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
            'sub_of' => 'required',
            'slug' => 'required',
            'ar_title' => 'required',
            'en_title' => 'required',
            'ar_description' => 'required',
            'en_description' => 'required',
            'sort_id' => 'required',
            'sort_order' => 'required',
            'status' => 'required',
            'is_home_thumb' => 'required',
            'top_desc_id' => 'required',
            'footer_desc_id' => 'required',
            'meta_title' => 'required',
            'meta_keywords' => 'required', 
            'meta_description' => 'required'
        ];
    }
}
