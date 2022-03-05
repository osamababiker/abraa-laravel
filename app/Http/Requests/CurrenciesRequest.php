<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurrenciesRequest extends FormRequest
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
            'code' => 'required',
            'conversion_rate' => 'required',
            'name_ar' => 'required',
            'name_en' => 'required',
            'name_tr' => 'required',
            'name_ru' => 'required',
            'status' => 'required',
            
        ];
    }
}
