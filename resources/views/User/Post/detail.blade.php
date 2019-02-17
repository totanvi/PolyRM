@extends('Layouts.User') 
@section('title', $post->post_title) 
@section('content')
<section id="blog" class="blog blog-single pb-70">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-8">
				<!-- Blog Entry -->
				<div class="blog-entry">
					<div class="entry--img">
						<img src="{{ asset('upload/'. $post->post_image) }}" alt="entry image">
					</div>
					<div class="entry--content">
						<div class="entry--meta">
							<a href="#">{{ $post->created_at }}</a>
						</div>
						<div class="entry--title">
							<h4>{{ $post->post_title }}</h4>
						</div>
						<div class="entry--bio">
							{!! $post->post_content !!}
						</div>
						<div class="entry--share">
							<span class="share--title">share</span>
							<a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
							<a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
							<a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
							<a href="#" class="pinterest"><i class="fa fa-pinterest-p"></i></a>
						</div>
						<!-- .entry-share end -->
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4">
				<div class="widget widget-search">
					<div class="widget--title">
						<h5>Tìm kiếm</h5>
					</div>
					<div class="widget--content">
						<form class="form-search">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Tìm kiếm bài viết">
								<span class="input-group-btn">
									<button class="btn" type="button"><i class="fa fa-search"></i></button>
								</span>
							</div>
						</form>
					</div>
				</div>
				<div class="widget widget-recent-posts">
					<div class="widget--title">
						<h5>Bài viết mới nhất</h5>
					</div>
					<div class="widget--content">
						@foreach ($posts as $value)
						<div class="entry">
							<a href="{{ $value->slug }}">
								<img src="{{ asset('upload/'. $value->post_image) }}" alt="thumb">
							</a>
							<div class="entry-desc">
								<div class="entry-title">
									<a href="{{ $value->slug }}">{{ $value->post_title }}</a>
								</div>
								<div class="entry-meta">
									<a href="{{ $value->slug }}">{{ $value->created_at }}</a>
								</div>
							</div>
						</div>
						@endforeach
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

@section('scripts')
<script src="{{ asset('js/ajax/Common.js') }}"></script>
<script>
	$('.join').click(function(e){
		e.preventDefault();
		$('#signupModule').modal('show');
		$('.register-login-modal .nav-tabs li:first-child').removeClass('active');
		$('.register-login-modal .nav-tabs li:nth-child(2)').addClass('active');
	});
</script>
@endsection

@endsection