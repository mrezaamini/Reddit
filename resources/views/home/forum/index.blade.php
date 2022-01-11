@extends('layouts.home.main')
@section('content')
    <div class="container">
        <div class="row">
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
        </div>
    </div>
@endsection
