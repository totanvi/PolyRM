@extends('Layouts.User') 
@section('title', 'Thông tin cá nhân') 
@section('content')
<section id="user-profile" class="user-profile">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-4">
					<div class="edit--profile-area">
						<ul class="edit--profile-links list-unstyled mb-0">
							<li><a href="{{ route('Profile') }}" class="active">Thông tin cá nhân</a></li>
							<li><a href="{{ route('ProfileList') }}">Các tin đã đăng</a></li>
							<li><a href="{{ route('AddProperty') }}">Đăng tin</a></li>
						</ul>
					</div>
				</div>
				<!-- .col-md-4 -->
				<div class="col-xs-12 col-sm-12 col-md-8">
					<form class="mb-0">
						<input type="hidden" name="_token" value="{{ csrf_token() }}" >
						<div class="form-box">
							<h4 class="form--title">Ảnh đại diện</h4>
							<div class="upload--img-area">
								<div class="preview--img">
									<img src="{{ asset('upload/'. Auth::user()->avatar) }}" id="output--img" class="output--img">
								</div>
								<a class="btn btn--primary btn-file ml-30">Tải ảnh lên
									<input type="file" hidden="">
									<input type="file" accept="image/*" id="image" onchange="loadFile(event)"> 
								</a>
								{{--  <a href="#" class="btn delete--img"><i class="fa fa-times"></i>Xóa</a>  --}}
							</div>
						</div>
						<div class="form-box">
							<h4 class="form--title">Thông tin</h4>
							<div class="form-group">
								<label for="fullname">Họ và tên</label> <span class="error fullname-error"></span>
								<input type="text" class="form-control" name="fullname" id="fullname" value="{{ Auth::user()->fullname }}">
							</div>
							<!-- .form-group end -->
							<div class="form-group">
								<label for="email">Email</label> <span class="error email-error"></span>
								<input type="email" readonly class="form-control" name="email" id="email" value="{{ Auth::user()->email }}">
							</div>
							<!-- .form-group end -->
							<div class="form-group">
								<label for="phone">Số điện thoại</label> <span class="error phone-error"></span>
								<input type="text" class="form-control" name="phone" id="phone" value="{{ Auth::user()->phone }}">
							</div>
							{{--  <!-- .form-group end -->
							<div class="form-group">
								<label for="phone-number">Phone</label>
								<input type="text" class="form-control" name="phone-number" id="phone-number">
							</div>
							<!-- .form-group end -->
							<div class="form-group">
								<label for="about-me">About Me</label>
								<textarea class="form-control" name="about-me" id="about-me" rows="2"></textarea>
							</div>
							<!-- .form-group end -->  --}}
						</div>
						<!-- .form-box end -->
						<div class="form-box">
							<h4 class="form--title">Đổi mật khẩu</h4>
							<div class="form-group">
								<label for="password">Mật khẩu mới</label> <span class="error password-error"></span>
								<input type="password" class="form-control" name="password" id="password">
							</div>
							<!-- .form-group end -->
							<div class="form-group">
								<label for="password_confirmation">Xác nhận mật khẩu</label>
								<input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
							</div>
							<!-- .form-group end -->
						</div>
						<!-- .form-box end -->
						<input type="submit" value="Lưu" name="submit" class="btn btn--primary save">
					</form>
				</div>
				<!-- .col-md-8 end -->
			</div>
			<!-- .row end -->
		</div>
	</section>
@endsection
@section('scripts')
<script src="{{ asset('js/jquery.fileuploader.min.js') }}"></script>
<script src="{{ asset('js/ajax/Common.js') }}"></script>
<script src="{{ asset('js/ajax/Profile.js') }}"></script>
@endsection