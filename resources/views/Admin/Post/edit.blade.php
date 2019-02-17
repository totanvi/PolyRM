@extends('Layouts.Admin') 
@section('title', 'Sửa bài viết') 
@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Sửa bài viết</h2>
		<ol class="breadcrumb">
			<li>
				<a href="#">Trang quản trị</a>
			</li>
			<li>
				<a href="#">Quản lý bài viết</a>
			</li>
			<li class="active">
				<strong>Sửa bài viết</strong>
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
					<h5>Sửa thông tin thành viên</h5>
				</div>
				<div class="ibox-content">
					<div class="row">
						<div class="col-md-12">
							<input type="hidden" name="_token" value="{{ csrf_token() }}" >
							<div class="form-group">
								<label>Tiêu đề</label> <span class="error title-error"></span>
								<input type="text" class="form-control" name="title" value="{{ $post->post_title }}" placeholder="Tiêu đề bài đăng">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Mô tả ngắn</label> <span class="error description-error"></span>
								<textarea class="form-control" id="description" placeholder="Mô tả ngắn">{{ $post->post_description }}</textarea>
							</div>
						</div>
					</div>
					<div class="row" style="margin-bottom: 30px;">
						<div class="col-md-12">
							<label>Nội dung</label> <span class="error my-editor-error"></span>
							<textarea class="form-control" id="my-editor">
								{!! $post->post_content !!}
							</textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<h4 class="form--title">Thay đổi hình ảnh đại diện</h4>
							<h5>Ảnh hiện tại</h5>
							<div class="col-md-3 image-property">
								<img src="{{ asset('/upload/'. $post->post_image) }}" class="img-responsive">
							</div>
						</div>
						<div class="col-xs-12 col-sm-4 col-md-12">
							<input type="file" name="files">
						</div>
					</div>
					<button class="btn btn-primary save">Sửa bài viết</button>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
	<script src="{{ asset('js/datatables.min.js') }}"></script>
	<script src="{{ asset('js/autonumeric.js') }}"></script>
	<script src="{{ asset('js/select2.min.js') }}"></script>
	<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
	<script src="{{ asset('js/jquery.fileuploader.min.js') }}"></script>
	<script>
		var input = $('input[name="files"]').fileuploader({
			addMore: true,
			changeInput: '<div class="fileuploader-input">' +
								'<div class="fileuploader-input-inner">' +
									'<div>${captions.feedback} ${captions.or} <span>${captions.button}</span></div>' +
								'</div>' +
							'</div>',
			theme: 'dropin',
			captions: {
				feedback: 'Kéo thả hình ảnh',
				or: 'hoặc',
				button: 'nhấn vào đây để tải lên'
			},
			limit: 1,
			maxSize: 3,
			fileMaxSize: 3,
			extensions: ['jpg', 'jpeg', 'png'],
			enableApi: true
		});
		window.image = $.fileuploader.getInstance(input);
		var options = {
			filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
			filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
			filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
			filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
		};
		CKEDITOR.config.entities_latin = false;
		CKEDITOR.config.language = 'vi';
		CKEDITOR.replace('my-editor', options);
		
		$('.save').on('click', function() {
			let data = new FormData();
			data.append('_token',  $('input[name=_token]').val());
			data.append('post_title', $('input[name=title]').val());
			data.append('post_description', $('#description').val().trim());
			data.append('post_content', CKEDITOR.instances['my-editor'].getData());
			let files = image.getChoosedFiles();
			if(files.length == 1) {
				data.append('post_image[]', files[0].file, (files[0].name ? files[0].name : false));
			}
			$.ajax({
				type : "POST",
				url : '{{ route("PostEditPost", $post->post_id) }}',
				processData: false,
				contentType: false,
				data: data,
				success : function(data) {
					if(data.success) {
						swal({
							type: 'success',
							title: "Sửa bài viết thành công",
							text: "Thông tin đã được lưu",
							timer: 2000
						}).then((result) => {
							window.location.replace("{{ route('PostList') }}");
						})
					}else if(data.errors) {
						if(data.errors.post_title) {
							$('.title-error').text('* '+ data.errors.post_title);
						}else $('.title-error').text('');
						if(data.errors.post_description) {
							$('.description-error').text('* '+ data.errors.post_description);
						}else $('.description-error').text('');
						if(data.errors.post_content) {
							$('.my-editor-error').text('* '+ data.errors.post_content);
						}else $('.my-editor-error').text('');
					}else if(data.unique_slug) {
						if(data.unique_slug) {
							$('.title-error').text('* Bài viết đã tồn tại');
						}else $('.title-error').text('');
					}
				}
			});
			
		})
	</script>
@endsection