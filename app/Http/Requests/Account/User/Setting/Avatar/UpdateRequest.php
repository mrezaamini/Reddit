<?php

namespace App\Http\Requests\Account\User\Setting\Avatar;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'avatar'=>['required','file','image','max:512kb','dimensions:ratio=1'],
        ];
    }
    public function messages()
    {
        return [
            'avatar.dimensions'=>'ابعاد عکس پروفایل باید حتما مربع باشد'
        ];
    }
}
