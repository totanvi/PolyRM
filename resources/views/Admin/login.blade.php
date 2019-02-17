<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Đăng nhập quản trị - PolyRM</title>

	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('fonts/font-awesome.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
	<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
</head>

<body class="gray-bg">

	<div class="loginColumns animated fadeInDown">
		<div class="row">

			<div class="col-md-6">
				<h2 class="font-bold">PolyRM</h2>
				<p>PolyRM là website giúp các sinh viên của trường FPT Polytechnic tìm phòng trọ và tìm người ở ghép một cách nhanh chóng.</p>
				<p>Bạn là chủ phòng trọ bạn có thể đăng ký trở thành thành viên của PolyRM, lúc đó bạn có thể đăng tin về phòng trọ mà bạn muốn cho thuê.</p>
				<p>Bạn là sinh viên và muốn tìm người ở ghép với bạn thì bạn cũng có thể tham gia website, PolyRM hỗ trợ mục tìm người ở ghép dành cho bạn</p>

			</div>
			<div class="col-md-6">
				<div class="ibox-content" id="login">
					<form class="m-t" role="form" action="index.html">
						{{ csrf_field() }}
						<div class="form-group"> <span class="username-error" style="color:red;"></span>
							<input type="email" class="form-control" placeholder="Tên đăng nhập" name="username">
						</div>
						<div class="form-group"> <span class="password-error" style="color:red;"></span>
							<input type="password" class="form-control" placeholder="Mật khẩu" name="password">
						</div>
						
						<button type="submit" class="btn btn-primary block full-width m-b" id="loginAction">Đăng nhập</button>

						<a href="#">
                            <small>Quên mật khẩu?</small>
                        </a>

						<p class="text-muted text-center">
							<small>Tìm phòng trọ một cách nhanh chóng</small>
						</p>
						<a class="btn btn-sm btn-white btn-block" href="register.html">Tìm phòng trọ ngay</a>
						<p class="error" style="color:red;margin-top: 15px;"></p>
					</form>
				</div>
			</div>
		</div>
		<hr/>
		<div class="row">
			<div class="col-md-6">
				Copyright PolyRM
			</div>
			<div class="col-md-6 text-right">
				<small>© 2018</small>
			</div>
		</div>
	</div>
	<script>
		var url = "{{ url('/') }}/";
		$(document).on('click', '#loginAction', function(e){
			e.preventDefault();
			let data = new FormData();
			data.append('_token', $('#login input[name=_token]').val());
			data.append('username', $('#login input[name=username]').val());
			data.append('password', $('#login input[name=password]').val());
			$.ajax({
				type : "POST",
				url : url + 'rm-admin',
				data: data,
				processData: false,
				contentType: false,
				success : function(data) {
					if(data.success) {
						window.location = url+'rm-admin/dashboard' ;
					}else if(data.errors) {
						if(data.errors == 'Login Fail') {
							$('#login .error').text('* Sai tên đăng nhập hoặc mật khẩu')
							$('#login .username-error').text('');
							$('#login .password-error').text('');
						}else {
							$('#login .error').text('');
							if(data.errors.username){
								$('#login .username-error').text('* '+ data.errors.username);
							}else $('#login .username-error').text('');
							if(data.errors.password){
								$('#login .password-error').text('* '+ data.errors.password);
							}else $('#login .password-error').text('');
						}
					}
				}
			});
		});
	</script>
</body>

</html>