$('.join').click(function(e){
	e.preventDefault();
	$('#signupModule').modal('show');
	$('.register-login-modal .nav-tabs li:first-child').removeClass('active');
	$('.register-login-modal .nav-tabs li:nth-child(2)').addClass('active');
});
$('.searchSelect .city').select2({
	placeholder: 'Tỉnh thành',
	allowClear: true
});
$('.searchSelect .district').select2({
	placeholder: 'Quận huyện',
	allowClear: true
});
$('.searchSelect .ward').select2({
	placeholder: 'Đường phố',
	allowClear: true
});
$('.searchSelect .area').select2({
	placeholder: 'Diện tích',
	allowClear: true
});
$('.searchSelect .price').select2({
	placeholder: 'Mức giá',
	allowClear: true
});
$('.searchSelect .typeProperty').select2({
	placeholder: 'Loại tin',
	allowClear: true
});

$('.city').on('change', function() {
	if(this.value) {
		$(".district option").not(':first-child').remove();
		let data = new FormData();
		data.append('_token', token);
		data.append('city_name', this.value);
		data.append('city', 1);
		$.ajax({
			type : "POST",
			url : url + 'select',
			data: data,
			processData: false,
			contentType: false,
			success : function(data) {
				if(data.district) {
					$.each(data.district, function(){
						$(".district").append(new Option(this.district_name, this.district_name));
					});
				}else if(data.errors) {
				}
			}
		});
	}else{
		$(".district option").not(':first-child').remove();
	}
	
});
$('.district').on('change', function() {
	if(this.value) {
		$(".ward option").not(':first-child').remove();
		let data = new FormData();
		data.append('_token', token);
		data.append('district_name', this.value);
		data.append('district', 1);
		$.ajax({
			type : "POST",
			url : url + 'select',
			data: data,
			processData: false,
			contentType: false,
			success : function(data) {
				if(data.ward) {
					$.each(data.ward, function(){
						$(".ward").append(new Option(this.ward_name, this.ward_name));
					});
				}else if(data.errors) {
				}
			}
		});
	}else {
		$(".ward option").not(':first-child').remove();
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

$('#property-single-gallery .comment-submit').on('click', function(e) {
	e.preventDefault();
	let data = new FormData();
	data.append('_token', $('#property-single-gallery input[name=_token]').val());
	data.append('comment_content', $('#review-comment').val());
	data.append('property_id', $('.property_id').text());
	$.ajax({
		type : "POST",
		url : url + 'property/comment',
		data: data,
		processData: false,
		contentType: false,
		success : function(data) {
			if(data.success) {
				$('#review-comment').val('')
				swal({
					type: 'success',
					title: "Bình luận thành công",
					text: "Hãy đợi quản trị viên xét duyệt bình luận của bạn",
					timer: 2000
				})
			}else if(data.errors) {
				if(data.errors.comment_content) {
					$('.error').text(data.errors.comment_content)
				}else $('.error').text('');
			}
		}
	});
});