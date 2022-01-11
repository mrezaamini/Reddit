<?php

namespace App\Http\Controllers\Home\Forum;

use App\Http\Controllers\Controller;
use App\Models\Forum;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Forum $forum)
    {
        dd($forum);
    }
    public function show(Forum $forum)
    {
        dd($forum);
    }
}
