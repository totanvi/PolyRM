@extends('Layouts.Admin') 
@section('title', 'Danh sách bài viết') 
@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Danh sách bài viết</h2>
		<ol class="breadcrumb">
			<li>
				<a href="#">Trang quản trị</a>
			</li>
			<li>
				<a href="#">Quản lý bài viết</a>
			</li>
			<li class="active">
				<strong>Danh sách bài viết</strong>
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
					<h5>Danh sách tìm người ở ghép</h5>
				</div>
				<div class="ibox-content">
					<form class="form-inline searchForm text-center">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Tiêu đề" name="post_title">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Mô tả ngắn" name="post_description">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Người đăng" name="user_post">
						</div>
						<button type="submit" class="btn btn-primary" style="margin-bottom: 0;">
							<i class="glyphicon glyphicon-edit"></i> Tìm kiếm
						</button>
					</form>
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="DataTablesFindPeople">
							<thead>
								<tr role="row">
									<th style="width: 50px;">STT</th>
									<th style="width: 250px;">Tiêu đề</th>
									<th style="width: 350px;">Mô tả ngắn</th>
									<th style="width: 150px;">Người đăng</th>
									<th style="width: 100px;">Chức năng</th>
								</tr>
							</thead>
						</table>
					</div>
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
	<script>
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': "{{ csrf_token() }}"
			}
		});
		var oTable = $('#DataTablesFindPeople').DataTable({
			processing: true,
			serverSide: true,
			searching: false,
			ajax: {
				url: "{{ route('PostDatable') }}",
				method: 'POST',
				data: function (data) {
					data.post_title = $('input[name=post_title]').val();
					data.post_description = $('input[name=post_description]').val();
					data.user_post = $('input[name=user_post]').val();
				}
			},
			columns: [
				{data: 'stt'},
				{data: 'post_title', name: 'post_title'},
				{data: 'post_description', name: 'post_description'},
				{data: 'user_post', name: 'user_post'},
				{data: 'action', name: 'action'},
			]
		});
	
		$('.searchForm').on('submit', function(e) {
			oTable.draw();
			e.preventDefault();
		});
		function deletePost(id) {
			swal({
				title: "Bạn có chắc chắn muốn xóa tin này?",
				text: "Thông tin bị xóa không thể khôi phục !!!",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#64ddbb',
				cancelButtonColor: '#64ddbb',
				confirmButtonText: 'Có',
				cancelButtonText: 'Hủy'
			}).then((result) => {
				if (result.value) {
					$.ajax({
						type : "GET",
						url : url+'rm-admin/post/delete/'+id,
						processData: false,
						contentType: false,
						success : function(data) {
							if(data.success) {
								window.location.replace("{{ route('PostList') }}");
							}
						}
					});
				}
			})
		}
	</script>
@endsection