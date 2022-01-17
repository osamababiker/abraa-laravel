<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdsRequest extends FormRequest
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
            'name' => 'required',
            'sub_of' => 'required',
            'ad_type' => 'required',
            'link' => 'required',
            'pic_url' => 'required',
            'ad_code' => 'nullable',
            'alt_txt' => 'required',
            'start_on' => 'required',
            'expire_on' => 'required',
            'lang' => 'required',
            'active' => 'required'
        ];
    }
}
