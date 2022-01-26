<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuidelinesRequest extends FormRequest
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
            'guideline_type' => 'required',
            'en_title' => 'required',
            'ar_title' => 'required',
            'en_content' => 'required',
            'ar_content' => 'required',
            'active' => 'required'
            
        ];
    }
}
