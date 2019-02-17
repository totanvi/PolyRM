@extends('Layouts.User') 
@section('title', 'Tin đã đăng') 
@section('content')
<section id="my-properties" class="my-properties properties-list">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-4">
					<div class="edit--profile-area">
						<ul class="edit--profile-links list-unstyled mb-0">
							<li><a href="{{ route('Profile') }}">Thông tin cá nhân</a></li>
							<li><a href="{{ route('ProfileList') }}" class="active">Các tin đã đăng</a></li>
							<li><a href="{{ route('AddProperty') }}">Đăng tin</a></li>
						</ul>
					</div>
				</div>
				<div class="col-xs-12 col-sm-8 col-md-8">
					@if($listProperty->count()<1)
					<p>Bạn chưa đăng bất kỳ tin nào. <a href="{{ route('AddProperty') }}">ĐĂNG TIN NGAY</a></p>
					@endif
					@foreach ($listProperty as $item)
					<div class="property-item">
						<div class="property--img">
							<a href="{{ route('MotelDetail', $item->property_id) }}">
								<img src="{{ asset('/upload/'. $item->property_image) }}" alt="property image" class="img-responsive ">
								@if($item->property_type == 0)
								<span class="property--status">Cho thuê</span>
								@else 
								<span class="property--status">Tìm người ở ghép</span>
								@endif
							</a>
						</div>
						<div class="property--content">
							<div class="property--info">
								<h5 class="property--title"><a href="{{ route('MotelDetail', $item->property_id) }}">{{ $item->property_title }}</a></h5>
								<p class="property--location">{{ $item->property_location }}</p>
								<p class="property--price">{{ $item->property_price }}</p>
							</div>
							<!-- .property-info end -->
							<div class="property--features">
								<ul>
									<li><span class="feature">Phòng ngủ:</span><span class="feature-num">{{ $item->property_bedroom }}</span></li>
									<li><span class="feature">Phòng tắm:</span><span class="feature-num">{{ $item->property_bathroom }}</span></li>
									<li><span class="feature">Diện tích:</span><span class="feature-num">{{ $item->property_area }}m²</span></li>
								</ul>
								<a href="{{ route('EditProperty', $item->property_id) }}" class="edit--btn edit"><i class="fa fa-edit"></i>Sửa</a>
								<a href="#" class="edit--btn delete" onclick="deleteProperty({{ $item->property_id }}); return false"><i class="fa fa-trash"></i>Xóa</a>
							</div>
							<!-- .property-features end -->
						</div>
					</div>
					@endforeach
					{{ $listProperty->links() }}
				</div>
			</div>
		</div>
	</section>
@endsection
@section('scripts')
<script src="{{ asset('js/jquery.fileuploader.min.js') }}"></script>
<script src="{{ asset('js/autonumeric.js') }}"></script>
<script src="{{ asset('js/ajax/Common.js') }}"></script>
<script src="{{ asset('js/ajax/Profile.js') }}"></script>
@endsection