<?php

namespace App\Http\Requests\Account\User\Forum;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
	// Authorize request sent by user
	public function authorize()
    {
        return true;
    }

    // Validate sent data from user to create new forum
    public function rules()
    {
        return [
            'title'=>['required','unique:forums,title','min:10','max:191'],
            'english_title'=>['required','min:10','max:191','regex:/^[a-zA-Z\s]+$/'],
            'demo'=>['required','min:100','max:1000'],
            'category'=>['required','array','min:3'],
            'category.*'=>['required']
        ];
    }
    public function messages()
    {
        return [
            'category.*.*'=>'تگ ها باید فقط شامل حروف فارسی و انگلیسی باشند',
            'english_title.regex'=>'عنوان دوره به زبان انگلیسی باید شامل حروف انگلیسی و فاصله باشد',
        ];
    }
    public function attributes()
    {
        return [
            'title'=>'عنوان انجمن',
            'english_title'=>'عنوان انجمن به زبان انگلیسی',
            'demo'=>'محتوا',
            'category'=>'دسته بندی'
        ];
    }
}
