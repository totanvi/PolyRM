@extends('Layouts.Admin') 
@section('title', 'Quản lý bình luận') 
@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Quản lý bình luận</h2>
		<ol class="breadcrumb">
			<li>
				<a href="#">Trang quản trị</a>
			</li>
			<li class="active">
				<strong>Quản lý bình luận</strong>
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
					<h5>Quản lý bình luận</h5>
				</div>
				<div class="ibox-content">
					<form class="form-inline searchForm text-center">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Nội dung bình luận" name="comment_content">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Tin đăng" name="comment_property">
						</div>
						<div class="form-group">
							<select id="statusComment" class="form-control" style="width: 175px;">
								<option></option>
								<option value="1">Đã duyệt</option>
								<option value="0">Chưa duyệt</option>
							</select>
						</div>
						<button type="submit" class="btn btn-primary" style="margin-bottom: 0;">
							<i class="glyphicon glyphicon-edit"></i> Tìm kiếm
						</button>
					</form>
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="DataTablesComment">
							<thead>
								<tr role="row">
									<th style="width: 50px;">STT</th>
									<th style="width: 300px;">Nội dung bình luận</th>
									<th style="width: 300px;">Tin đăng</th>
									<th style="width: 150px;">Người bình luận</th>
									<th style="width: 200px;">Trạng thái</th>
									<th style="width: 150px;">Chức năng</th>
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
	<script src="{{ asset('js/select2.min.js') }}"></script>
	<script>
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': "{{ csrf_token() }}"
			}
		});
		var oTable = $('#DataTablesComment').DataTable({
			processing: true,
			serverSide: true,
			searching: false,
			ajax: {
				url: "{{ route('CommentDatatable') }}",
				method: 'POST',
				data: function (data) {
					data.comment_content = $('input[name=comment_content]').val();
					data.comment_at_property = $('input[name=comment_property]').val();
					data.status = $('#statusComment :selected').val();
				}
			},
			columns: [
				{data: 'stt'},
				{data: 'comment_content', name: 'comment_content'},
				{data: 'comment_at_property', name: 'comment_at_property'},
				{data: 'comment_user', name: 'comment_user'},
				{data: 'status', name: 'status'},
				{data: 'action', name: 'action'}
			]
		});
		$('.searchForm').on('submit', function(e) {
			oTable.draw();
			e.preventDefault();
		});
		$('#statusComment').select2({
			placeholder: 'Trạng thái',
			allowClear: true
		});
		$(document).on('click', '.approveBtn', function(e) {
			e.preventDefault();
		});
		function approve(id) {
			let data = new FormData();
			console.log(id)
			data.append('_token', "{{ csrf_token() }}");
			data.append('approve', 1);
			$.ajax({
				type : "POST",
				url : url+'rm-admin/comment/approve/'+id,
				processData: false,
				contentType: false,
				data: data,
				success : function(data) {
					if(data.success) {
						swal({
							type: 'success',
							title: "Duyệt thành công",
							text: "Thông tin đã được lưu",
							timer: 2000
						}).then((result) => {
							window.location.replace("{{ route('Comment') }}");
						})
					}else if(data.errors) {
						
					}
				}
			});
		}
		function deleteComment(id) {
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
						url : url+'rm-admin/comment/delete/'+id,
						processData: false,
						contentType: false,
						success : function(data) {
							if(data.success) {
								window.location.replace("{{ route('Comment') }}");
							}
						}
					});
				}
			})
		}
	</script>
@endsection