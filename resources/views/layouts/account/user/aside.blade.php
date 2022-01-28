{{--Start aside--}}
<aside>
    <div class="header">
        <div class="title">
            <h6> حساب کاربری </h6>
        </div>
        <div class="tool-bar">
            <a href="/account/user/setting/profile"><i class="fal fa-cog"></i></a>
        </div>
    </div>
    <div class="profile">
        <div class="avatar">
            <img src="{{auth('user')->user()->avatar ? Storage::disk('public_media')->url(auth('user')->user()->avatar) : asset('assets/construct/media/avatar.svg')}}" alt="">
            <div class="change-avatar">
                <div class="icon">
                    <i class="far fa-camera"></i>
                </div>
                <form action="/account/user/setting/avatar" method="post" id="change-avatar" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <input type="file" name="avatar">
                </form>
            </div>
        </div>
        <div class="information">
            <p>{{auth('user')->user()->name.' '.auth('user')->user()->surname}}</p>
            <span> کاربر عادی </span>
        </div>
    </div>
    <div class="menu">
        <ul>
            <li>
                <a href="/" target="_blank">
                    <i class="fal fa-home-blank"></i>
                    <p> انجمن </p>
                </a>
            </li>
            <li>
                <a href="/account/user/desk">
                    <i class="fal fa-grid-2"></i>
                    <p> میز کار </p>
                </a>
            </li>
        </ul>
        <div class="title">
            <p> امور مربوط به انجمن </p>
            <span> مدیریت انجمن ها، پست های ایجاد شده و ... </span>
        </div>
        <ul>
            <li>
                <div class="dropdown">
                    <div class="text">
                        <i class="fal fa-screen-users"></i>
                        <p> انجمن </p>
                    </div>
                    <div class="item">
                        <a href="/account/user/forum/add"> ایجاد </a>
                        <a href="/account/user/forum/list"> مدیریت </a>
                    </div>
                </div>
            </li>
            <li>
                <div class="dropdown">
                    <div class="text">
                        <i class="fal fa-file-alt"></i>
                        <p> پست </p>
                    </div>
                    <div class="item">
                        <a href="/account/user/post/add"> ایجاد </a>
                        <a href="/account/user/post/list"> مدیریت </a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</aside>
