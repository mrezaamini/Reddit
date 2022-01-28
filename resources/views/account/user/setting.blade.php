@extends('layouts.account.user.main')
@section('content')
	<div class="block">
		<div class="header">
			<div class="title">
				<h6> تنظیمات </h6>
				<p> در این قسمت می توانید اطلاعات کاربری خود را ویرایش کنید </p>
			</div>
		</div>
		<div class="body">
			<form method="post">
				@csrf
				@method('patch')
				<div class="row">
					<div class="col-3">
						<div class="input-mask required" mask-type mask-label="نام">
							<input type="text" name="name" value="{{auth('user')->user()->name}}">
						</div>
					</div>
					<div class="col-3">
						<div class="input-mask required" mask-type mask-label="نام خانوادگی">
							<input type="text" name="surname" value="{{auth('user')->user()->surname}}">
						</div>
					</div>
					<div class="col-4">
						<div class="input-mask required" mask-type mask-label="نام کاربری">
							<input type="text" name="username" value="{{auth('user')->user()->username}}">
						</div>
					</div>
					<div class="col-4">
						<div class="input-mask required" mask-type mask-label="ایمیل">
							<input type="text" name="email" value="{{auth('user')->user()->email}}">
						</div>
					</div>
					<div class="col-4">
						<div class="input-mask" mask-type mask-label="گذرواژه جدید">
							<input type="password" name="password">
						</div>
					</div>
				</div>
				<div class="input-mask button border-top">
					<button> ویرایش </button>
				</div>
			</form>
		</div>
	</div>
@endsection
