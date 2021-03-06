<?php

namespace App\Http\Controllers\Account\User;

use App\Http\Controllers\Controller;
use App\Models\Forum;
use App\Models\User;
use App\Http\Requests\Account\User\Forum\{StoreRequest,UpdateRequest};
use Illuminate\Support\Str;

class ForumController extends Controller
{
	// Show owned forum or forum you are the admin
    public function index()
    {
        return view('account.user.forum.index',[
            'ownedForums'=>auth('user')->user()->forums()->orderBy('id','DESC')->get(),
            'forumsAdmin'=>auth('user')->user()->forumsAdmin()->orderBy('id','DESC')->get()
        ]);
    }

    // Select data from table by id and return the view (all information)
    public function show(Forum $forum)
    {
        return view('account.user.forum.show',[
            'forum'=>$forum
        ]);
    }

    // Return create forum view
    public function create()
    {
        return view('account.user.forum.create');
    }

    // Create forum with sent data from create view
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

    // Return edit forum view (with selected forum data)
    public function edit(Forum $forum)
    {;
        return view('account.user.forum.edit',[
            'forum'=>$forum
        ]);
    }

    // Update the selected forum in edit function
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

    // Attach new admin or detach old admin from joined users in selected forum
	public function changeAdmin(Forum $forum,User $user)
	{
		// Check owner
		if($forum->user->id!=auth('user')->id())
		{
			return abort(404);
		}

		// Check if user is joined forum
		if(!$user->isJoinedForum($forum))
		{
			return abort(404);
		}

		// Check if admin
		if(!$user->isForumAdmin($forum))
		{
			$forum->admins()->attach($user);
		}else{
			$forum->admins()->detach($user);
		}

		return redirect()->route('account.user.forum.show',$forum->id)->with('success',['درخواست شما با موفقیت انجام شد']);
	}

	// Block or unblock joined users in selected forum
	public function changeBlock(Forum $forum,User $user)
	{
		// Check owner
		if($forum->user->id!=auth('user')->id())
		{
			return abort(404);
		}

		// Check if user is joined forum
		if(!$user->isJoinedForum($forum))
		{
			return abort(404);
		}

		// Check if admin
		if(!$user->isForumAdmin($forum))
		{
			return abort(404);
		}

		// Block
		if(!$user->isForumBlock($forum))
		{
			$forum->blocks()->attach($user);
		}else{
			$forum->blocks()->detach($user);
		}

		return redirect()->route('account.user.forum.show',$forum->id)->with('success',['درخواست شما با موفقیت انجام شد']);
	}
}
