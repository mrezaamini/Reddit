<?php

namespace App\Http\Requests\Account\User\Setting\Avatar;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
	// Authorize request sent by user
	public function authorize()
    {
        return true;
    }

    // Validate image sent by user to add or replace avatar
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
