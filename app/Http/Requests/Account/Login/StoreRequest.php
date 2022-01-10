<?php

namespace App\Http\Requests\Account\Login;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username'=>['required'],
            'password'=>['required'],
        ];
    }
}
