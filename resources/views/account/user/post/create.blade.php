@extends('layouts.account.user.main')
@section('content')
    <form method="post" enctype="multipart/form-data">
        @csrf
        <div class="block">
            <div class="header">
                <div class="title">
                    <h6> ایجاد پست جدید </h6>
                    <p> در این قسمت می توانید پست جدید ایجاد کنید </p>
                </div>
                <div class="tool-bar">
                    <ul>
                        <li><a href="/account/user/post/list"> مدیریت ایجاد شده ها <i class="far fa-angle-left"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="body">
                <div class="row">
                    <div class="col-12">
                        <div class="input-mask required" mask-type="" mask-label="عنوان">
                            <input type="text" name="title" autocomplete="off" value="{{old('title')}}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-mask required" mask-type="select:search" mask-label="انتخاب انجمن">
                            <select name="forum_id">
                                @foreach($joinedForums as $forum)
                                    <option value="{{$forum->id}}" tool-bar="عضو" {{old('forum_id')==$forum->id ? 'selected' : ''}}>{{$forum->title}}</option>
                                @endforeach
                                @foreach($ownedForums as $forum)
                                    <option value="{{$forum->id}}" tool-bar="مدیر" {{old('forum_id')==$forum->id ? 'selected' : ''}}>{{$forum->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-18">
                        <div class="input-mask required" mask-type="" mask-label="در مورد انجمن (کوتاه)">
                            <textarea name="post_content" id="content" rows="5">{{old('post_content')}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="input-mask button border-top">
                    <button> ایجاد </button>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('script')
    <script src="{{asset('assets/construct/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('assets/account/user/post/script.js')}}"></script>
@endsection
