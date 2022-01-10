<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
{{--    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> حساب کاربری (پنل مدیریت) </title>
    <link rel="stylesheet" href="{{asset('assets/construct/bootstrap-18-grid.css?version='.env('APP_VERSION'))}}">
    <link rel="stylesheet" href="{{asset('assets/construct/font/fontiran.css?version='.env('APP_VERSION'))}}">
    <link rel="stylesheet" href="{{asset('assets/construct/fontawesome/css/all.min.css?version='.env('APP_VERSION'))}}">
    <link rel="stylesheet/less" type="text/css" href="{{asset('assets/construct/panel/app.less?version='.env('APP_VERSION'))}}">
    @yield('stylesheet')
</head>
<body>

{{--Start header--}}
<header>
    <div class="tool-bar">
        <a href="/account/user/logout" class="logout">
            <i class="far fa-arrow-right-from-bracket"></i>
            <span> خروج </span>
        </a>
    </div>
    <div class="welcome">
        <p> به حساب <span> کاربری </span> خوش آمدید! </p>
    </div>
</header>

<script>
    less={
        env: 'development'
    }
</script>
<script src="{{asset('assets/construct/less.min.js')}}"></script>
<script src="{{asset('assets/construct/jquery.min.js')}}"></script>
@yield('script')
<script src="{{asset('assets/construct/input/input.js')}}"></script>
<script src="{{asset('assets/construct/notice/notice.js')}}"></script>
<script src="{{asset('assets/construct/balloon/balloon.js')}}"></script>
<script src="{{asset('assets/construct/userPanel/script.js')}}"></script>
</body>
</html>
