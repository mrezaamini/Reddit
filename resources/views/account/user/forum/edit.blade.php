@extends('layouts.account.user.main')
@section('content')
    <form method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="block">
                    <div class="header">
                        <div class="title">
                            <h6> ویرایش انجمن </h6>
                            <p> در این قسمت می توانید انجمن را ویرایش کنید </p>
                        </div>
                        <div class="tool-bar">
                            <ul>
                                <li><a href="/account/user/forum/list"> مدیریت ایجاد شده ها <i class="far fa-angle-left"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="body">
                        <div class="row">
                            <div class="col-9">
                                <div class="input-mask required" mask-type="" mask-label="عنوان">
                                    <input type="text" name="title" autocomplete="off" value="{{old('title') ? old('title') : $forum->title}}">
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="input-mask required" mask-type="" mask-label="عنوان به انگلیسی">
                                    <input type="text" name="english_title" autocomplete="off" value="{{old('english_title') ? old('english_title') : $forum->english_title}}">
                                </div>
                            </div>
                            <div class="col-18">
                                <div class="input-mask required" mask-type="" mask-label="در مورد انجمن (کوتاه)">
                                    <textarea name="demo" rows="5">{{old('demo') ? old('demo') : $forum->demo}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="input-mask button border-top">
                            <button> ویرایش </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="block">
                    <div class="body">
                        <ul class="dropdown">
                            <li class="active">
                                <div class="title">
                                    <p> اطلاعات تکمیلی </p>
                                    <i class="far fa-angle-down"></i>
                                </div>
                                <div class="item">
                                    <div class="input-mask required" mask-type="tag" mask-label="دسته بندی">
                                        <input type="text" name="category[]" value="{{old('category') ? json_encode(old('category')) : $forum->category}}">
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
