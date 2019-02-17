var loadFile = function(event) {
	var reader = new FileReader();
	reader.onload = function() {
		var output = document.getElementById('output--img');
		output.src = reader.result;
	};
	if(event.target.files[0]) reader.readAsDataURL(event.target.files[0]);
};
$(document).on('click', '#user-profile .save', function(e){
	e.preventDefault();
	let data = new FormData();
	data.append('_token', $('#user-profile input[name=_token]').val());
	data.append('fullname', $('#user-profile input[name=fullname]').val());
	data.append('phone', $('#user-profile input[name=phone]').val());
	if($('#user-profile #image')[0].files[0]) {
		data.append('avatar', $('#user-profile #image')[0].files[0]);
	}
	let check = true;
	let password = $('#user-profile input[name=password]').val();
	let password_confirmation = $('#user-profile input[name=password_confirmation]').val();
	if(password.length == 0 && password_confirmation) {
		$('.password-error').text('* Trường này không được bỏ trống');
		check = false;
	}else if(password && password_confirmation.length == 0) {
		$('.password-error').text('* Thiếu thông tin để đổi mật khẩu');
		check = false;
	}else if(password) {
		check = true;
		$('.password-error').text('');
		data.append('password', $('#user-profile input[name=password]').val());
		data.append('password_confirmation', $('#user-profile input[name=password_confirmation]').val());
	}
	if(check) {
		$.ajax({
			type : "POST",
			url : url + 'profile',
			processData: false,
			contentType: false,
			data: data,
			enctype: 'multipart/form-data',
			success : function(data) {
				if(data.success) {
					swal({
						type: 'success',
						title: "Lưu thành công",
						text: "Thông tin đã được lưu",
						timer: 2000
					}).then((result) => {
						window.location.replace(url + 'profile')
					})
				}else if(data.errors) {
					if(data.errors.fullname) {
						$('.fullname-error').text('* '+ data.errors.fullname)
					}else $('.fullname-error').text('');
					if(data.errors.phone) {
						$('.phone-error').text('* '+ data.errors.phone)
					}else $('.phone-error').text('');
				}else if(data.errors_password) {
					if(data.errors_password) {
						$('.password-error').text('* '+ data.errors_password)
					}else $('.password-error').text('');
				}
			}
		});
	}
});
$('.property--price').each(function(){
	new AutoNumeric($(this).get(0), { 
		currencySymbolPlacement: 's',
		suffixText: ' VNĐ',
		digitGroupSeparator        : '.',
		decimalCharacter           : ',',
		decimalCharacterAlternative: '.',
		decimalPlaces: 0,
		modifyValueOnWheel: false,
		minimumValue: '1',
		emptyInputBehavior: 'null',
	});
});
function deleteProperty(id) {
	swal({
		title: "Xóa tin đăng",
		text: "Bạn có chắc chắn muốn xóa tin đăng này không ?",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#64ddbb',
		cancelButtonColor: '#64ddbb',
		confirmButtonText: 'Có',
		cancelButtonText: 'Hủy'
	}).then((result) => {
		if(result.value) {
			window.location = url+'property/delete/'+id;
		}
		
	})
}