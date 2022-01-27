<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Forum;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
	// Search in forum title or content and post title or content
	public function index(Request $request)
	{
		return view('home.search',[
			'forums'=>Forum::where('title','like','%'.$request->keyword.'%')->orWhere('demo','like','%'.$request->keyword.'%')->get(),
			'posts'=>Post::where('title','like','%'.$request->keyword.'%')->orWhere('content','like','%'.$request->keyword.'%')->get(),
		]);
	}
}
