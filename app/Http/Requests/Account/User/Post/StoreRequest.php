<?php

namespace App\Http\Requests\Account\User\Post;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
	// Authorize request sent by user
	public function authorize()
    {
        return true;
    }

    // Validate sent data from user to create post
    public function rules()
    {
        return [
            'title'=>['required','unique:posts','min:10','max:191'],
            'forum_id'=>['required','exists:forums,id'],
            'post_content'=>['required','min:100'],
        ];
    }
    public function attributes()
    {
        return [
            'forum_id'=>'انجمن',
            'post_content'=>'محتوا'
        ];
    }
}
