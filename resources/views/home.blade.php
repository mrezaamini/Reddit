<!doctype html>
<html lang="fa">
<head>
    <!--Start site setting-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!--Start title-->
    <title></title>

    <!--Start link-->
    <link rel="stylesheet" href="{{asset('assets/construct/bootstrap-12-grid.css')}}">
    <link rel="stylesheet" href="{{asset('assets/construct/font/fontiran.css')}}">
    <link rel="stylesheet" href="{{asset('assets/construct/fontawesome/css/all.min.css')}}">
    @yield('stylesheet')
    <link rel="stylesheet/less" type="text/css" href="{{asset('assets/home/app.less')}}">
</head>
<body>


<!--Start script-->
<script>
    less={
        env: 'development'
    }
</script>
<script src="{{asset('assets/construct/less.min.js')}}"></script>
<script src="{{asset('assets/construct/jquery.min.js')}}"></script>
@yield('script')
<script src="{{asset('assets/home/script.js')}}"></script>
</body>
</html>