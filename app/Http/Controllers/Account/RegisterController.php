<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\Register\StoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('account.register');
    }
    public function register(StoreRequest $request)
    {
        // Create user
        $user=User::create([
            'name'=>$request->name,
            'surname'=>$request->surname,
            'username'=>$request->username,
            'password'=>Hash::make($request->password),
            'email'=>$request->email,
        ]);

        // Login user to auth
        auth('user')->login($user);

        return redirect()->route('account.user.desk')->with('success',[$request->name.' '.$request->surname.' عزیز، حساب کاربری شما با موفقیت ایجاد شد']);
    }
}
