@extends('Layouts.User')

@section('title', 'Website thuê phòng trọ dành cho sinh viên FPoly') 

@section('content')
<section id="map" class="hero-map pt-0 pb-0">
	<div class="container-fluid pr-0 pl-0">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div id="googleMap"></div>
			</div>
		</div>
	</div>
	<div class="search-properties">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<form class="mb-0 searchSelect" action="{{ route('RentmotelSearch') }}" method="get">
						<div class="form-box">
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-3">
									<div class="form-group">
										<div class="select--box">
											<i class="fa fa-angle-down"></i>
											<select class="city" name="city" id="select-location">
												<option></option>
												@foreach ($city as $citys)
												<option value="{{ $citys->city_name }}">{{ $citys->city_name }}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3">
									<div class="form-group">
										<div class="select--box">
											<i class="fa fa-angle-down"></i>
											<select class="district" name="district" id="select-type">
												<option></option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3">
									<div class="form-group">
										<div class="select--box">
											<i class="fa fa-angle-down"></i>
											<select class="ward" name="ward" id="select-status">
												<option></option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3">
									<input type="submit" value="Tìm" class="btn btn--primary btn--block mb-30">
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 option-hide" style="display: none;">
									<div class="form-group">
										<div class="select--box">
											<i class="fa fa-angle-down"></i>
											<select class="area" name="area" id="select-beds">
												<option></option>
												<option value="1">Dưới 20m²</option>
												<option value="2">20m² - 30m²</option>
												<option value="3">30m² - 50m²</option>
												<option value="4">50m² - 60m²</option>
												<option value="5">60m² - 70m²</option>
												<option value="6">70m² - 80m²</option>
												<option value="7">80m² - 90m²</option>
												<option value="8">90m² - 100m²</option>
												<option value="9">Trên 100m²</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 option-hide" style="display: none;">
									<div class="form-group">
										<div class="select--box">
											<i class="fa fa-angle-down"></i>
											<select class="price" name="price" id="select-baths">
												<option></option>
												<option value="1">Dưới 1 triệu</option>
												<option value="2">1 triệu - 2 triệu</option>
												<option value="3">2 triệu - 3 triệu</option>
												<option value="4">3 triệu - 5 triệu</option>
												<option value="5">5 triệu - 7 triệu</option>
												<option value="6">7 triệu - 10 triệu</option>
												<option value="7">10 triệu - 15 triệu</option>
												<option value="8">Trên 15 triệu</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3 option-hide" style="display: none;">
									<div class="form-group">
										<div class="select--box">
											<i class="fa fa-angle-down"></i>
											<select class="typeProperty" name="typeProperty" id="select-typeProperty">
												<option></option>
												<option value="0">Cho thuê phòng trọ</option>
												<option value="1">Tìm người ở ghép</option>
											</select>
										</div>
									</div>
								</div>
								{{--  <div class="col-xs-12 col-sm-6 col-md-6 option-hide">
									<div class="filter mb-30">
										<p>
											<label for="amount">Price Range: </label>
											<input id="amount" type="text" class="amount" readonly>
										</p>
										<div class="slider-range"></div>
									</div>
								</div>  --}}
								<div class="col-xs-12 col-sm-12 col-md-12">
									<a href="#" class="less--options">Nâng cao</a>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<section id="properties-carousel" class="properties-carousel">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="heading heading-2 text-center mb-70">
					<h2 class="heading--title">Tin thuê phòng trọ mới nhất</h2>
					<p class="heading--desc">Tin cho thuê phòng trọ cập nhật liên tục</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="carousel carousel-dots" data-slide="3" data-slide-rs="1" data-autoplay="true" data-nav="false" data-dots="true"
					data-space="25" data-loop="true" data-speed="800">
					@foreach ($slider as $value)
					<div class="property-item">
						<div class="property--img">
							<a href="{{ route('MotelDetail', $value->property_id) }}">
							<img src="{{ asset('/upload/'.$value->property_image) }}" alt="property image" class="img-responsive">
								<span class="property--status">Cho thuê</span>
							</a>
						</div>
						<div class="property--content">
							<div class="property--info">
								<h5 class="property--title">
									<a href="{{ route('MotelDetail', $value->property_id) }}">{{ $value->property_title }}</a>
								</h5>
								<p class="property--location">{{ $value->property_location }}</p>
								<p class="property--price">{{ $value->property_price }}</p>
							</div>
							<div class="property--features">
								<ul class="list-unstyled mb-0">
									<li>
										<span class="feature">Phòng ngủ:</span>
										<span class="feature-num">{{ $value->property_bedroom }}</span>
									</li>
									<li>
										<span class="feature">Phòng tắm:</span>
										<span class="feature-num">{{ $value->property_bathroom }}</span>
									</li>
									<li>
										<span class="feature">Diện tích:</span>
										<span class="feature-num">{{ $value->property_area }}m²</span>
									</li>
								</ul>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</section>
<section id="feature" class="feature feature-1 text-center bg-white">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="heading heading-2 text-center mb-70">
					<h2 class="heading--title">Hướng dẫn</h2>
					<p class="heading--desc">Bạn có thể tìm phòng trọ một cách cực kỳ đơn giản</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-4 col-md-4">
				<div class="feature-panel">
					<div class="feature--icon">
						<img src="{{ asset('images/features/icons/5.png') }}" alt="icon img">
					</div>
					<div class="feature--content">
						<h3>Tìm kiếm</h3>
						<p>Tìm kiếm phòng trọ trên website một cách trực quan, hiệu quả</p>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4">
				<div class="feature-panel">
					<div class="feature--icon">
						<img src="{{ asset('images/features/icons/6.png') }}" alt="icon img">
					</div>
					<div class="feature--content">
						<h3>Chọn phòng yêu thích</h3>
						<p>Có nhiều sự lựa chọn, hãy lựa chọn căn phòng trọ phù hợp với bạn</p>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4">
				<div class="feature-panel">
					<div class="feature--icon">
						<img src="{{ asset('images/features/icons/7.png') }}" alt="icon img">
					</div>
					<div class="feature--content">
						<h3>Nhận phòng</h3>
						<p>Liên lạc với chủ phòng trọ, đàm phán và nhận phòng mà bạn yêu thích</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section id="city-property" class="city-property text-center pb-70">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="heading heading-2 text-center mb-70">
					<h2 class="heading--title">TP. HỒ CHÍ MINH</h2>
					<p class="heading--desc">Các phòng trọ ở những quận HOT</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-md-8">
				<div class="property-city-item">
					<div class="property--city-img">
						<a href="{{ route('Rentmotel') }}/search?city=Thành+phố+Hồ+Chí+Minh&district=Quận+3">
							<img src="{{ asset('images/properties/city/1.jpg') }}" alt="city" class="img-responsive">
							<div class="property--city-overlay">
								<div class="property--item-content">
									<h5 class="property--title">Quận 3</h5>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4">
				<div class="property-city-item">
					<div class="property--city-img">
						<a href="{{ route('Rentmotel') }}/search?city=Thành+phố+Hồ+Chí+Minh&district=Quận+1">
							<img src="{{ asset('images/properties/city/2.jpg') }}" alt="city" class="img-responsive">
							<div class="property--city-overlay">
								<div class="property--item-content">
									<h5 class="property--title">Quận 1</h5>
									{{-- <p class="property--numbers">14 tin cho thuê</p> --}}
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-4 col-md-4">
				<div class="property-city-item">
					<div class="property--city-img">
						<a href="{{ route('Rentmotel') }}/search?city=Thành+phố+Hồ+Chí+Minh&district=Quận+Bình+Thạnh">
							<img src="{{ asset('images/properties/city/3.jpg') }}" alt="city" class="img-responsive">
							<div class="property--city-overlay">
								<div class="property--item-content">
									<h5 class="property--title">Quận Bình Thạnh</h5>
									{{-- <p class="property--numbers">18 tin cho thuê</p> --}}
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-8 col-md-8">
				<div class="property-city-item">
					<div class="property--city-img">
						<a href="{{ route('Rentmotel') }}/search?city=Thành+phố+Hồ+Chí+Minh&district=Quận+Tân+Bình">
							<img src="{{ asset('images/properties/city/4.jpg') }}" alt="city" class="img-responsive">
							<div class="property--city-overlay">
								<div class="property--item-content">
									<h5 class="property--title">Quận Tân Bình</h5>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section id="agents" class="agents bg-white">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="heading heading-2 text-center mb-70">
					<h2 class="heading--title">Chủ phòng trọ 'Chất'</h2>
					<p class="heading--desc">Các chủ phòng trọ chất lượng, đáng tin cậy</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-4 col-md-4">
				<div class="agent">
					<div class="agent--img">
						<img src="{{ asset('upload/chuphong1.jpg') }}" alt="agent" />
						<div class="agent--details">
							<p>Tôi đã và đang sử dụng dịch vụ của RentMotel, dịch vụ đăng tin của website rất tốt giúp tiết kiệm chi phí và thời gian</p>
							<div class="agent--social-links">
								<a href="#">
									<i class="fa fa-facebook"></i>
								</a>
								<a href="#">
									<i class="fa fa-twitter"></i>
								</a>
								<a href="#">
									<i class="fa fa-dribbble"></i>
								</a>
								<a href="#">
									<i class="fa fa-linkedin"></i>
								</a>
							</div>
						</div>
					</div>
					<div class="agent--info">
						<h5 class="agent--title">Phạm Gia Hưng</h5>
						<h6 class="agent--position">Chủ phòng trọ</h6>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4">
				<div class="agent">
					<div class="agent--img">
						<img src="{{ asset('upload/chuphong2.jpg') }}" alt="agent" />
						<div class="agent--details">
							<p>Từ khi sử dụng website thì thu nhập từ dãy phòng trọ của tôi tăng lên đáng kể, dãy phòng của tôi lúc nào cũng đầy đủ người, và không có phòng trống</p>
							<div class="agent--social-links">
								<a href="#">
									<i class="fa fa-facebook"></i>
								</a>
								<a href="#">
									<i class="fa fa-twitter"></i>
								</a>
								<a href="#">
									<i class="fa fa-dribbble"></i>
								</a>
								<a href="#">
									<i class="fa fa-linkedin"></i>
								</a>
							</div>
						</div>
					</div>
					<div class="agent--info">
						<h5 class="agent--title">Nguyễn Thành Nam</h5>
						<h6 class="agent--position">Chủ phòng trọ</h6>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4">
				<div class="agent">
					<div class="agent--img">
						<img src="{{ asset('upload/chuphong3.jpg') }}" alt="agent" />
						<div class="agent--details">
							<p>Website thật sự rất có ích cho chủ phòng như tôi, giúp tôi tiết kiệm thời gian và chi phí khi tìm khách hàng.</p>
							<div class="agent--social-links">
								<a href="#">
									<i class="fa fa-facebook"></i>
								</a>
								<a href="#">
									<i class="fa fa-twitter"></i>
								</a>
								<a href="#">
									<i class="fa fa-dribbble"></i>
								</a>
								<a href="#">
									<i class="fa fa-linkedin"></i>
								</a>
							</div>
						</div>
					</div>
					<div class="agent--info">
						<h5 class="agent--title">Nguyễn Diệu Linh</h5>
						<h6 class="agent--position">Chủ phòng trọ</h6>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section id="cta" class="cta cta-1 text-center bg-overlay bg-overlay-dark pt-90">
	<div class="bg-section">
		<img src="{{ asset('images/cta/bg-1.jpg') }}" alt="Background">
	</div>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
				<h3>Bạn là chủ phòng trọ, hãy tham gia website của chúng tôi</h3>
				<a href="#" class="btn btn--primary join">Đăng ký</a>
			</div>
		</div>
	</div>
</section>
@endsection

@section('scripts')
	<script>
		var property = {!! json_encode($property->toArray()) !!};
		var token = "{{ csrf_token() }}";
	</script>
	<script src="http://maps.google.com/maps/api/js?​sensor=false&libraries=places‌&key=AIzaSyDDsanwS3sFaOek1Fs3znj61e4DYegGGdk"></script>
	<script src="{{ asset('js/autonumeric.js') }}"></script>
	<script src="{{ asset('js/plugins/jquery.gmap.min.js') }}"></script>
	<script src="{{ asset('js/map-addresses.js') }}"></script>
	<script src="{{ asset('js/map-custom.js') }}"></script>
	<script src="{{ asset('js/select2.min.js') }}"></script>
	<script src="{{ asset('js/ajax/Common.js') }}"></script>
	<script src="{{ asset('js/ajax/Home.js') }}"></script>
@endsection