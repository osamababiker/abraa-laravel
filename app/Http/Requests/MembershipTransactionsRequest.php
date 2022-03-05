<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MembershipTransactionsRequest extends FormRequest
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
            'user_id' => 'required',
            'plan_id' => 'required',
            'total_amount' => 'required',
            'payment_status' => 'required',
            'subscription_status' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'payment_date' => 'required'
        ];
    }
}
