@extends('Layouts.Admin') 
@section('title', 'Thêm mới người dùng') 
@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Thêm mới người dùng</h2>
		<ol class="breadcrumb">
			<li>
				<a href="#">Trang quản trị</a>
			</li>
			<li>
				<a href="#">Quản lý tin đăng</a>
			</li>
			<li class="active">
				<strong>Thêm mới người dùng</strong>
			</li>
		</ol>
	</div>
	<div class="col-lg-2">

	</div>
</div>
@endsection
@section('content')
<div class="wrapper wrapper-content animated fadeInRight rentmotel">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Sửa thông tin thành viên</h5>
				</div>
				<div class="ibox-content">
					<div class="row">
						<div class="col-md-3">
								{{ csrf_field() }}
							<div class="form-group">
								<label>Họ và tên</label> <span class="error fullname-error"></span>
								<input type="text" class="form-control" name="fullname" placeholder="Họ và tên">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Email</label> <span class="error email-error"></span>
								<input type="text" class="form-control" placeholder="Email" name="email">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Số điện thoại</label>  <span class="error phone-error"></span>
								<input type="text" class="form-control" name="phone" placeholder="Số điện thoại">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Loại tài khoản</label> <span class="error usertype-error"></span>
								<select id="usertype" class="form-control">
									<option></option>
									<option value="0">Thành viên thường</option>
									<option value="1">Chủ phòng trọ</option>
									<option value="10">Quản trị viên</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Tên đăng nhập</label> <span class="error username-error"></span>
								<input type="text" class="form-control" name="username" placeholder="Tên đăng nhập">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Mật khẩu</label> <span class="error password-error"></span>
								<input type="password" class="form-control" placeholder="Mật khẩu" name="password">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Nhập lại mật khẩu</label>
								<input type="password" class="form-control" placeholder="Xác nhận lại mật khẩu" name="password_confirmation">
							</div>
						</div>
					</div>
					<button class="btn btn-primary save">Lưu</button>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
	<script src="{{ asset('js/datatables.min.js') }}"></script>
	<script src="{{ asset('js/autonumeric.js') }}"></script>
	<script src="{{ asset('js/select2.min.js') }}"></script>
	<script>
		$('#usertype').select2({
			placeholder: 'Loại tài khoản',
			allowClear: true
		});
		$('.save').on('click', function() {
			let data = new FormData();
			data.append('_token', $('input[name=_token').val());
			data.append('fullname', $('input[name=fullname]').val());
			data.append('phone', $('input[name=phone]').val());
			data.append('email', $('input[name=email]').val());
			data.append('username', $('input[name=username]').val());
			data.append('password', $('input[name=password]').val());
			data.append('password_confirmation', $('input[name=password_confirmation]').val());
			data.append('role', $('#usertype :selected').val());
			$.ajax({
				type : "POST",
				url : '{{ route("UserCreatePost") }}',
				processData: false,
				contentType: false,
				data: data,
				success : function(data) {
					if(data.success) {
						swal({
							type: 'success',
							title: "Lưu thông tin thành công",
							text: "Thông tin đã được lưu",
							timer: 2000
						}).then((result) => {
							window.location.replace("{{ route('User') }}");
						})
					}else if(data.errors) {
						if(data.errors.fullname) {
							$('.fullname-error').text('* '+ data.errors.fullname);
						}else $('.fullname-error').text('');
						if(data.errors.phone) {
							$('.phone-error').text('* '+ data.errors.phone);
						}else $('.phone-error').text('');
						if(data.errors.role) {
							$('.usertype-error').text('* '+ data.errors.role);
						}else $('.usertype-error').text('');
						if(data.errors.email) {
							$('.email-error').text('* '+ data.errors.email);
						}else $('.email-error').text('');
						if(data.errors.username) {
							$('.username-error').text('* '+ data.errors.username);
						}else $('.username-error').text('');
						if(data.errors.password) {
							$('.password-error').text('* '+ data.errors.password);
						}else $('.password-error').text('');
					}
				}
			});
			
		})
	</script>
@endsection