@extends('layouts.login.main')
@section('content')
    <div class="login">
        <div class="content">
            <div class="text">
                <h6> ورود کاربران </h6>
                <p> برای استفاده از خدمات انجمن ابتدا وارد شوید </p>
            </div>
            @if($errors->all())
                <div class="notice danger">
                    @foreach($errors->all() as $msg)
                        <li>{{$msg}}</li>
                    @endforeach
                </div>
            @endif
            <form method="post">
                @csrf
                <a href="/account/register"> هنوز ثبت نام نکرده اید؟ ثبت نام کنید </a>
                <div class="item">
                    <div class="input">
                        <input type="text" autocomplete="off" name="username" placeholder="نام کاربری">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="input">
                        <input type="password" autocomplete="off" name="password" placeholder="گذرواژه">
                        <i class="far fa-eye show-password"></i>
                    </div>
                </div>
                <div class="input-mask" mask-type="checkbox">
                    <input type="checkbox" name="remember_me" label="مرا به خاطر بسپار" value="1">
                </div>
                <div class="footer">
                    <div class="input-mask no-mask-margin">
                        <a href="/"> بازگشت به <span> انجمن </span><i class="fas fa-chevron-left"></i></a>
                        <button> ورود به حساب </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
