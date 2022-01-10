<?php

namespace App\Http\Controllers\Account\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\User\Forum\StoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ForumController extends Controller
{
    public function index()
    {
        return view('account.user.forum.index');
    }

    public function create()
    {
        return view('account.user.forum.create');
    }
    public function store(StoreRequest $request)
    {
        // Create forum
        auth('user')->user()->forums()->create([
            'title'=>$request->title,
            'english_title'=>$request->english_title,
            'slug'=>Str::slug($request->title,'-',null),
            'demo'=>$request->demo,
            'category'=>json_encode($request->category),
        ]);

        return redirect()->route('account.user.forum.create')->with('success',['انجمن '.$request->title.' با موفقیت ایجاد شد']);
    }
}
