<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>@yield('title') | PolyRM</title>
	<link href="{{ asset('images/favicon/favicon.png') }}" rel="icon">
	<link href="{{ asset('css/adminAll.css') }}" rel="stylesheet">

</head>

<body id="admin">
	<div id="wrapper">
		<nav class="navbar-default navbar-static-side" role="navigation">
			<div class="sidebar-collapse">
				<ul class="nav metismenu" id="side-menu">
					<li class="nav-header">
						<div class="dropdown profile-element text-center"> 
							<span>
                            	<img alt="image" class="img-circle img-responsive" src="{{ asset('upload/'. Auth::user()->avatar) }}" />
                             </span>
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<span class="clear"> <span class="block m-t-xs"> 
									<strong class="font-bold">{{ Auth::user()->fullname }}</strong>
								</span> 
								<span class="text-muted text-xs block">Quản trị viên</span> 
							</a>
						</div>
						<div class="logo-element">
							RM
						</div>
					</li>
					<li @if(Route::currentRouteName() == "Dashboard") class="active" @endif>
						<a href="{{ route('Dashboard') }}"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Thống kê</span></a>
					</li>
					<li @if(Route::currentRouteName() == "ListRentMotel" || Route::currentRouteName() == "ListRentMotelView" || Route::currentRouteName() == "FindPeopleView" || Route::currentRouteName() == "FindPeople") class="active" @endif>
						<a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Quản lý tin đăng</span><span class="fa arrow"></span></a>
						<ul class="nav nav-second-level collapse">
							<li @if(Route::currentRouteName() == "ListRentMotel" || Route::currentRouteName() == "ListRentMotelView") class="active" @endif><a href="{{ route('ListRentMotel') }}">Tin cho thuê phòng trọ</a></li>
							<li @if(Route::currentRouteName() == "FindPeople" || Route::currentRouteName() == "FindPeopleView") class="active" @endif><a href="{{ route('FindPeople') }}">Tin tìm người ở ghép</a></li>
						</ul>
					</li>
					<li @if(Route::currentRouteName() == "PostCreate" || Route::currentRouteName() == "PostList" || Route::currentRouteName() == "PostEdit") class="active"@endif>
						<a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Quản lý bài viết</span><span class="fa arrow"></span></a>
						<ul class="nav nav-second-level collapse">
							<li @if(Route::currentRouteName() == "PostCreate") class="active"@endif><a href="{{ route('PostCreate') }}">Đăng bài viết</a></li>
							<li @if(Route::currentRouteName() == "PostList" || Route::currentRouteName() == "PostEdit") class="active"@endif><a href="{{ Route('PostList') }}">Danh sách bài viết</a></li>
						</ul>
					</li>
					<li @if(Route::currentRouteName() == "Comment") class="active"@endif>
						<a href="{{ route('Comment') }}"><i class="fa fa-comments"></i> <span class="nav-label">Quản lý bình luận</span></a>
					</li>
					<li @if(Route::currentRouteName() == "User" || Route::currentRouteName() == "UserView" || Route::currentRouteName() == "UserCreate") class="active"@endif>
						<a href="#"><i class="fa fa-user"></i> <span class="nav-label">Quản lý người dùng</span><span class="fa arrow"></span></a>
						<ul class="nav nav-second-level collapse">
							<li @if(Route::currentRouteName() == "UserCreate") class="active" @endif><a href="{{ route('UserCreate') }}">Thêm mới</a></li>
							<li @if(Route::currentRouteName() == "User" || Route::currentRouteName() == "UserView") class="active" @endif><a href="{{ route('User') }}">Danh sách người dùng</a></li>
						</ul>
					</li>
				</ul>

			</div>
		</nav>

		<div id="page-wrapper" class="gray-bg">
			<div class="row border-bottom">
				<nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
					<div class="navbar-header">
						<a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
						
					</div>
					<ul class="nav navbar-top-links navbar-right">
						<li>
							<a href="{{ route('Home') }}">
                        		<i class="fa fa-home"></i> Xem website
                    		</a>
						</li>
						<li>
							<a href="{{ route('Logout') }}" id="logout">
                        		<i class="fa fa-sign-out"></i> Đăng xuất
                    		</a>
						</li>
					</ul>
				</nav>
			</div>
			@yield('breadcrumb')
			@yield('content')
			<div class="footer">
				<div class="pull-right">
					Version <strong>1.0.0</strong>
				</div>
				<div>
					<strong>Copyright</strong> PolyRM &copy; 2018
				</div>
			</div>
		</div>

		<!-- Mainly scripts -->
		<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
		<script src="{{ asset('js/plugins.js') }}"></script>
		<script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
		<script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
		<script src="{{ asset('js/inspinia.js') }}"></script>
		<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
		<script src="{{ asset('js/ajax/common.js') }}"></script>
		<script>
			var url = "{{ url('/') }}/";
		</script>
		@yield('script')
</body>

</html>