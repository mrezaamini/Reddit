@include('layouts.home.header')
{{--Start content--}}
<div class="content">
    <div class="container">
        @if(session('success'))
            <div class="notice success">
                @foreach(session('success') as $msg)
                    <li>{{$msg}}</li>
                @endforeach
            </div>
        @endif
        @if($errors->all())
            <div class="notice danger">
                @foreach($errors->all() as $msg)
                    <li>{{$msg}}</li>
                @endforeach
            </div>
        @endif
    </div>
    @yield('content')
</div>
@include('layouts.home.footer')
