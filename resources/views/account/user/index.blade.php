@extends('layouts.account.user.main')
@section('content')
	<div class="block">
		<div class="header">
			<div class="title">
				<h6> پست های ذخیره شده </h6>
				<p> در این قسمت می توانید پست های ذخیره شده را مشاهده کنید </p>
			</div>
		</div>
	</div>
	<br><br>
	@foreach(auth('user')->user()->savedPosts as $post)
		<div class="row">
			<div class="col-6">
				<div class="block">
					<div class="header">
						<h6>{{$post->title}}</h6>
					</div>
					<div class="body">
						<p style="text-align: justify; line-height: 1.8; font-size: 13px; color: #000000aa">{{Str::limit(strip_tags($post->content),250)}}</p>
						<br>
						<a class="btn btn-primary" href="/{{$post->forum->slug}}/{{$post->id}}/information"> اطلاعات بیشتر </a>
					</div>
				</div>
			</div>
		</div>
	@endforeach
@endsection
