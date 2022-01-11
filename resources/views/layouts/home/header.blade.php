<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
{{--    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> انجمن </title>
    <link rel="stylesheet" href="{{asset('assets/construct/bootstrap-12-grid.css?version='.env('APP_VERSION'))}}">
    <link rel="stylesheet" href="{{asset('assets/construct/font/fontiran.css?version='.env('APP_VERSION'))}}">
    <link rel="stylesheet" href="{{asset('assets/construct/fontawesome/css/all.min.css?version='.env('APP_VERSION'))}}">
    <link rel="stylesheet/less" type="text/css" href="{{asset('assets/home/app.less?version='.env('APP_VERSION'))}}">
    @yield('stylesheet')
</head>
<body>

{{--Start header--}}
<header>
    <div class="container">
        <div class="menu">
            <ul>
                <li><a href="#"> انجمن </a></li>
            </ul>
            <form method="post">
                @csrf
                <input type="text" name="keyword" autocomplete="off">
                <button><i class="fal fa-search"></i></button>
            </form>
        </div>
        <div class="account">
            @if(auth('user')->check())
                <a href="/account/user/logout"> خروج </a>
                <a href="/account/user/desk"> حساب کاربری </a>
            @else
                <a href="/account/register"> ثبت نام کنید </a>
                <a href="/account/login"> وارد شوید </a>
            @endif
        </div>
    </div>
</header>
