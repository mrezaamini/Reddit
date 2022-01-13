@extends('layouts.home.main')
@section('content')
    <div class="container">
        <div class="card">
            <div class="header">
                <div class="title">
                    <h6>{{$post->title}}</h6>
                </div>
            </div>
            <div class="body">
                <div class="demo">
                    <div class="ckeditor-content">{!! $post->content !!}</div>
                </div>
            </div>
            <div class="footer">
                <div class="profile">
                    <div class="avatar">
                        <img src="{{$post->user->avatar ? Storage::disk('public_media')->url($post->user->avatar) : asset('assets/construct/media/avatar.svg')}}">
                    </div>
                    <div class="name">
                        <p>{{$forum->user->name.' '.$forum->user->surname}}</p>
                    </div>
                </div>
                <div class="information">
                    <ul>
                        <li class="primary">
                            <span> ۰ کامنت </span>
                        </li>
                        <li class="success">
                            <span>{{$post->usersLike()->count()}} لایک </span>
                        </li>
                        <li class="danger">
                            <span>{{$post->usersDislike()->count()}} دیسلایک </span>
                        </li>
                        <li class="primary">
                            <span> تاریخ انتشار: {{verta($post->created_at)->format('d %B Y')}} </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @if(auth('user')->check())
            <div class="like">
                @if($post->isUserLike(auth('user')->user()))
                    <a href="/{{$forum->slug}}/{{$post->id}}/like"><i class="fas fa-heart"></i></a>
                @else
                    <a href="/{{$forum->slug}}/{{$post->id}}/like"><i class="far fa-heart"></i></a>
                @endif
                @if($post->isUserDislike(auth('user')->user()))
                    <a href="/{{$forum->slug}}/{{$post->id}}/dislike"><i class="fas fa-heart-broken"></i></a>
                @else
                    <a href="/{{$forum->slug}}/{{$post->id}}/dislike"><i class="far fa-heart-broken"></i></a>
                @endif
            </div>
        @else
            <div class="like disabled">
                <a href="#"><i class="far fa-heart"></i></a>
                <a href="#"><i class="far fa-heart-broken"></i></a>
            </div>
        @endif
    </div>
@endsection
