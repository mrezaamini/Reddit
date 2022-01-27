<?php

namespace App\Http\Controllers\Account\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeskController extends Controller
{
    public function index()
    {
    	// Return view first user account page
        return view('account.user.index');
    }
}
