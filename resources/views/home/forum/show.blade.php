@extends('layouts.home.main')
@section('content')
    <div class="container">
        <div class="card">
            <div class="header">
                <div class="title">
                    <h6>{{$forum->title}}</h6>
                </div>
            </div>
            <div class="body">
                <div class="demo">
                    <p>{{$forum->demo}}</p>
                </div>
            </div>
            <div class="footer">
                <div class="profile">
                    <div class="avatar">
                        <img src="{{auth('user')->user()->avatar ? Storage::disk('public_media')->url(auth('user')->user()->avatar) : asset('assets/construct/media/avatar.svg')}}">
                    </div>
                    <div class="name">
                        <p>{{$forum->user->name.' '.$forum->user->surname}}</p>
                    </div>
                </div>
                <div class="information">
                    <ul>
                        <li class="primary">
                            <span> ۱۱۶ عضو </span>
                        </li>
                        <li class="success">
                            <span> ۲۶ پست </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
