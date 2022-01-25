@extends('layouts.home.main')
@section('content')
    <div class="container">
        <form action="" method="get" class="no">
            <select name="orderBy">
                <option value="0" {{Request::get('orderBy')=='0' ? 'selected' : ''}}> جدید به قدیم </option>
                <option value="1" {{Request::get('orderBy')=='1' ? 'selected' : ''}}> قدیم به جدید </option>
                <option value="2" {{Request::get('orderBy')=='2' ? 'selected' : ''}}> پر لایک ترین (نزولی) </option>
                <option value="3" {{Request::get('orderBy')=='3' ? 'selected' : ''}}> پر لایک ترین (صعودی) </option>
                <option value="4" {{Request::get('orderBy')=='4' ? 'selected' : ''}}> پر کامنت ترین (نزولی) </option>
                <option value="5" {{Request::get('orderBy')=='5' ? 'selected' : ''}}> پر کامنت ترین (صعودی) </option>
            </select>
        </form>
        <br><br><br>
        <div class="card">
            <div class="header">
                <div class="title">
                    <h6>{{$forum->title}}</h6>
                </div>
                <div class="join">
                    @if(auth('user')->check())
                        @if(auth('user')->user()->forums()->where('id','=',$forum->id)->exists())
                            <span> شما سازنده انجمن هستید </span>
                        @else
                            @if(auth('user')->user()->isJoinedForum($forum))
                                <span> شما عضو این انجمن هستید </span>
                                <a href="/{{$forum->slug}}/leave"> لغو عضویت </a>
                            @else
                                <a href="/{{$forum->slug}}/join"> عضویت در انجمن </a>
                            @endif
                        @endif
                    @else
                        <span> برای عضویت در ابتدا وارد حساب کاربری شوید </span>
                    @endif
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
                        <img src="{{$forum->user->avatar ? Storage::disk('public_media')->url($forum->user->avatar) : asset('assets/construct/media/avatar.svg')}}">
                    </div>
                    <div class="name">
                        <p>{{$forum->user->name.' '.$forum->user->surname}}</p>
                    </div>
                </div>
                <div class="information">
                    <ul>
                        <li class="primary">
                            <span>{{$forum->joinedUsers()->count()+1}} عضو </span>
                        </li>
                        <li class="success">
                            <span>{{$forum->posts()->count()}} پست </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <br><br>
        <div class="row">
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
                            <a href="/{{$forum->slug}}/{{$post->id}}/information"> اطلاعات بیشتر </a>
                        </div>
                    </div>
                    <br>
                </div>
            @endforeach
        </div>
    </div>
@endsection
