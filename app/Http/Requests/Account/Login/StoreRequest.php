<?php

namespace App\Http\Requests\Account\Login;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
	// Authorize request sent by user
    public function authorize()
    {
        return true;
    }

    // Validate sent data from user login as registered user
    public function rules()
    {
        return [
            'username'=>['required'],
            'password'=>['required'],
        ];
    }
}
