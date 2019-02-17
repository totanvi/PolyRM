@extends('Layouts.User') 
@section('title', $getProperty->property_title) 
@section('content')
<!-- #page-title end -->

<!-- property single gallery
============================================= -->
<section id="property-single-gallery" class="property-single-gallery">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="property-single-gallery-info">
					<div class="property--info clearfix">
						<div class="pull-left">
							<h5 class="property--title">{{ $getProperty->property_title }}</h5>
							<p class="property--location">
								<i class="fa fa-map-marker"></i>{{ $getProperty->property_location }}
							</p>
							<p class="property--location">
								<i class="fa fa-phone"></i>{{ $getProperty->property_phone }}
							</p>
						</div>
						<div class="pull-right">
							<span class="property--status">
								@if ($getProperty->property_type == 0)
									Cho thuê
								@else
									Tìm người ở ghép
								@endif
							</span>
							<p class="property--price">{{ $getProperty->property_price }}</p>
						</div>
					</div>
					<!-- .property-info end -->
					<div class="property--meta clearfix">
						<div class="pull-left">
							<ul class="list-unstyled list-inline mb-0">
								<li>
									Mã tin: <span class="value property_id">{{ $getProperty->property_id }}</span>
								</li>
								<li>
									Bạn thích tin này: <span class="value"> <i class="fa fa-heart-o"></i></span>
								</li>
							</ul>
						</div>
						<div class="pull-right">
							<div class="property--meta-share">
								<span class="share--title">Chia sẽ</span>
								<a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
								<a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
								<a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
								<a href="#" class="pinterest"><i class="fa fa-pinterest-p"></i></a>
							</div>
							<!-- .property-meta-share end -->
						</div>
					</div>
					<!-- .property-info end -->
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-8">
				<div class="property-single-desc inner-box">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="heading">
								<h2 class="heading--title">Mô tả</h2>
							</div>
						</div>
						<!-- feature-panel #1 -->
						<div class="col-xs-6 col-sm-4 col-md-4">
							<div class="feature-panel">
								<div class="feature--img">
									<img src="{{ asset('images/property-single/features/1.png') }}" alt="icon">
								</div>
								<div class="feature--content">
									<h5>Diện tích:</h5>
									<p>{{ $getProperty->property_area }}m²</p>
								</div>
							</div>
						</div>
						<!-- feature-panel end -->
						<!-- feature-panel #2 -->
						<div class="col-xs-6 col-sm-4 col-md-4">
							<div class="feature-panel">
								<div class="feature--img">
									<img src="{{ asset('images/property-single/features/2.png') }}" alt="icon">
								</div>
								<div class="feature--content">
									<h5>Phòng ngủ:</h5>
									<p>{{ $getProperty->property_bedroom }} phòng</p>
								</div>
							</div>
						</div>
						<!-- feature-panel end -->
						<!-- feature-panel #3 -->
						<div class="col-xs-6 col-sm-4 col-md-4">
							<div class="feature-panel">
								<div class="feature--img">
									<img src="{{ asset('images/property-single/features/3.png') }}" alt="icon">
								</div>
								<div class="feature--content">
									<h5>Phòng tắm:</h5>
									<p>{{ $getProperty->property_bathroom }} phòng</p>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="property--details">
									{!! $getProperty->property_description !!}
							</div>
							<!-- .property-details end -->
						</div>
						<!-- .col-md-12 end -->
					</div>
					<!-- .row end -->
				</div>
				<div class="property-single-carousel inner-box">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="heading">
								<h2 class="heading--title">Thư viện</h2>
							</div>
						</div>
						<!-- .col-md-12 end -->
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="property-single-carousel-content">
								<div class="carousel carousel-thumbs slider-navs" data-slide="1" data-slide-res="1" data-autoplay="true" data-thumbs="true" data-nav="true" data-dots="false" data-space="30" data-loop="true" data-speed="800" data-slider-id="1">
									<img src="{{ asset('images/properties/slider/1.jpg') }}" alt="Property Image">
									<img src="{{ asset('images/properties/slider/2.jpg') }}" alt="Property Image">
									<img src="{{ asset('images/properties/slider/3.jpg') }}" alt="Property Image">
									<img src="{{ asset('images/properties/slider/4.jpg') }}" alt="Property Image">
									<img src="{{ asset('images/properties/slider/5.jpg') }}" alt="Property Image">
								</div>
								<div class="owl-thumbs thumbs-bg" data-slider-id="1">
									<button class="owl-thumb-item">
										<img src="{{ asset('images/properties/slider/thumbs/1.jpg') }}" alt="Property Image thumb">
									</button>
									<button class="owl-thumb-item">
										<img src="{{ asset('images/properties/slider/thumbs/2.jpg') }}" alt="Property Image thumb">
									</button>
									<button class="owl-thumb-item">
										<img src="{{ asset('images/properties/slider/thumbs/3.jpg') }}" alt="Property Image thumb">
									</button>
									<button class="owl-thumb-item">
										<img src="{{ asset('images/properties/slider/thumbs/4.jpg') }}" alt="Property Image thumb">
									</button>
									<button class="owl-thumb-item">
										<img src="{{ asset('images/properties/slider/thumbs/5.jpg') }}" alt="Property Image thumb">
									</button>
								</div>
							</div>
							<!-- .col-md-12 end -->
						</div>
					</div>
					<!-- .row end -->
				</div>
				<div class="property-single-location inner-box">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="heading">
								<h2 class="heading--title">Bản đồ</h2>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div id="googleMap" style="width:100%;height:380px;"></div>
						</div>
						<!-- .col-md-12 end -->
					</div>
					<!-- .row end -->
				</div>

				<div class="property-single-reviews inner-box">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="heading">
								<h2 class="heading--title">{{ $comment->count() }} Nhận xét</h2>
							</div>
						</div>
						<!-- .col-md-12 end -->
						<div class="col-xs-12 col-sm-12 col-md-12">
							<ul class="property-review">
								@foreach ($comment as $value)
								<li class="review-comment">
									<div class="avatar"><img src="{{ asset('upload/'. $value->user->avatar) }}" class="img-responsive"></div>
									<div class="comment">
										<h6>{{ $value->user->fullname }}</h6>
										<div class="date">{{ $value->updated_at }}</div>
										<div class="property-rating">
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star-o"></i>
										</div>
										<p>{{ $value->comment_content }}</p>
									</div>
								</li>
								@endforeach
								
							</ul>
							<!-- .comments-list end -->
						</div>
						<!-- .col-md-12 end -->
					</div>
					<!-- .row end -->
				</div>
				<!-- .property-single-reviews end -->

				<div class="property-single-leave-review inner-box">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="heading">
								<h2 class="heading--title">Để lại nhận xét của bạn</h2>
							</div>
						</div>
						<!-- .col-md-12 end -->
						<div class="col-xs-12 col-sm-12 col-md-12">
							@if (Auth::check())
								<form id="post-comment" class="mb-0">
									<input type="hidden" name="_token" value="{{ csrf_token() }}" >
									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-12">
											<div class="form-group">
												<label for="review-comment">Nhận xét*</label> <span class="error"></span>
												<textarea class="form-control" id="review-comment" rows="2"></textarea>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-12">
											<button type="submit" class="btn btn--primary comment-submit">Gửi</button>
										</div>
									</div>
								</form>
							@else
								<span>Hãy đăng nhập và để lại bình luận của bạn</span>
							@endif
							
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4">
				<div class="widget widget-property-agent">
					<div class="widget--title">
						<h5>Chủ phòng trọ</h5>
					</div>
					<div class="widget--content">
						<a href="#">
							<div class="agent--img">
								<img src="{{ asset('upload/'. $user->avatar) }}" alt="agent" class="img-responsive">
							</div>
							<div class="agent--info">
								<h5 class="agent--title">{{ $user->fullname }}</h5>
							</div>
						</a>
						<div class="agent--contact">
							<ul class="list-unstyled">
								<li><i class="fa fa-phone"></i>{{ $user->phone }}</li>
								<li><i class="fa fa-envelope-o"></i>{{ $user->email }}</li>
								<li><i class="fa fa-link"></i>www.chuphongtro.com</li>
							</ul>
						</div>
						<div class="agent--social-links">
							<a href="#"><i class="fa fa-facebook"></i></a>
							<a href="#"><i class="fa fa-twitter"></i></a>
							<a href="#"><i class="fa fa-google-plus"></i></a>
							<a href="#"><i class="fa fa-linkedin"></i></a>
						</div>
					</div>
				</div>
			</div>
			<!-- .col-md-4 -->
		</div>
		<!-- .row -->
	</div>
	<!-- .container -->
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
			<!-- .col-md-6 -->
		</div>
		<!-- .row -->
	</div>
	<!-- .container -->
</section>
@endsection
 
@section('scripts')
<script>
	var token = "{{ csrf_token() }}";
</script>
<script src="http://maps.google.com/maps/api/js?​sensor=false&libraries=places‌&key=AIzaSyDDsanwS3sFaOek1Fs3znj61e4DYegGGdk"></script>
<script src="{{ asset('js/autonumeric.js') }}"></script>
<script src="{{ asset('js/plugins/jquery.gmap.min.js') }}"></script>
<script>
	$('#googleMap').gMap({
		address: "{{ $getProperty->property_location }}",
		zoom: 14,
		maptype: 'ROADMAP',
		markers: [{
			address: "{{ $getProperty->property_location }}",
			maptype: 'ROADMAP',
			icon: {
				image: "/images/gmap/marker1.png",
				iconsize: [52, 75],
				iconanchor: [52, 75]
			}
		}]
	});
 </script>
<script src="{{ asset('js/map-custom.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/ajax/Common.js') }}"></script>
<script src="{{ asset('js/ajax/Home.js') }}"></script>
@endsection