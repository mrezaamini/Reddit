@extends('layouts.home.main')
@section('content')
    <div class="container">
        <div class="clearFix">
            <h4> انجمن ها </h4>
            <br><br>
            <div class="row">
                @if($forums)
                    @foreach($forums as $forum)
                        <div class="col-4">
                            <div class="card">
                                <div class="header">
                                    <div class="title">
                                        <h6>{{$forum->title}}</h6>
                                    </div>
                                </div>
                                <div class="body">
                                    <div class="demo">
                                        <p>{{Str::limit(strip_tags($forum->demo),250)}}</p>
                                    </div>
                                </div>
                                <div class="footer">
                                    <a href="/{{$forum->slug}}/information"> ورود به انجمن </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h6> موردی برای نمایش وجود ندارد </h6>
                @endif
            </div>
        </div>
        <br><br>
        <hr>
        <br><br>
        <div class="clearFix">
            <h4> پست ها </h4>
            <br><br>
            <div class="row">
                @if($posts)
                    @foreach($posts as $post)
                        <div class="col-4">
                            <br>
                            <div class="card">
                                <div class="header">
                                    <div class="title">
                                        <h6>{{$post->title}}</h6>
                                    </div>
                                </div>
                                <div class="body">
                                    <div class="demo">
                                        <p>{{Str::limit(strip_tags($post->content),250)}}</p>
                                    </div>
                                </div>
                                <div class="footer">
                                    <a href="/{{$post->forum->slug}}/{{$post->id}}/information"> اطلاعات بیشتر </a>
                                </div>
                            </div>
                            <br>
                        </div>
                    @endforeach
                @else
                    <h6> موردی برای نمایش وجود ندارد </h6>
                @endif
            </div>
        </div>
    </div>
@endsection
