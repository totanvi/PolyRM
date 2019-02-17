$(".district option").not(':first-child').remove();
let data = new FormData();
data.append('_token', $('#propertyForm input[name=_token]').val());
data.append('city_name', $('.city :selected').val());
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
				$(".district").append(new Option(this.district_name, this.district_id));
			});
			district();
		}else if(data.errors) {
		}
	}
});
function district() {
	$.each($('.district option'), function() {
		if($(this).val() == district_edit) {
			$(this).attr('selected','selected');
			$('.district').select2({
				placeholder: 'Quận huyện',
				allowClear: true
			});
		}
	});
}
let imgDelete = []
$('.image-x').on('click', function(){
	imgDelete.push({
		id:$(this).next().attr('image-id'), 
		path:$(this).next().attr('src').replace(/^.*[\\\/]/, '')
	});
	$(this).parent('.col-md-3').remove();
});

$("#editProperty").click(function (e) {
	e.preventDefault()
	let data = new FormData();
	data.append('_token', $('#propertyForm input[name=_token]').val());
	data.append('property_type', $('#property_type :selected').val());
	data.append('property_title', $('input[name=property_title]').val());
	data.append('property_description', CKEDITOR.instances['my-editor'].getData());
	data.append('property_location', $('input[name=property_location]').val());
	data.append('property_city', $('#property_city :selected').val());
	data.append('property_district', $('.property_district :selected').val());
	data.append('property_bedroom',  AutoNumeric.getAutoNumericElement('input[name=property_bedroom]').rawValue);
	data.append('property_bathroom', AutoNumeric.getAutoNumericElement('input[name=property_bathroom]').rawValue);
	data.append('property_area', AutoNumeric.getAutoNumericElement('input[name=property_area]').rawValue);
	data.append('property_price',AutoNumeric.getAutoNumericElement('input[name=property_price]').rawValue);
	data.append('property_phone', $('input[name=property_phone]').val());
	$.each(imgDelete, function() {
		data.append('image_delete_id[]', this.id);
		data.append('image_delete_path[]', this.path);
	});
	let files = image.getChoosedFiles();
	for(var i = 0; i<files.length; i++) {
		data.append('property_image[]', files[i].file, (files[i].name ? files[i].name : false));
	}
	let location = $('input[name=property_location]').val();
	if(location) {
		let urlLocation = 'https://maps.google.com/maps/api/geocode/json?address='+location+'&key=AIzaSyDDsanwS3sFaOek1Fs3znj61e4DYegGGdk';
		let lat = null;
		let lng = null;
		$.ajax({ 
			url: urlLocation, 
			dataType: 'json',
			async: false, 
			processData: false,
			success: function(dataLocation){ 
				if(dataLocation.results[0].geometry.location) {
					lat = dataLocation.results[0].geometry.location.lat;
					lng = dataLocation.results[0].geometry.location.lng;
					data.append('latitude', lat);
					data.append('longitude', lng);
				}else {
					data.append('latitude', '');
					data.append('longitude', '');
				}
			} 
		});
	}
	$.ajax({
		url: url + 'property/edit/'+id_property,
		type: "POST",
		data: data,
		enctype: 'multipart/form-data',
		contentType: false,
		processData: false,
		success: function (data) {
			if (data.success) {
				swal({
					type: 'success',
					title: "Sửa tin thành công",
					text: "Chức mừng bạn đã đăng tin thành công",
					timer: 2000
				}).then((result) => {
					window.location = url+'/profile/list';
				})
			} else if (data.errors) {
				if (data.errors.property_title) {
					$('.property_title_dm').text('* ' + data.errors.property_title)
				} else $('.property_title_dm').text('');
				if (data.errors.property_description) {
					$('.property_description').text('* ' + data.errors.property_description)
				} else $('.property_description').text('');
				if (data.errors.property_type) {
					$('.property_type').text('* ' + data.errors.property_type)
				} else $('.property_type').text('');
				if (data.errors.property_location) {
					$('.property_location').text('* ' + data.errors.property_location)
				} else $('.property_location').text('');
				if (data.errors.property_city) {
					$('.property_city').text('* ' + data.errors.property_city)
				} else $('.property_city').text('');
				if (data.errors.property_district) {
					$('.property_district').text('* ' + data.errors.property_district)
				} else $('.property_district').text('');
				if (data.errors.property_bedroom) {
					$('.property_bedroom').text('* ' + data.errors.property_bedroom)
				} else $('.property_bedroom').text('');
				if (data.errors.property_bathroom) {
					$('.property_bathroom').text('* ' + data.errors.property_bathroom)
				} else $('.property_bathroom').text('');
				if (data.errors.property_area) {
					$('.property_area').text('* ' + data.errors.property_area)
				} else $('.property_area').text('');
				if (data.errors.property_price) {
					$('.property_price').text('* ' + data.errors.property_price)
				} else $('.property_price').text('');
				if (data.errors.property_phone) {
					$('.property_phone').text('* ' + data.errors.property_phone)
				} else $('.property_phone').text('');
				if(data.errors == "errors") {
					$('.property_title').text('* Lỗi sai lệch dữ liệu')
				}else $('.property_title').text('');
			}
		}
	});
});