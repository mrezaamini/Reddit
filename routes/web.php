<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Account;

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
            Route::get('/',[Account\LoginController::class,'index']);
            Route::post('/',[Account\LoginController::class,'login']);
        });

        // Register
        Route::prefix('login')->group(function()
        {
            Route::get('/',[Account\RegisterController::class,'index']);
            Route::post('/',[Account\RegisterController::class,'register']);
        });
    });

    // User
    Route::middleware('auth:user')->prefix('user')->group(function()
    {

    });

});

