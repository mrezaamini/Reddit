<?php

namespace App\Http\Requests\Account\Register;

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
            'name'=>['required','max:35'],
            'surname'=>['required','max:35'],
            'username'=>['required','regex:/^[a-zA-Z][a-zA-Z0-9._]+$/','unique:users,username'],
            'password'=>['required','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/'],
            'email'=>['required','email','unique:users,email']
        ];
    }

    public function messages()
    {
        return [
            'password.regex'=>'گذرواژه باید حداقل 8 کاراکتر و شامل یک حروف بزرگ، یک حروف کوچیک و یک عدد باشد',
            'email.email'=>'ایمیل وارد شده صحیح نمی باشد',
        ];
    }
}
