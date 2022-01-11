<?php

namespace App\Http\Controllers\Account\User\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\User\Setting\Avatar\UpdateRequest;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
    public function update(UpdateRequest $request)
    {
        // Remove old avatar
        if(auth('user')->user()->avatar)
        {
            Storage::disk('public_media')->delete(auth('user')->user()->avatar);
        }

        // Upload new avatar
        auth('user')->user()->update([
            'avatar'=>Storage::disk('public_media')->put('avatar',$request->file('avatar'))
        ]);

        return redirect()->back()->with('success',['عکس پروفایل شما با موفقیت بارگذاری شد']);
    }
}
