@extends('Layouts.User') 
@section('title', 'Đăng tin') 
@section('content')
	<section id="page-title" class="page-title bg-overlay bg-overlay-dark2">
		<div class="bg-section">
			<img src="{{ asset('images/page-titles/1.jpg') }}" alt="Background" />
		</div>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
					<div class="title title-1 text-center">
						<div class="title--content">
							<div class="title--heading">
								<h1>Đăng tin</h1>
							</div>
							<ol class="breadcrumb">
								<li><a href="#">Home</a></li>
								<li class="active">Add Property</li>
							</ol>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section id="add-property" class="add-property">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<form class="mb-0" id="propertyForm" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}" >
						<div class="form-box">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
									<h4 class="form--title">Thông tin</h4>
								</div>	
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<label for="property-title">Tiêu đề</label> <span class="error property_title_dm"></span>
										<input type="text" class="form-control" name="property_title" id="property_title">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<label for="property-description">Mô tả</label> <span class="error property_description"></span>
										<textarea class="form-control" id="my-editor" name="property_description" rows="2"></textarea>
									</div>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4">
									<div class="form-group">
										<label for="select-type">Loại tin</label> <span class="error property_type"></span>
										<div class="select--box">
											<i class="fa fa-angle-down"></i>
											<select id="property_type">
												@if(Auth::user()->role == 1 || Auth::user()->role == 10)
												<option value="0">Cho thuê phòng trọ</option>
												@endif
												<option value="1">Tìm người ở ghép</option>
											</select>
										</div>
									</div>
                                </div>
								<div class="col-xs-12 col-sm-4 col-md-4">
									<div class="form-group">
										<label for="property_price">Giá phòng</label> <span class="error property_price"></span>
										<input type="text" class="form-control" name="property_price" id="property_price">
									</div>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4">
									<div class="form-group">
										<label for="property_phone">Số điện thoại</label> <span class="error property_phone"></span>
										<input type="text" class="form-control" name="property_phone" id="property_phone">
									</div>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4">
									<div class="form-group">
										<label for="property_bedroom">Phòng ngủ</label> <span class="error property_bedroom"></span>
										<input type="text" class="form-control" name="property_bedroom" id="property_bedroom">
									</div>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4">
									<div class="form-group">
										<label for="property_bathroom">Phòng tắm</label> <span class="error property_bathroom"></span>
										<input type="text" class="form-control" name="property_bathroom" id="property_bathroom">
									</div>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4">
									<div class="form-group">
										<label for="property_area">Diện tích</label> <span class="error property_area"></span>
										<input type="text" class="form-control" name="property_area" id="property_area">
									</div>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4">
									<div class="form-group">
										<label for="select-type">Tỉnh thành</label> <span class="error property_city"></span>
										<div class="select--box">
											<i class="fa fa-angle-down"></i>
											<select class="city" name="select-location" id="property_city">
												<option></option>
												@foreach ($city as $citys)
												<option value="{{ $citys->city_name }}">{{ $citys->city_name }}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4">
									<div class="form-group">
										<label for="select-type">Quận huyện</label> <span class="error property_district"></span>
										<div class="select--box">
											<i class="fa fa-angle-down"></i>
											<select class="district property_district" name="select-type" id="select-type">
												<option></option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4">
									<div class="form-group">
										<label for="property_location">Địa chỉ</label> <span class="error property_location"></span>
										<input type="text" class="form-control" name="property_location" id="property_location">
									</div>
								</div>
							</div>
						</div>
						<div class="form-box">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
									<h4 class="form--title">Hình ảnh</h4>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-12">
									<input type="file" name="files">
								</div>
							</div>
						</div>
						<input type="submit" value="Đăng tin" name="submit" id="btnOk" class="btn btn--primary">
					</form>
				</div>
			</div>
		</div>
	</section>
	@section('scripts')
	<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
	<script src="{{ asset('js/jquery.fileuploader.min.js') }}"></script>
	<script src="{{ asset('js/autonumeric.js') }}"></script>
	<script src="{{ asset('js/select2.min.js') }}"></script>
	<script src="{{ asset('js/ajax/Common.js') }}"></script>
	<script src="{{ asset('js/ajax/Property.js') }}"></script>
	@endsection
@endsection