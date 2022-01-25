<?php

namespace App\Http\Controllers\Home\Forum;

use App\Http\Controllers\Controller;
use App\Models\Forum;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index()
    {
        return view('home.forum.index',[
            'forums'=>Forum::get()
        ]);
    }
    public function show(Forum $forum,Request $request)
    {
    	switch($request->get('orderBy'))
	    {
		    case 0;
			    $posts=$forum->posts()->orderBy('id','DESC')->get();;
			    break;
		    case 1;
			    $posts=$forum->posts()->orderBy('id','ASC')->get();;
			    break;
		    case 2;
			    $posts=$forum->posts()->withCount('usersLike')->orderBy('users_like_count','ASC')->get();;
			    break;
		    case 3;
			    $posts=$forum->posts()->withCount('usersLike')->orderBy('users_like_count','DESC')->get();;
			    break;
		    case 4;
			    $posts=$forum->posts()->withCount('usersComment')->orderBy('users_comment_count','ASC')->get();;
			    break;
		    case 5;
			    $posts=$forum->posts()->withCount('usersComment')->orderBy('users_comment_count','DESC')->get();;
			    break;
	    }
        return view('home.forum.show',[
            'forum'=>$forum,
	        'posts'=>$posts
        ]);
    }

    public function join(Forum $forum)
    {
        // Check
        if(
            auth('user')->user()->forums()->where('id','=',$forum->id)->exists() ||
           $forum->isUserJoined(auth('user')->user())
        ){
            abort(403);
        }

        // Join user
        $forum->joinedUsers()->attach(auth('user')->id());

        return redirect()->route('home.forum.show',$forum->slug)->with('success',['درخواست شما با موفقیت انجام شد']);
    }
    public function leave(Forum $forum)
    {
        // Check
        if(
            auth('user')->user()->forums()->where('id','=',$forum->slug)->exists() ||
            !$forum->isUserJoined(auth('user')->user())
        ){
            abort(403);
        }

        // Leave user
        $forum->joinedUsers()->detach(auth('user')->id());

        return redirect()->route('home.forum.show',$forum->slug)->with('success',['درخواست شما با موفقیت انجام شد']);
    }
}
