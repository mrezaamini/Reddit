@include('layouts.home.header')
{{--Start content--}}
<div class="content">
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
    @yield('content')
</div>
@include('layouts.home.footer')
