@extends('Layouts.Admin') 
@section('title', 'Sửa người dùng') 
@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Sửa người dùng</h2>
		<ol class="breadcrumb">
			<li>
				<a href="#">Trang quản trị</a>
			</li>
			<li>
				<a href="#">Quản lý người dùng</a>
			</li>
			<li class="active">
				<strong>Sửa người dùng</strong>
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
								<input type="text" class="form-control" name="fullname" value="{{ $user->fullname }}">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Email</label>
								<input type="text" class="form-control" value="{{ $user->email }}"readonly>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Số điện thoại</label>  <span class="error phone-error"></span>
								<input type="text" class="form-control" value="{{ $user->phone }}" name="phone">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Loại tài khoản</label> <span class="error usertype-error"></span>
								<select id="usertype" class="form-control">
									<option></option>
									<option value="0" @if($user->role == 0) selected @endif>Thành viên thường</option>
									<option value="1" @if($user->role == 1) selected @endif>Chủ phòng trọ</option>
									<option value="10" @if($user->role == 10) selected @endif>Quản trị viên</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Tên đăng nhập</label>
								<input type="text" class="form-control" readonly value="{{ $user->username }}">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Đổi mật khẩu</label> <span class="error password-error"></span>
								<input type="password" class="form-control" placeholder="Mật khẩu mới" name="password">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label style="opacity: 0;">Đổi mật khẩu</label>
								<input type="password" class="form-control" placeholder="Xác nhận lại mật khẩu" name="password_c">
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
			data.append('_token', "{{ csrf_token() }}");
			data.append('fullname', $('input[name=fullname]').val());
			data.append('phone', $('input[name=phone]').val());
			data.append('role', $('#usertype :selected').val());
			let check = true;
			let password = $('input[name=password]').val();
			let password_c = $('input[name=password_c]').val();
			if(password.length == 0 && password_c) {
				$('.password-error').text('* Trường này không được bỏ trống');
				check = false;
			}else if(password && password_c.length == 0) {
				$('.password-error').text('* Thiếu thông tin để đổi mật khẩu');
				check = false;
			}else if(password) {
				check = true;
				$('.password-error').text('');
				data.append('password', password);
				data.append('password_c', password_c);
			}
			if(check) {
				$.ajax({
					type : "POST",
					url : '{{ route("UserViewPost", $user->id) }}',
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
						}else if(data.errors_password) {
							if(data.errors_password) {
								$('.password-error').text('* '+ data.errors_password)
							}else $('.password-error').text('');
						}
					}
				});
			}
		})
	</script>
@endsection