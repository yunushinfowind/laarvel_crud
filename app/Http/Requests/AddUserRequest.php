<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
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
            "first_name"  => "required",
            "last_name"=> "required",
            "date_of_birth" => "required|date_format:Y-m-d|before:today",
            "age" => "required|numeric",
            "home_phone" => "required",
            "mobile_phone" => "required",
            "email" => "required|email",
            "street_address" => "required",
            "city" => "required",
            "state" => "required",
            "zip_code" => "required"
        
         ];
     
    }
}
