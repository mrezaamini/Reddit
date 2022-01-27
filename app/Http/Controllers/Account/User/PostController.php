<?php


namespace App\Http\Controllers\Account\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\User\Post\{StoreRequest,UpdateRequest};
use App\Models\Post;

class PostController extends Controller
{
	// Show owned post or posts of all your forums
    public function index()
    {
        return view('account.user.post.index',[
            'myPosts'=>auth('user')->user()->posts,
            'forumsPosts'=>auth('user')->user()->forumsPosts
        ]);
    }

	// Return create post view
    public function create()
    {
        return view('account.user.post.create',[
            'joinedForums'=>auth('user')->user()->joinedForums,
            'ownedForums'=>auth('user')->user()->forums,
        ]);
    }

	// Create post with sent data from create view
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

	// Return edit post view (with selected post data)
	public function edit(Post $post)
    {
        return view('account.user.post.edit',[
            'post'=>$post,
            'joinedForums'=>auth('user')->user()->joinedForums,
            'ownedForums'=>auth('user')->user()->forums,
        ]);
    }

	// Update the selected post in edit function
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

    // Delete the selected post
    public function delete(Post $post)
    {
        // Delete post
        $post->delete();

        return redirect()->route('account.user.post.index')->with('success',['درخواست شما با موفقیت انجام شد']);
    }
}
