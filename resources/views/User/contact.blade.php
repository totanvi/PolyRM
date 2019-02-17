@extends('Layouts.User')

@section('title', 'Liên hệ') 

@section('content')
<section id="contact" class="contact contact-1">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-3">
				<div class="heading heading-2 mb-55">
					<h2 class="heading--title">Liên hệ</h2>
				</div>
				<div class="contact-panel">
					<h3>Địa chỉ</h3>
					<p>391A Nam Kỳ Khởi Nghĩa, Quận 3, TP. Hồ Chí Minh</p>
				</div>
				<!-- .contact-panel -->
				<div class="contact-panel">
					<h3>Số điện thoại:</h3>
					<p>0968 028 467</p>
				</div>
				<!-- .contact-panel -->
				<div class="contact-panel">
					<h3>Email:</h3>
					<p>totanvix@gmail.com</p>
				</div>
				<!-- .contact-panel -->
			</div>
			<!-- .col-md-3 end -->

			<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-1 bg-white p-30 bg-white">
				<div id="googleMap" style="width:100%;height:370px;"></div>
			</div>
			<!-- .col-md-8 end -->
		</div>
		<!-- .row end -->
	</div>
</section>
@endsection

@section('scripts')
	<script src="http://maps.google.com/maps/api/js?​sensor=false&libraries=places‌&key=AIzaSyDDsanwS3sFaOek1Fs3znj61e4DYegGGdk"></script>
	<script src="{{ asset('js/plugins/jquery.gmap.min.js') }}"></script>
	<script src="{{ asset('js/ajax/Common.js') }}"></script>
	<script>
        $('#googleMap').gMap({
            address: "391A Nam Kỳ Khởi Nghĩa, Quận 3, TP. Hồ Chí Minh",
            zoom: 14,
            maptype: 'ROADMAP',
            markers: [{
                address: "391A Nam Kỳ Khởi Nghĩa, Quận 3, TP. Hồ Chí Minh",
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
@endsection