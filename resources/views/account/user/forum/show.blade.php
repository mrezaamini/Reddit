@extends('layouts.account.user.main')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="block">
                <div class="header">
                    <div class="title">
                        <h6> پست های ایجاد شده </h6>
                        <p> در این قسمت می توانید پست های ایجاد شده را مدیریت کنید </p>
                    </div>
                </div>
                <div class="body">
                    <div class="table-mask">
                        <table>
                            <thead>
                            <tr>
                                <th> ردیف </th>
                                <th> عنوان </th>
                                <th> لایک </th>
                                <th> دیس لایک </th>
                                <th> تاریخ ثبت </th>
                                <th> آخرین ویرایش </th>
                                <th> گزینه ها </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($forum->posts as $post)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td><a href="/{{$post->forum->slug}}/{{$post->id}}/information">{{$post->title}}</a></td>
                                    <td><span class="label label-success bg-reverse">{{$post->usersLike()->count()}}</span></td>
                                    <td><span class="label label-danger bg-reverse">{{$post->usersDislike()->count()}}</span></td>
                                    <td><span class="label label-default">{{verta($post->created_at)->format('d %B Y')}}</span></td>
                                    <td><span class="label label-default">{{verta($post->updated_at)->format('d %B Y')}}</span></td>
                                    <td>
                                        <ul class="menu">
                                            <li class="balloon" balloon-position="right" balloon-text="ویرایش"><a href="/account/user/post/{{$post->id}}/edit"><i class="far fa-cog"></i></a></li>
                                            <li class="balloon" balloon-position="right" balloon-text="حذف">
                                                <form class="delete" method="post" action="/account/user/post/{{$post->id}}/delete" no-disabled>
                                                    @csrf
                                                    @method('delete')
                                                    <button><i class="far fa-trash-alt"></i></button>
                                                </form>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="block">
                <div class="header">
                    <div class="title">
                        <h6> کاربران عضو شده </h6>
                        <p> در این قسمت می توانید کاربران عضو شده را مدیریت کنید </p>
                    </div>
                </div>
                <div class="body">
                    <div class="table-mask">
                        <table>
                            <thead>
                            <tr>
                                <th></th>
                                <th> نام و نام خانوادگی </th>
                                @if($forum->user->id==auth('user')->id())
                                    <th> گزینه ها </th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($forum->joinedUsers as $user)
                                <tr>
                                    <td class="avatar"><img src="{{$user->avatar ? Storage::disk('public_media')->url($user->avatar) : asset('assets/construct/media/avatar.svg')}}"></td>
                                    <td>{{$user->name.' '.$user->surname}}</td>
                                    @if($forum->user->id==auth('user')->id())
                                        <td>
                                            <ul class="menu">
                                                @if($user->isForumAdmin($forum))
                                                    <li class="balloon" balloon-position="right" balloon-text="گرفتن مجوز ادمین">
                                                        <a href="/account/user/forum/{{$forum->id}}/information/user/{{$user->id}}/change-admin"><i class="far fa-times"></i></a>
                                                    </li>
                                                @else
                                                    <li class="balloon" balloon-position="right" balloon-text="دادن مجوز ادمین">
                                                        <a href="/account/user/forum/{{$forum->id}}/information/user/{{$user->id}}/change-admin"><i class="far fa-check"></i></a>
                                                    </li>
                                                @endif
                                                @if($user->isForumBlock($forum))
                                                    <li class="balloon" balloon-position="right" balloon-text="فعال سازی (آنبلاک)">
                                                        <a href="/account/user/forum/{{$forum->id}}/information/user/{{$user->id}}/change-block"><i class="far fa-lock-open"></i></a>
                                                    </li>
                                                @else
                                                    <li class="balloon" balloon-position="right" balloon-text="غیر فعال سازی (بلاک)">
                                                        <a href="/account/user/forum/{{$forum->id}}/information/user/{{$user->id}}/change-block"><i class="far fa-lock"></i></a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
