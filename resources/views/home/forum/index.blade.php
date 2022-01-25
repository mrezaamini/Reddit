@extends('layouts.home.main')
@section('content')
    <div class="container">
        <div class="clearFix">
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
        <br><br><br>
        <hr>
        <br><br><br>
        <h6> داغترین انجمن های روز </h6>
        <br><br><br>
        <div class="clearFix">
            <div class="row">
                @foreach($hotForums as $forum)
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
    </div>
@endsection
