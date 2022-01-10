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
                <a href="/account/login"> قبلا حساب کاربری ساخته اید؟ وارد شوید </a>
                <div class="item">
                    <div class="input">
                        <input type="text" autocomplete="off" name="name" placeholder="نام" value="{{old('name')}}">
                    </div>
                    <div class="input">
                        <input type="text" autocomplete="off" name="surname" placeholder="نام خانوادگی" value="{{old('surname')}}">
                    </div>
                </div>
                <div class="item">
                    <div class="input">
                        <input type="text" autocomplete="off" name="username" placeholder="نام کاربری" value="{{old('username')}}">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="input">
                        <input type="password" autocomplete="off" name="password" placeholder="گذرواژه">
                        <i class="far fa-lock-alt"></i>
                    </div>
                </div>
                <div class="item">
                    <div class="input">
                        <input type="text" autocomplete="off" name="email" placeholder="ایمیل" value="{{old('email')}}">
                        <i class="far fa-mail-bulk"></i>
                    </div>
                </div>
                <div class="footer">
                    <div class="input-mask no-mask-margin">
                        <a href="/"> بازگشت به <span> انجمن </span><i class="fas fa-chevron-left"></i></a>
                        <button> ایجاد حساب </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
