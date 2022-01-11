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
    Route::get('/',[Home\Forum\ForumController::class,'index']);
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
                    return auth('user')->user()->forums()->findOrFail($id);
                });
                Route::prefix('edit')->group(function()
                {
                    Route::get('/',[Account\User\ForumController::class,'edit'])->name('account.user.forum.edit');
                    Route::post('/',[Account\User\ForumController::class,'update']);
                });
            });
        });
    });

});

