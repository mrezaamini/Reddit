<?php

namespace App\Http\Controllers\Account\User;

use App\Http\Controllers\Controller;
use App\Models\Forum;
use App\Http\Requests\Account\User\Forum\{StoreRequest,UpdateRequest};
use Illuminate\Support\Str;

class ForumController extends Controller
{
    public function index()
    {
        return view('account.user.forum.index',[
            'forums'=>auth('user')->user()->forums()->orderBy('id','DESC')->get()
        ]);
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

        return redirect()->route('account.user.forum.index')->with('success',['انجمن '.$request->title.' با موفقیت ایجاد شد']);
    }

    public function edit(Forum $forum)
    {;
        return view('account.user.forum.edit',[
            'forum'=>$forum
        ]);
    }
    public function update(UpdateRequest $request,Forum $forum)
    {
        // edit forum
        $forum->update([
            'title'=>$request->title,
            'english_title'=>$request->english_title,
            'slug'=>Str::slug($request->title,'-',null),
            'demo'=>$request->demo,
            'category'=>json_encode($request->category)
        ]);

        return redirect()->route('account.user.forum.index')->with('success',['انجمن '.$request->title.' با موفقیت ویرایش شد']);
    }
}
