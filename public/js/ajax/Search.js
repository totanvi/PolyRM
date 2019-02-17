if(city) {
	$.each($('.city option'), function() {
		if($(this).val() == city) {
			$(this).attr('selected','selected');
			// $('.searchSelect .city').select2({
			// 	placeholder: 'Tỉnh thành',
			// 	allowClear: true
			// });
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
				async: false,
				success : function(data) {
					if(data.district) {
						$.each(data.district, function(){
							$(".district").append(new Option(this.district_name, this.district_name));
						});
					}else if(data.errors) {
					}
				}
			});
		}
	});
}
if(district) {
	$.each($('.district option'), function() {
		if($(this).val() == district) {
			$(this).attr('selected','selected');
			// $('.searchSelect .district').select2({
			// 	placeholder: 'Quận huyện',
			// 	allowClear: true
			// });
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
				async: false,
				success : function(data) {
					if(data.ward) {
						$.each(data.ward, function(){
							$(".ward").append(new Option(this.ward_name, this.ward_name));
						});
					}else if(data.errors) {
					}
				}
			});
		}
	});
}
if(ward) {
	$.each($('.ward option'), function() {
		if($(this).val() == ward) {
			$(this).attr('selected','selected');
			// $('.searchSelect .ward').select2({
			// 	placeholder: 'Đường phố',
			// 	allowClear: true
			// });
		}
	});
}
if(area || price || typeProperty) {
	$('.option-hide').slideToggle('slow');
	$('.less--options').toggleClass('active');
}
if(area) {
	$.each($('.area option'), function() {
		if($(this).val() == area) {
			$(this).attr('selected','selected');
			// $('.searchSelect .area').select2({
			// 	placeholder: 'Diện tích',
			// 	allowClear: true
			// });
		}
	});
}
if(price) {
	$.each($('.price option'), function() {
		if($(this).val() == price) {
			$(this).attr('selected','selected');
			// $('.searchSelect .price').select2({
			// 	placeholder: 'Mức giá',
			// 	allowClear: true
			// });
		}
	});
}
if(typeProperty) {
	$.each($('.typeProperty option'), function() {
		if($(this).val() == typeProperty) {
			$(this).attr('selected','selected');
			// $('.searchSelect .typeProperty').select2({
			// 	placeholder: 'Loại tin',
			// 	allowClear: true
			// });
		}
	});
}