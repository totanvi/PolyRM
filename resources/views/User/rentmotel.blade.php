@extends('Layouts.User') 
@section('title', 'Danh sách phòng trọ cho thuê') 
@section('content')
<section id="map" class="hero-map pt-0 pb-0">
	<div class="container-fluid pr-0 pl-0">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div id="googleMap"></div>
			</div>
			<!-- .col-md-12 end -->
		</div>
		<!-- .row end -->
	</div>
	<!-- .container end -->
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
								<!-- .col-md-3 end -->
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
								<!-- .col-md-3 end -->
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
								<!-- .col-md-3 end -->
								<div class="col-xs-12 col-sm-6 col-md-3">
									<input type="submit" value="Tìm" class="btn btn--primary btn--block mb-30">
								</div>
								<!-- .col-md-3 end -->
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
								<!-- .col-md-3 end -->
								<div class="col-xs-12 col-sm-12 col-md-12">
									<a href="#" class="less--options">Less options</a>
								</div>
							</div>
							<!-- .row end -->
						</div>
						<!-- .form-box end -->
					</form>
				</div>
				<!-- .col-md-12 end -->
			</div>
			<!-- .row end -->
		</div>
		<!-- .container end -->
	</div>
</section>
<section id="properties-grid">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-4">
				<!-- widget property type
=============================-->
				<div class="widget widget-property">
					<div class="widget--title">
						<h5>Quận huyện</h5>
					</div>
					<div class="widget--content">
						<ul class="list-unstyled mb-0 districtSearch">
							@foreach ($district as $value)
							<li>
								<a href="#">{{ $value->district_name }}</a> {{-- <a href="#">{{ $value->district_name }} <span>(13)</span></a> --}}
							</li>
							@endforeach
						</ul>
					</div>
				</div>
				<!-- . widget property type end -->

				<!-- widget property status
=============================-->
				<div class="widget widget-property">
					<div class="widget--title">
						<h5>Tỉnh thành</h5>
					</div>
					<div class="widget--content">
						<ul class="list-unstyled mb-0">
							@foreach ($city as $value)
							<li>
								<a href="#">{{ $value->city_name }}<span>(25)</span></a>
							</li>
							@endforeach
						</ul>
					</div>
				</div>
				{{--
				<div class="widget widget-featured-property">
					<div class="widget--title">
						<h5>Featured Properties</h5>
					</div>
					<div class="widget--content">
						<div class="carousel carousel-dots" data-slide="1" data-slide-rs="1" data-autoplay="false" data-nav="false" data-dots="true"
						 data-space="0" data-loop="true" data-speed="800">
							<!-- .property-item #1 -->
							<div class="property-item">
								<div class="property--img">
									<img src="assets/images/properties/13.jpg" alt="property image" class="img-responsive">
									<span class="property--status">For Rent</span>
								</div>
								<div class="property--content">
									<div class="property--info">
										<h5 class="property--title"><a href="property-single-gallery.html">House in Chicago</a></h5>
										<p class="property--location">1445 N State Pkwy, Chicago, IL 60610</p>
										<p class="property--price">$1200<span class="time">month</span></p>
									</div>
									<!-- .property-info end -->
								</div>
							</div>
							<!-- .property item end -->
							<!-- .property-item #2 -->
							<div class="property-item">
								<div class="property--img">
									<img src="assets/images/properties/2.jpg" alt="property image" class="img-responsive">
									<span class="property--status">For Rent</span>
								</div>
								<div class="property--content">
									<div class="property--info">
										<h5 class="property--title"><a href="property-single-gallery.html">Villa in Oglesby Ave</a></h5>
										<p class="property--location">1035 Oglesby Ave, Chicago, IL 60617</p>
										<p class="property--price">$130,000<span class="time">month</span></p>
									</div>
									<!-- .property-info end -->
								</div>
							</div>
							<!-- .property item end -->
							<!-- .property-item #3 -->
							<div class="property-item">
								<div class="property--img">
									<img src="assets/images/properties/3.jpg" alt="property image" class="img-responsive">
									<span class="property--status">For Sale</span>
								</div>
								<div class="property--content">
									<div class="property--info">
										<h5 class="property--title"><a href="property-single-gallery.html">Apartment in Long St.</a></h5>
										<p class="property--location">34 Long St, Jersey City, NJ 07305</p>
										<p class="property--price">$70,000</p>
									</div>
									<!-- .property-info end -->
								</div>
							</div>
							<!-- .property item end -->
						</div>
						<!-- .carousel end -->
					</div>
				</div> --}}
				<!-- . widget featured property end -->
			</div>
			<!-- .col-md-4 end -->
			<div class="col-xs-12 col-sm-12 col-md-8">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
						<div class="properties-filter clearfix">
							<div class="select--box pull-left">
								<label>Sort by:</label>
								<i class="fa fa-angle-up"></i>
								<i class="fa fa-angle-down"></i>
								<select>
									<option selected="" value="Default">Default Sorting</option>
									<option value="Larger">Newest Items</option>
									<option value="Larger">oldest Items</option>
									<option value="Larger">Hot Items</option>
									<option value="Small">Highest Price</option>
									<option value="Medium">Lowest Price</option>
								</select>
							</div>
							<!-- .select-box -->
							<div class="view--type pull-right">
								<a id="switch-list" href="#" class=""><i class="fa fa-th-list"></i></a>
								<a id="switch-grid" href="#" class="active"><i class="fa fa-th-large"></i></a>
							</div>
						</div>
					</div>
					<div class="properties properties-grid">
						@if($listProperty->count()<1)
						<h6>Không tìm thấy phòng trọ nào</h6>
						@endif
						@foreach ($listProperty as $key => $value)
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="property-item">
								<div class="property--img">
									<a href="{{ route('MotelDetail', $value->property_id) }}">
										<img src="{{ asset('upload/'.$value->property_image) }}" alt="property image" class="img-responsive">
									</a>
									@if($value->property_type == 0)
									<span class="property--status">Cho thuê</span>
									@else
									<span class="property--status">Tìm người ở ghép</span>
									@endif
								</div>
								<div class="property--content">
									<div class="property--info">
										<h5 class="property--title">
											<a href="{{ route('MotelDetail', $value->property_id) }}">{{ $value->property_title }}</a>
										</h5>
										<p class="property--location">{{ $value->property_location }}</p>
										<p class="property--price">{{ $value->property_price }}</p>
									</div>
									<!-- .property-info end -->
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
									<!-- .property-features end -->
								</div>
							</div>
						</div>
						@if($key!=0 && $key%2)
						<div class="clearfix"></div>
						@endif
						@endforeach
						
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 text-center mt-50">
							{{ $listProperty->appends(Input::except('page'))->links() }}
					</div>
					<!-- .col-md-12 end -->
				</div>
				<!-- .row -->
			</div>
			<!-- .col-md-8 end -->
		</div>
		<!-- .row -->
	</div>
	<!-- .container -->
</section>
@endsection
 
@section('scripts')
<script>
	var property = {!! json_encode($property->toArray()) !!};
	var token = "{{ csrf_token() }}";
	var city = "{{ request()->get('city') }}";
	var district = "{{ request()->get('district') }}";
	var ward = "{{ request()->get('ward') }}";
	var area = "{{ request()->get('area') }}";
	var price = "{{ request()->get('price') }}";
	var typeProperty = "{{ request()->get('typeProperty') }}";
</script>
<script src="http://maps.google.com/maps/api/js?​sensor=false&libraries=places‌&key=AIzaSyDDsanwS3sFaOek1Fs3znj61e4DYegGGdk"></script>
<script src="{{ asset('js/autonumeric.js') }}"></script>
<script src="{{ asset('js/plugins/jquery.gmap.min.js') }}"></script>
<script src="{{ asset('js/map-addresses.js') }}"></script>
<script src="{{ asset('js/map-custom.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/ajax/Common.js') }}"></script>
<script src="{{ asset('js/ajax/Search.js') }}"></script>
<script src="{{ asset('js/ajax/Home.js') }}"></script>
<script>
	$.each($('.districtSearch li'), function() {
		$(this).find('a').attr('href', url+'rentmotel/search?city=Thành+phố+Hồ+Chí+Minh&district='+$(this).text().trim().replace(/ /g,'+'))
	});
</script>
@endsection