<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingRequest extends FormRequest
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
            'company_name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'shipping_from' => 'required',
            'shipping_to' => 'required',
            'shipping_methods' => 'required',
            'clearance' => 'required',
            'doortodoor' => 'required',
            'status' => 'required',
        ];
    }
}
