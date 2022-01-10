<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\Login\StoreRequest;

class LoginController extends Controller
{
    public function index()
    {
        return view('account.login');
    }

    public function login(StoreRequest $request)
    {
        // Login to auth
        if(auth('user')->attempt(['username'=>$request->username,'password'=>$request->password]))
        {
            return redirect()->route('account.user.desk')->with('success',[$request->name.' '.$request->surname.' عزیز، با موفقیت به حساب کاربری وارد شدید']);
        }else{
            return redirect()->route('account.login')->withErrors('نام کاربری و یا گذرواژه اشتباه می باشد');
        }
    }
}
