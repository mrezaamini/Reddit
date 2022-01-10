<?php

namespace App\Http\Controllers\Account\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index()
    {
        return view('account.user.forum.index');
    }

    public function create()
    {
        return view('account.user.forum.create');
    }
}
