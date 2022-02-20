<?php

namespace App\Http\Requests;
 
use Illuminate\Foundation\Http\FormRequest;

class PavillionRequest extends FormRequest
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
            'logo' => 'required',
            'main_banner' => 'required',
            'right_banner_1' => 'required',
            'right_banner_2' => 'required',
            'left_banner' => 'required'
        ];
    }
}
