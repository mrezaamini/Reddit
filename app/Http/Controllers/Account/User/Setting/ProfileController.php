<?php

namespace App\Http\Controllers\Account\User\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\User\Setting\Profile\UpdateRequest;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
	// Return setting page view
	public function index()
	{
		return view('account.user.setting');
	}

	// Update user data with sent data from user
	public function update(UpdateRequest $request)
	{
		auth('user')->user()->update([
			'name'=>$request->name,
			'surname'=>$request->surname,
			'email'=>$request->email,
			'username'=>$request->username,
		]);
		if($request->password)
		{
			auth('user')->user()->update([
				'password'=>Hash::make($request->password),
			]);
		}

		return redirect()->route('account.user.setting.profile')->with('success',['درخواست شما با موفقیت انجام شد']);
	}
}
