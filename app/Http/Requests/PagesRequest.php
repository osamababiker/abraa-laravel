<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PagesRequest extends FormRequest
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
            'sort_id' => 'required',
            'ar_title' => 'required',
            'en_title' => 'required',
            'ar_content' => 'required',
            'en_content' => 'required',
            'ar_visits' => 'required',
            'en_visits' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keyword' => 'required'
        ];
    }
}
