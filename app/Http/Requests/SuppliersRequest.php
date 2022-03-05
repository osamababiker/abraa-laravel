<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuppliersRequest extends FormRequest
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
            'business_name' => 'required',
            'country' => 'required',
            'interested_keywords' => 'required',
            'primary_name' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required|unique:users',
            'primary_position' => 'required',
            'primary_whatsapp' => 'required',
            'primary_line_number' => 'required'
        ];
    }
}
