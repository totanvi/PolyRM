@extends('Layouts.User') 
@section('title', 'Tin Tức') 
@section('content')
<section id="blog" class="blog blog-grid">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-8">
				<div class="row mb-50">
					@if($posts->count() < 1) 
					<h5>Hiện chưa có bài tin tức nào</h5>
					@endif
					@foreach ($posts as $key => $value)
					<div class="col-xs-12 col-sm-6 col-md-6">
						<div class="blog-entry">
							<div class="entry--img">
								<a href="{{ route('PostDetail', $value->slug) }}">
									<img src="{{ asset('upload/'. $value->post_image) }}" alt="entry image">
								</a>
							</div>
							<div class="entry--content">
								<div class="entry--meta">
									<a href="#">{{ $value->created_at }}</a>
								</div>
								<div class="entry--title">
									<h4><a href="{{ route('PostDetail', $value->slug) }}">{{ $value->post_title }}</a></h4>
								</div>
								<div class="entry--bio">{{ $value->post_description }}</div>
								<div class="entry--more">
									<a href="{{ route('PostDetail', $value->slug) }}">Xem thêm<i class="fa fa-angle-double-right"></i></a>
								</div>
							</div>
						</div>
					</div>
					@if($key!=0 && $key%2)
					<div class="clearfix"></div>
					@endif
					@endforeach
					{{ $posts->links() }}
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
				{{--  <div class="widget widget-categories">
					<div class="widget--title">
						<h5>Archives</h5>
					</div>
					<div class="widget--content">
						<ul class="list-unstyled mb-0">
							<li>
								<a href="#">December, 2017</a>
							</li>
							<li>
								<a href="#">November, 2017</a>
							</li>
							<li>
								<a href="#">October, 2017</a>
							</li>
						</ul>
					</div>
				</div>  --}}
			</div>
		</div>
	</div>
</section>

@section('scripts')
<script src="{{ asset('js/ajax/Common.js') }}"></script>
@endsection

@endsection