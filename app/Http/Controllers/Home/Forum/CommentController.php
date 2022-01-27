<?php

namespace App\Http\Controllers\Home\Forum;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Forum;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
	// Add comment to selected post
    public function store(Request $request,Forum $forum,Post $post)
    {
    	// Check if block
        if(auth('user')->user()->isForumBlock($forum))
		{
			return redirect()->route('home.forum.post.show',[$forum->slug,$post->id])->withErrors(['شما توسط مدیر انجمن محدود شده اید و امکان انجام این درخواست وجود ندارد']);
		}

        if(!$request->text)
        {
            return redirect()->route('home.forum.post.show',[$forum->slug,$post->id])->withErrors('کامنت شما باید دارای متن باشد');
        }

        $post->comments()->create([
            'user_id'=>auth('user')->id(),
            'text'=>$request->text,
            'comment_id'=>$request->comment_id ? $request->comment_id : null
        ]);

        return redirect()->route('home.forum.post.show',[$forum->slug,$post->id])->with('success',['کامنت شما با موفقیت اضافه شد']);
    }

    // Add like to selected post by user
    public function like(Forum $forum,Post $post,Comment $comment)
    {
    	// Check if block
        if(auth('user')->user()->isForumBlock($forum))
		{
			return redirect()->route('home.forum.post.show',[$forum->slug,$post->id])->withErrors(['شما توسط مدیر انجمن محدود شده اید و امکان انجام این درخواست وجود ندارد']);
		}

        // Detach dislike
        $comment->usersDislike()->detach(auth('user')->id());

        if($comment->isUserLike(auth('user')->user()))
        {
            $comment->usersLike()->detach(auth('user')->id());
        }else{
            $comment->usersLike()->attach(auth('user')->id());
        }

        return redirect()->route('home.forum.post.show',[$forum->slug,$post->id])->with('success',['درخواست شما با موفقیت انجام شد']);
    }

	// Add dislike to selected post by user
    public function dislike(Forum $forum,Post $post,Comment $comment)
    {
    	// Check if block
        if(auth('user')->user()->isForumBlock($forum))
		{
			return redirect()->route('home.forum.post.show',[$forum->slug,$post->id])->withErrors(['شما توسط مدیر انجمن محدود شده اید و امکان انجام این درخواست وجود ندارد']);
		}

        // Detach like
        $comment->usersLike()->detach(auth('user')->id());

        if($comment->isUserDislike(auth('user')->user()))
        {
            $comment->usersDislike()->detach(auth('user')->id());
        }else{
            $comment->usersDislike()->attach(auth('user')->id());
        }

        return redirect()->route('home.forum.post.show',[$forum->slug,$post->id])->with('success',['درخواست شما با موفقیت انجام شد']);
    }
}
