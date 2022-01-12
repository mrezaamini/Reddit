<?php

namespace App\Http\Requests\Account\User\Post;

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
            'title'=>['required','unique:posts,id,'.$this->route('user_post')->id,'min:10','max:191'],
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
