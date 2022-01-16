<?php

namespace App\Http\Controllers\Home\Forum;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Forum;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request,Forum $forum,Post $post)
    {
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

    public function like(Forum $forum,Post $post,Comment $comment)
    {
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
    public function dislike(Forum $forum,Post $post,Comment $comment)
    {
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
