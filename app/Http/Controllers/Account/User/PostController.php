<?php

namespace App\Http\Controllers\Account\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\User\Post\{StoreRequest,UpdateRequest};
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        return view('account.user.post.index',[
            'myPosts'=>auth('user')->user()->posts,
            'forumsPosts'=>auth('user')->user()->forumsPosts
        ]);
    }

    public function create()
    {
        return view('account.user.post.create',[
            'joinedForums'=>auth('user')->user()->joinedForums,
            'ownedForums'=>auth('user')->user()->forums,
        ]);
    }
    public function store(StoreRequest $request)
    {
        // Create post
        auth('user')->user()->posts()->create([
            'title'=>$request->title,
            'content'=>$request->post_content,
            'forum_id'=>$request->forum_id
        ]);

        return redirect()->route('account.user.post.index')->with('success',['پست '.$request->title.' با موفقیت ایجاد شد']);
    }

    public function edit(Post $post)
    {
        return view('account.user.post.edit',[
            'post'=>$post,
            'joinedForums'=>auth('user')->user()->joinedForums,
            'ownedForums'=>auth('user')->user()->forums,
        ]);
    }
    public function update(UpdateRequest $request,Post $post)
    {
        // Create post
        $post->update([
            'title'=>$request->title,
            'content'=>$request->post_content,
            'forum_id'=>$request->forum_id
        ]);

        return redirect()->route('account.user.post.index')->with('success',['پست '.$request->title.' با موفقیت ویرایش شد']);
    }

    public function delete(Post $post)
    {
        // Delete post
        $post->delete();

        return redirect()->route('account.user.post.index')->with('success',['درخواست شما با موفقیت انجام شد']);
    }
}
