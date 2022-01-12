@extends('layouts.account.user.main')
@section('content')
    <div class="block">
        <div class="header">
            <div class="title">
                <h6> انجمن های من </h6>
                <p> در این قسمت می توانید انجمن های ایجاد شده خود را مدیریت کنید </p>
            </div>
            <div class="tool-bar">
                <ul>
                    <li><a href="/account/user/forum/add"> ایجاد انجمن جدید <i class="far fa-angle-left"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="body">
            <div class="table-mask">
                <table>
                    <thead>
                    <tr>
                        <th> ردیف </th>
                        <th> عنوان </th>
                        <th> دسته بندی ها </th>
                        <th> نفرات عضو شده </th>
                        <th> پست ها </th>
                        <th> تاریخ ثبت </th>
                        <th> آخرین ویرایش </th>
                        <th> گزینه ها </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ownedForums as $forum)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td><a href="/{{$forum->slug}}">{{$forum->title}}</a></td>
                            <td><span class="label label-primary bg-reverse">{{count(json_decode($forum->category))}}</span></td>
                            <td><span class="label label-success bg-reverse">{{$forum->joinedUsers()->count()+1}}</span></td>
                            <td><span class="label label-warning bg-reverse">{{$forum->posts()->count()}}</span></td>
                            <td><span class="label label-default">{{verta($forum->created_at)->format('d %B Y')}}</span></td>
                            <td><span class="label label-default">{{verta($forum->updated_at)->format('d %B Y')}}</span></td>
                            <td>
                                <ul class="menu">
                                    <li class="balloon" balloon-position="right" balloon-text="مشخصات"><a href="/account/user/forum/{{$forum->id}}/information"><i class="far fa-file-invoice"></i></a></li>
                                    <li class="balloon" balloon-position="right" balloon-text="ویرایش"><a href="/account/user/forum/{{$forum->id}}/edit"><i class="far fa-cog"></i></a></li>
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
                <h6> انجمن های ادمین </h6>
                <p> در این قسمت می توانید انجمن هایی که در آن ادمین شدید را مدیریت کنید </p>
            </div>
        </div>
        <div class="body">
            <div class="table-mask">
                <table>
                    <thead>
                    <tr>
                        <th> ردیف </th>
                        <th> عنوان </th>
                        <th> دسته بندی ها </th>
                        <th> نفرات عضو شده </th>
                        <th> پست ها </th>
                        <th> تاریخ ثبت </th>
                        <th> آخرین ویرایش </th>
                        <th> گزینه ها </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($forumsAdmin as $forum)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td><a href="/{{$forum->slug}}">{{$forum->title}}</a></td>
                            <td><span class="label label-primary bg-reverse">{{count(json_decode($forum->category))}}</span></td>
                            <td><span class="label label-success bg-reverse">{{$forum->joinedUsers()->count()+1}}</span></td>
                            <td><span class="label label-warning bg-reverse">{{$forum->posts()->count()}}</span></td>
                            <td><span class="label label-default">{{verta($forum->created_at)->format('d %B Y')}}</span></td>
                            <td><span class="label label-default">{{verta($forum->updated_at)->format('d %B Y')}}</span></td>
                            <td>
                                <ul class="menu">
                                    <li class="balloon" balloon-position="right" balloon-text="مشخصات"><a href="/account/user/forum/{{$forum->id}}/information"><i class="far fa-file-invoice"></i></a></li>
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
