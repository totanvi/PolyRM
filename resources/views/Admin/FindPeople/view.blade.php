@extends('Layouts.Admin') 
@section('title', 'Tin cho thuê phòng trọ') 
@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Tin cho thuê phòng trọ</h2>
		<ol class="breadcrumb">
			<li>
				<a href="#">Trang quản trị</a>
			</li>
			<li>
				<a href="#">Quản lý tin đăng</a>
			</li>
			<li class="active">
				<strong>Tin cho thuê phòng trọ</strong>
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
					<h5>{{ $property->property_title }}</h5>
				</div>
				<div class="ibox-content">
					<div class="form-group">
						<h4>Mô tả</h4>
						<textarea class="form-control" id="my-editor" readonly>{!! $property->property_description !!}</textarea>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Giá cho thuê</label>
								<input type="text" class="form-control" name="property_price" value="{{ $property->property_price }}" readonly>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Người đăng</label>
								<input type="text" class="form-control" value="{{ $property->user->fullname }}" readonly>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Số điện thoại liên hệ</label>
								<input type="text" class="form-control" value="{{ $property->property_phone }}" readonly>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Điện tích</label>
								<input type="text" class="form-control" value="{{ $property->property_area }}m²" readonly>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Phòng ngủ</label>
								<input type="text" class="form-control" value="{{ $property->property_bedroom }} phòng" readonly>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Phòng tắm</label>
								<input type="text" class="form-control" value="{{ $property->property_bathroom }} phòng" readonly>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Địa chỉ</label>
								<input type="text" class="form-control" value="{{ $property->property_location }}" readonly>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Quận huyện</label>
								<input type="text" class="form-control" value="{{ $property->district->district_name }}" readonly>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Tỉnh thành</label>
								<input type="text" class="form-control" value="{{ $property->city->city_name }}" readonly>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<h4>Hình ảnh</h4>
						</div>
						@foreach ($property->image as $value)
							<div class="col-md-3">
								<img src="{{ asset('upload/'. $value->image_path) }}" class="img-responsive">
							</div>
						@endforeach
					</div>
					<div class="row" style="margin-top: 15px;">
						<div class="col-md-3">
							<div class="form-group">
								<h4>Trạng thái</h4>
								<select class="status form-control" id="select-type">
									<option></option>
									<option value="1"@if($property->approve == 1) selected @endif>Duyệt</option>
									<option value="0"@if($property->approve == 0) selected @endif>Chưa duyệt</option>
								</select>
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
	<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
	<script src="{{ asset('js/autonumeric.js') }}"></script>
	<script src="{{ asset('js/select2.min.js') }}"></script>
	
	<script>
			CKEDITOR.config.entities_latin = false;
			CKEDITOR.replace('my-editor');
			new AutoNumeric('input[name=property_price]', { 
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
			$('.status').select2({
				placeholder: 'Xét duyệt',
				allowClear: true
			});
			$('.save').on('click', function() {
				let data = new FormData();
				data.append('_token', "{{ csrf_token() }}");
				data.append('approve', $('.status :selected').val());
				$.ajax({
					type : "POST",
					url : '{{ route("FindPeopleViewPost", $property->property_id) }}',
					processData: false,
					contentType: false,
					data: data,
					success : function(data) {
						if(data.success) {
							swal({
								type: 'success',
								title: "Lưu thành công",
								text: "Thông tin đã được lưu",
								timer: 2000
							}).then((result) => {
								window.location.replace("{{ route('FindPeople') }}");
							})
						}else if(data.errors) {
							
						}
					}
				});
			})
	</script>
@endsection