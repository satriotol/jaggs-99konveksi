<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrdersRequest extends FormRequest
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
            'user_id'=>'required',
            'judul'=>'required',
            'cust_name'=>'required',
            'cust_email'=>'required|email',
            'cust_phone'=>'required|numeric',
            'start_date'=>'required|date',
            'end_date'=>'required|date',
        ];
    }
}
