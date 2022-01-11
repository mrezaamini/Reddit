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
    public function show(Forum $forum)
    {
        return view('home.forum.show',[
            'forum'=>$forum
        ]);
    }
}
