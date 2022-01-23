<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuyersRequest extends FormRequest
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
            'full_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'country' => 'required',
            'city' => 'required',
            'company' => 'required',
            'interested_keywords' => 'required',
            'verified' => 'required',
            'active' => 'required', 
        ];
    }
}
