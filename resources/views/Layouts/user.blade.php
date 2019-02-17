<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="author" content="To Tan Vi" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="Website thuê phòng trọ dành cho sinh viên FPoly">
	<link href="{{ asset('images/favicon/favicon.png') }}" rel="icon">
	<link href="{{ asset('css/all.css') }}" rel="stylesheet">
	<!--[if lt IE 9]>
      <script src="{{ asset('js/html5shiv.js') }}"></script>
      <script src="{{ asset('respond.min.js') }}"></script>
    <![endif]-->
	<title>@yield('title') - PolyRM</title>
</head>

<body>
	<div id="wrapper" class="wrapper clearfix">
		<header id="navbar-spy" class="header header-1 header-light header-fixed">
			<nav id="primary-menu" class="navbar navbar-fixed-top">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="logo" href="{{ route('Home') }}">
							<img class="logo-light" src="{{ asset('images/logo/logo-light.png') }}" alt="Land Logo">
							<img class="logo-dark" src="{{ asset('images/logo/logo-dark.png') }}" alt="Land Logo">
						</a>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse pull-right" id="navbar-collapse-1">
						<ul class="nav navbar-nav nav-pos-center navbar-left">
							{{--  <li class="has-dropdown active">
								<a href="#" data-toggle="dropdown" class="dropdown-toggle menu-item">Thuê phòng trọ</a>
								<ul class="dropdown-menu">
									<li>
										<a href="index.html">home search</a>
									</li>
									<li>
										<a href="home-map.html">home map</a>
									</li>
									<li>
										<a href="home-property.html">home property</a>
									</li>
									<li>
										<a href="home-splash.html">home splash</a>
									</li>
								</ul>
							</li>  --}}
							@php
								$menu = App\Menu::Menu();
							@endphp
							@foreach ($menu as $menus)
							<li @if($menus->title == 'Phòng trọ gần trường') class="has-dropdown" @endif>
								@if(!$menus->menu_parent_id)
								<a href="/{{ $menus->url }}" >{{ $menus->title }}</a>
								@endif
								@if($menus->title == 'Phòng trọ gần trường')
								<ul class="dropdown-menu">
									<li>
										<a href="{{ url('/') }}/rentmotel/search?city=Thành+phố+Hồ+Chí+Minh&district=Quận+3">Quận 3</a>
									</li>
									<li>
										<a href="{{ url('/') }}/rentmotel/search?city=Thành+phố+Hồ+Chí+Minh&district=Quận+Bình+Thạnh">Quận Bình Thạnh</a>
									</li>
									<li>
										<a href="{{ url('/') }}/rentmotel/search?city=Thành+phố+Hồ+Chí+Minh&district=Quận+1">Quận 1</a>
									</li>
								</ul>
								@endif
							</li>
							@endforeach
						</ul>
						<!-- Module Signup  -->
						@if(Auth::check())
						<div class="module module-login pull-left user-dropdown">
							<ul class="nav navbar-nav">
								<li class="has-dropdown">
									<a href="#" data-toggle="dropdown" class="dropdown-toggle menu-item avatar">
										<img src="{{ asset('upload/'. Auth::user()->avatar) }}" class="output--img img-circle">
									</a>
									<ul class="dropdown-menu">
										<li>
											<a href="{{ route('Profile') }}" class="text-center text-bold fullname">{{ Auth::user()->fullname }}</a>
										</li>
										@if(Auth::user()->role == 10)
										<li>
											<a href="{{ route('Dashboard') }}">Trang quản trị</a>
										</li>
										@endif
										<li>
											<a href="{{ route('Profile') }}">Thông tin cá nhân</a>
										</li>
										<li>
											<a href="#" id="logout">Đăng xuất</a>
										</li>
									</ul>
								</li>
							</ul>
						</div>
						<div class="module module-property pull-left">
							<a href="{{ route('AddProperty') }}" class="btn">
								<i class="fa fa-plus"></i> Đăng tin
							</a>
						</div>
						@else
						<div class="module module-login pull-left">
							<a class="btn-popup" data-toggle="modal" data-target="#signupModule">Đăng nhập</a>
							<div class="modal register-login-modal fade" tabindex="-1" role="dialog" id="signupModule">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-body">
											<div class="row">
												<ul class="nav nav-tabs">
													<li class="active">
														<a href="#login" data-toggle="tab">Đăng nhập</a>
													</li>
													<li>
														<a href="#signup" data-toggle="tab">Đăng ký</a>
													</li>
												</ul>
												<div class="tab-content">
													<div class="tab-pane fade in active" id="login">
														<div class="signup-form-container text-center">
															<form class="mb-0">
																{{ csrf_field() }}
																<a href="#" class="btn btn--facebook btn--block">
																	<i class="fa fa-facebook-square"></i>Đăng nhập bằng Facebook</a>
																<div class="or-text">
																	<span>hoặc</span>
																</div>
																
																<div class="form-group">
																	<p style="color:red;" class="small error text-center"></p>
																	<span style="color:red;" class="small username-error"></span>
																	<input type="text" class="form-control" name="login_username" id="login_username" placeholder="Tên đăng nhập" required>
																</div>
																<div class="form-group">
																	<span style="color:red;" class="small password-error"></span>
																	<input type="password" class="form-control" name="login_password" id="login_password" placeholder="Mật khẩu">
																</div>
																{{--  <div class="input-checkbox">
																	<label class="label-checkbox">
																		<span>Remember Me</span>
																		<input type="checkbox">
																		<span class="check-indicator"></span>
																	</label>
																</div>  --}}
																<input type="submit" class="btn btn--primary btn--block" value="Đăng nhập" id="btn-login">
																<a href="#" class="forget-password">Quên mật khẩu?</a>
															</form>
														</div>
													</div>
													<div class="tab-pane" id="signup">
														<form class="mb-0">
															{{ csrf_field() }}
															<a href="#" class="btn btn--facebook btn--block">
																<i class="fa fa-facebook-square"></i>Đăng ký qua Facebook</a>
															<div class="or-text">
																<span>hoặc</span>
															</div>
															<div class="form-group">
																<input type="text" class="form-control" name="fullname" id="fullname" placeholder="Họ và tên" required>
																<span style="color:red" class="small fullname-error"></span>
															</div>
															<div class="form-group">
																<input type="email" class="form-control" name="email" id="email" placeholder="Địa chỉ Email" required>
																<span style="color:red" class="small email-error"></span>
															</div>
															<div class="form-group">
																<input type="text" class="form-control" name="register_username" id="register_username" placeholder="Tên đăng nhập" required>
																<span style="color:red" class="small register_username-error"></span>
															</div>
															<div class="form-group">
																<input type="password" class="form-control" name="register_password" id="register_password" placeholder="Mật khẩu" required>
																<span style="color:red" class="small register_password-error"></span>
															</div>
															<div class="form-group">
																<input type="password" class="form-control" name="register_password_confirmation" id="register_password_confirmation" placeholder="Xác nhận mật khẩu" required>
															</div>
															<div class="form-group">
																<input type="text" class="form-control" name="phone" id="phone" placeholder="Số điện thoại" required>
																<span style="color:red" class="small phone-error"></span>
															</div>
															<div class="form-group">
																<select class="form-control" id="userType">
																	<option value="" disabled selected>Bạn là
																	<option value="0">Tìm người ở ghép
																	<option value="1">Chủ phòng trọ
																</select>
																<span style="color:red" class="small userType"></span>
															</div>
															{{--  <div class="input-checkbox">
																<label class="label-checkbox">
																	<span>Tôi đồng ý với tất cả các
																		<a href="#">Điều khoản & Điều kiện</a>
																	</span>
																	<input type="checkbox" name="checkbox" required>
																	<span style="color:red" class="small checkbox-error"></span>
																	<span class="check-indicator"></span>
																</label>
															</div>  --}}
															<input type="submit" class="btn btn--primary btn--block" value="Đăng ký" id='btn-register'>
														</form>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						@endif
						
					</div>
				</div>
			</nav>
		</header>
		@yield('content')
		<footer id="footer" class="footer footer-1 bg-white">
			<div class="footer-widget">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-3 widget--about">
							<div class="widget--content">
								<div class="footer--logo">
									<img src="{{ asset('images/logo/logo-dark2.png') }}" alt="logo">
								</div>
								<p>391A Nam Kỳ Khởi Nghĩa, Quận 3, TP. Hồ Chí Minh</p>
								<div class="footer--contact">
									<ul class="list-unstyled mb-0">
										<li>0968 028 467</li>
										<li>
											<a href="mailto:contact@land.com">totanvix@gmail.com</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<!-- .col-md-2 end -->
						<div class="col-xs-12 col-sm-3 col-md-2 col-md-offset-1 widget--links">
							<div class="widget--title">
								<h5>Về PolyRM</h5>
							</div>
							<div class="widget--content">
								<ul class="list-unstyled mb-0">
									<li>
										<a href="#">Giới thiệu</a>
									</li>
									<li>
										<a href="#">Cho thuê phòng trọ</a>
									</li>
									<li>
										<a href="#">Tìm người ở ghép</a>
									</li>
									<li>
										<a href="#">Liên hệ</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="col-xs-12 col-sm-3 col-md-2 widget--links">
							<div class="widget--title">
								<h5>Thông tin</h5>
							</div>
							<div class="widget--content">
								<ul class="list-unstyled mb-0">
									<li>
										<a href="#">Chính sách</a>
									</li>
									<li>
										<a href="#">Điều khoản và điều kiện</a>
									</li>
									<li>
										<a href="#">FAQ</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-4 widget--newsletter">
							<div class="widget--title">
								<h5>Nhận tin đăng mới</h5>
							</div>
							<div class="widget--content">
								<form class="newsletter--form mb-40">
									<input type="email" class="form-control" id="newsletter-email" placeholder="Địa chỉ email">
									<button type="submit">
										<i class="fa fa-arrow-right"></i>
									</button>
								</form>
								<h6>Mạng xã hội</h6>
								<div class="social-icons">
									<a href="#">
										<i class="fa fa-twitter"></i>
									</a>
									<a href="#">
										<i class="fa fa-facebook"></i>
									</a>
									<a href="#">
										<i class="fa fa-vimeo"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="footer--copyright text-center">
				<div class="container">
					<div class="row footer--bar">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<span>© 2018
								<a href="#">PolyRM</a>, All Rights Reserved.</span>
						</div>
					</div>
				</div>
			</div>
		</footer>
	</div>
	<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
	<script src="{{ asset('js/plugins.js') }}"></script>
	<script src="{{ asset('js/functions.js') }}"></script>
	<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
	<script>
		var url = "{{ url('/') }}/";
	</script>
	@yield('scripts')
</body>

</html>