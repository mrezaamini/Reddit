<?php

namespace App\Http\Controllers\Home\Forum;

use App\Http\Controllers\Controller;
use App\Models\Forum;
use App\Models\Post;

class PostController extends Controller
{
    public function show(Forum $forum,Post $post)
    {
        return view('home.forum.post.show',[
            'forum'=>$forum,
            'post'=>$post
        ]);
    }

    public function like(Forum $forum,Post $post)
    {
    	// Check if block
    	if(auth('user')->user()->isForumBlock($forum))
	    {
	    	return redirect()->route('home.forum.post.show',[$forum->slug,$post->id])->withErrors(['شما توسط مدیر انجمن محدود شده اید و امکان انجام این درخواست وجود ندارد']);
	    }

        // Detach dislike
        $post->usersDislike()->detach(auth('user')->id());

        if($post->isUserLike(auth('user')->user()))
        {
            $post->usersLike()->detach(auth('user')->id());
        }else{
            $post->usersLike()->attach(auth('user')->id());
        }

        return redirect()->route('home.forum.post.show',[$forum->slug,$post->id])->with('success',['درخواست شما با موفقیت انجام شد']);
    }
	public function dislike(Forum $forum,Post $post)
	{
		// Check if block
		if(auth('user')->user()->isForumBlock($forum))
		{
			return redirect()->route('home.forum.post.show',[$forum->slug,$post->id])->withErrors(['شما توسط مدیر انجمن محدود شده اید و امکان انجام این درخواست وجود ندارد']);
		}

		// Detach like
		$post->usersLike()->detach(auth('user')->id());

		if($post->isUserDislike(auth('user')->user()))
		{
			$post->usersDislike()->detach(auth('user')->id());
		}else{
			$post->usersDislike()->attach(auth('user')->id());
		}

		return redirect()->route('home.forum.post.show',[$forum->slug,$post->id])->with('success',['درخواست شما با موفقیت انجام شد']);
	}
	public function save(Forum $forum,Post $post)
	{
		// Check if block
		if(auth('user')->user()->isForumBlock($forum))
		{
			return redirect()->route('home.forum.post.show',[$forum->slug,$post->id])->withErrors(['شما توسط مدیر انجمن محدود شده اید و امکان انجام این درخواست وجود ندارد']);
		}

		if($post->isUserSave(auth('user')->user()))
		{
			$post->usersSave()->detach(auth('user')->id());
		}else{
			$post->usersSave()->attach(auth('user')->id());
		}

		return redirect()->route('home.forum.post.show',[$forum->slug,$post->id])->with('success',['درخواست شما با موفقیت انجام شد']);
	}
}
