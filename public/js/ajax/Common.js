// Register
$(document).on('click', '#btn-register', function(e){
	e.preventDefault();
	let data = new FormData();
	data.append('_token', $('#signup input[name=_token]').val());
	data.append('fullname', $('#signup input[name=fullname]').val());
	data.append('email', $('#signup input[name=email]').val());
	data.append('username', $('#signup input[name=register_username]').val());
	data.append('password', $('#signup input[name=register_password]').val());
	data.append('password_confirmation', $('#signup input[name=register_password_confirmation]').val());
	data.append('phone', $('#signup input[name=phone]').val());
	data.append('role', $('#userType :selected').val());
	$.ajax({
		type : "POST",
		url : url + 'register',
		data: data,
		processData: false,
		contentType: false,
		success : function(data) {
			if(data.success) {
				swal({
					type: 'success',
					title: "Đăng ký thành công?",
					text: "Bây giờ bạn có thể đăng nhập vào website",
					timer: 2000
				}).then((result) => {
					window.location = url;
				})
			}else if(data.errors) {
				if(data.errors.fullname) {
					$('.fullname-error').text('* '+ data.errors.fullname)
				}else $('.fullname-error').text('');
				if(data.errors.email) {
					$('.email-error').text('* '+ data.errors.email)
				}else $('.email-error').text('');
				if(data.errors.username) {
					$('.register_username-error').text('* '+ data.errors.username)
				}else $('.register_username-error').text('');
				if(data.errors.password) {
					$('.register_password-error').text('* '+ data.errors.password)
				}else $('.register_password-error').text('');
				if(data.errors.phone) {
					$('.phone-error').text('* '+ data.errors.phone)
				}else $('.phone-error').text('');
				if(data.errors.role) {
					$('.userType').text('* '+ data.errors.role)
				}else $('.userType').text('');
			}
		}
	});
});
// Register 

// Login
$(document).on('click', '#btn-login', function(e){
	e.preventDefault();
	let data = new FormData();
	data.append('_token', $('#login input[name=_token]').val());
	data.append('username', $('#login input[name=login_username]').val());
	data.append('password', $('#login input[name=login_password]').val());
	$.ajax({
		type : "POST",
		url : url + 'login',
		data: data,
		processData: false,
		contentType: false,
		success : function(data) {
			if(data.success) {
				window.location = url ;
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
// Login

//Logout
$(document).on('click', '#logout', function(e){
	e.preventDefault();
	swal({
		title: "Bạn muốn đăng xuất?",
		text: "Chúc bạn một ngày làm việc hiệu quả !!!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#64ddbb',
		cancelButtonColor: '#64ddbb',
		confirmButtonText: 'Có',
		cancelButtonText: 'Hủy'
	}).then((result) => {
		if (result.value) {
			$.ajax({
				type : "GET",
				url : url + 'logout',
				processData: false,
				contentType: false,
				success : function(data) {
					if(data.success) {
						window.location.replace(url)
					}
				}
			});
		}
	})
});
//Logout

//Full name 
$('.fullname').click(function(e) {
	e.preventDefault();
})
//Full name 

