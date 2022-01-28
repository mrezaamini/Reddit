<?php

namespace App\Http\Requests\Account\User\Setting\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
	// Authorize request sent by user
	public function authorize()
	{
		return true;
	}

	// Validate sent data from users to register as new user
	public function rules()
	{
		$rules=[
			'name'=>['required','max:35'],
			'surname'=>['required','max:35'],
			'username'=>['required','regex:/^[a-zA-Z][a-zA-Z0-9._]+$/','unique:users,username,'.auth('user')->id()],
			'email'=>['required','email','unique:users,email,'.auth('user')->id()]
		];
		if($this->password)
		{
			$rules=array_merge($rules,[
				'password'=>['regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/'],
			]);
		}

		return $rules;
	}
	public function messages()
	{
		return [
			'password.regex'=>'گذرواژه باید حداقل 8 کاراکتر و شامل یک حروف بزرگ، یک حروف کوچیک و یک عدد باشد',
			'email.email'=>'ایمیل وارد شده صحیح نمی باشد',
		];
	}
}
