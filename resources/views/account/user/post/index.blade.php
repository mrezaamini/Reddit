@extends('layouts.account.user.main')
@section('content')
    <div class="block">
        <div class="header">
            <div class="title">
                <h6> پست های ایجاد شده (توسط شما) </h6>
                <p> در این قسمت می توانید پست های ایجاد شده را مدیریت کنید </p>
            </div>
            <div class="tool-bar">
                <ul>
                    <li><a href="/account/user/post/add"> ایجاد پست جدید <i class="far fa-angle-left"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="body">
            <div class="table-mask">
                <table>
                    <thead>
                    <tr>
                        <th> ردیف </th>
                        <th> عنوان انجمن </th>
                        <th> عنوان </th>
                        <th> تعداد ریپورت </th>
                        <th> لایک </th>
                        <th> دیس لایک </th>
                        <th> تاریخ ثبت </th>
                        <th> آخرین ویرایش </th>
                        <th> گزینه ها </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($myPosts as $post)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td><a href="/{{$post->forum->slug}}/information">{{$post->forum->title}}</a></td>
                            <td><a href="/{{$post->forum->slug}}/{{$post->id}}/information">{{$post->title}}</a></td>
                            <td><span class="label label-primary bg-reverse">{{$post->usersReport()->count()}}</span></td>
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
    <div class="block margin-top">
        <div class="header">
            <div class="title">
                <h6> پست های ایجاد شده در انجمن شما </h6>
                <p> در این قسمت می توانید پست های ایجاد شده در انجمن خود را مدیریت کنید </p>
            </div>
        </div>
        <div class="body">
            <div class="table-mask">
                <table>
                    <thead>
                    <tr>
                        <th> ردیف </th>
                        <th> عنوان انجمن </th>
                        <th></th>
                        <th> ثبت کننده </th>
                        <th> عنوان </th>
                        <th> تعداد ریپورت </th>
                        <th> لایک </th>
                        <th> دیس لایک </th>
                        <th> تاریخ ثبت </th>
                        <th> آخرین ویرایش </th>
                        <th> گزینه ها </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($forumsPosts as $post)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td><a href="/{{$post->forum->slug}}/information">{{$post->forum->title}}</a></td>
                            <td class="avatar"><img src="{{$post->user->avatar ? Storage::disk('public_media')->url($post->user->avatar) : asset('assets/construct/media/avatar.svg')}}"></td>
                            <td>{{$post->user->name.' '.$post->user->surname}}</td>
                            <td><a href="/{{$post->forum->slug}}/{{$post->id}}/information">{{$post->title}}</a></td>
                            <td><span class="label label-primary bg-reverse">{{$post->usersReport()->count()}}</span></td>
                            <td><span class="label label-success bg-reverse">{{$post->usersLike()->count()}}</span></td>
                            <td><span class="label label-danger bg-reverse">{{$post->usersDislike()->count()}}</span></td>
                            <td><span class="label label-default">{{verta($post->created_at)->format('d %B Y')}}</span></td>
                            <td><span class="label label-default">{{verta($post->updated_at)->format('d %B Y')}}</span></td>
                            <td>
                                <ul class="menu">
                                    <li class="balloon" balloon-position="right" balloon-text="ویرایش"><a href="/account/user/post/{{$post->id}}/edit"><i class="far fa-cog"></i></a></li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
