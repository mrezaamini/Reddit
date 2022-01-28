<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{Account,Home};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// /
Route::prefix('/')->group(function()
{
    Route::get('/',[Home\Forum\ForumController::class,'index'])->name('home');
    Route::prefix('{home_forum:slug}')->group(function()
    {
        // Bind
        Route::bind('home_forum',function($slug)
        {
            return \App\Models\Forum::where('slug','=',$slug)->firstOrFail();
        });

        // Information
        Route::get('information',[Home\Forum\ForumController::class,'show'])->name('home.forum.show');

        // Posts
        Route::prefix('{home_post}')->group(function()
        {
            // Bind
            Route::bind('home_post',function($id)
            {
                $forum=\Illuminate\Support\Facades\Request::route('home_forum');
                return $forum->posts()->findOrFail($id);
            });

            Route::get('information',[Home\Forum\PostController::class,'show'])->name('home.forum.post.show');
            Route::middleware('auth:user')->group(function()
            {
                Route::get('like',[Home\Forum\PostController::class,'like']);
                Route::get('dislike',[Home\Forum\PostController::class,'dislike']);
                Route::get('save',[Home\Forum\PostController::class,'save']);
                Route::get('report',[Home\Forum\PostController::class,'report']);
                Route::prefix('comment')->group(function()
                {
                    Route::post('/',[Home\Forum\CommentController::class,'store']);

                    Route::bind('post_comment',function($id)
                    {
                        $post=\Illuminate\Support\Facades\Request::route('home_post');
                        return $post->comments()->findOrFail($id);
                    });
                    Route::get('{post_comment}/like',[Home\Forum\CommentController::class,'like']);
                    Route::get('{post_comment}/dislike',[Home\Forum\CommentController::class,'dislike']);
                });
            });
        });

        // Join and leave
        Route::middleware('auth:user')->group(function()
        {
            Route::get('join',[Home\Forum\ForumController::class,'join']);
            Route::get('leave',[Home\Forum\ForumController::class,'leave']);
        });
    });
    Route::get('search',[Home\SearchController::class,'index'])->name('home.search');

    Route::get('dark',function()
    {
    	if(session('dark'))
	    {
		    session(['dark'=>false]);
	    }else{
		    session(['dark'=>true]);
	    }

    	return redirect()->back();
    });
});

// Account
Route::prefix('account')->group(function()
{
    // Guest
    Route::middleware('guest')->group(function()
    {
        // Login
        Route::prefix('login')->group(function()
        {
            Route::get('/',[Account\LoginController::class,'index'])->name('account.login');
            Route::post('/',[Account\LoginController::class,'login']);
        });

        // Register
        Route::prefix('register')->group(function()
        {
            Route::get('/',[Account\RegisterController::class,'index'])->name('account.register');
            Route::post('/',[Account\RegisterController::class,'register']);
        });
    });

    // User
    Route::middleware('auth:user')->prefix('user')->group(function()
    {
        // Logout
        Route::get('logout',[Account\User\LogoutController::class,'logout'])->name('account.user.logout');

        // Desk
        Route::get('desk',[Account\User\DeskController::class,'index'])->name('account.user.desk');

        // Setting
        Route::prefix('setting')->group(function()
        {
        	Route::prefix('profile')->group(function()
	        {
	        	Route::get('/',[Account\User\Setting\ProfileController::class,'index'])->name('account.user.setting.profile');
	        	Route::patch('/',[Account\User\Setting\ProfileController::class,'update']);
	        });
            Route::patch('avatar',[Account\User\Setting\AvatarController::class,'update']);
        });

        // Forum
        Route::prefix('forum')->group(function()
        {
            Route::get('list',[Account\User\ForumController::class,'index'])->name('account.user.forum.index');
            Route::prefix('add')->group(function()
            {
                Route::get('/',[Account\User\ForumController::class,'create'])->name('account.user.forum.create');
                Route::post('/',[Account\User\ForumController::class,'store']);
            });
            Route::prefix('{user_forum}')->group(function()
            {
                Route::bind('user_forum',function($id)
                {
                    $forum=\App\Models\Forum::findOrFail($id);
                    if(
                        auth('user')->user()->isForumAdmin($forum) ||
                        $forum->user->id==auth('user')->id()
                    )
                    {
                        return $forum;
                    }else{
                        return abort(404);
                    }
                });
                Route::prefix('edit')->group(function()
                {
                    Route::get('/',[Account\User\ForumController::class,'edit'])->name('account.user.forum.edit');
                    Route::post('/',[Account\User\ForumController::class,'update']);
                });
                Route::prefix('information')->group(function()
                {
                    Route::get('/',[Account\User\ForumController::class,'show'])->name('account.user.forum.show');
                    Route::get('user/{user}/change-admin',[Account\User\ForumController::class,'changeAdmin']);
                    Route::get('user/{user}/change-block',[Account\User\ForumController::class,'changeBlock']);
                });
            });
        });

        // Post
        Route::prefix('post')->group(function()
        {
            Route::get('list',[Account\User\PostController::class,'index'])->name('account.user.post.index');
            Route::prefix('add')->group(function()
            {
                Route::get('/',[Account\User\PostController::class,'create'])->name('account.user.post.create');
                Route::post('/',[Account\User\PostController::class,'store']);
            });
            Route::prefix('{user_post}')->group(function()
            {
                Route::bind('user_post',function($id)
                {
                    $post=\App\Models\Post::findOrFail($id);
                    if(
                        $post->user->id==auth('user')->id() ||
                        $post->forum->isUserIsAdmin(auth('user')->user()) ||
                        $post->forum->user->id==auth('user')->id()
                    ){
                        return $post;
                    }else{
                        return abort(404);
                    }
                });
                Route::prefix('edit')->group(function()
                {
                    Route::get('/',[Account\User\PostController::class,'edit'])->name('account.user.post.edit');
                    Route::post('/',[Account\User\PostController::class,'update']);
                });
                Route::delete('delete',[Account\User\PostController::class,'delete']);
            });
        });
    });

});

