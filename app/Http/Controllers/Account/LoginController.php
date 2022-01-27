<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\Login\StoreRequest;

class LoginController extends Controller
{
	// Show login page
    public function index()
    {
        return view('account.login');
    }

    // Login to session by sent data from login page view
    public function login(StoreRequest $request)
    {
        // Login to auth
        if(auth('user')->attempt(['username'=>$request->username,'password'=>$request->password]))
        {
            return redirect()->route('account.user.desk')->with('success',[auth('user')->user()->name.' '.auth('user')->user()->surname.' عزیز، با موفقیت به حساب کاربری وارد شدید']);
        }else{
            return redirect()->route('account.login')->withErrors('نام کاربری و یا گذرواژه اشتباه می باشد');
        }
    }
}
