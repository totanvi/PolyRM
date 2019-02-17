@extends('Layouts.Admin') 
@section('title', 'Danh sách người dùng') 
@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Danh sách người dùng</h2>
		<ol class="breadcrumb">
			<li>
				<a href="#">Trang quản trị</a>
			</li>
			<li>
				<a href="#">Quản lý người dùng</a>
			</li>
			<li class="active">
				<strong>Danh sách người dùng</strong>
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
							<input type="text" class="form-control" placeholder="Họ và tên" name="fullname">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Tên đăng nhập" name="username">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Email" name="email">
						</div>
						<div class="form-group">
							<select id="role" class="form-control" style="width: 175px;">
								<option></option>
								<option value="10">Quản trị viên</option>
								<option value="1">Chủ phòng trọ</option>
								<option value="0">Thành viên thường</option>
							</select>
						</div>
						
						<button type="submit" class="btn btn-primary" style="margin-bottom: 0;">
							<i class="glyphicon glyphicon-edit"></i> Tìm kiếm
						</button>
					</form>
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="DataTablesUser">
							<thead>
								<tr role="row">
									<th style="width: 50px;">STT</th>
									<th style="width: 250px;">Họ và tên</th>
									<th style="width: 250px;">Tên đăng nhập</th>
									<th style="width: 200px;">Email</th>
									<th style="width: 200px;">Loại tài khoản</th>
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
	<script src="{{ asset('js/select2.min.js') }}"></script>
	<script>
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': "{{ csrf_token() }}"
			}
		});
		var oTable = $('#DataTablesUser').DataTable({
			processing: true,
			serverSide: true,
			searching: false,
			ajax: {
				url: "{{ route('DatableUser') }}",
				method: 'POST',
				data: function (data) {
					data.fullname = $('input[name=fullname]').val();
					data.email = $('input[name=email]').val();
					data.username = $('input[name=username]').val();
					data.role = $('#role :selected').val();
				}
			},
			columns: [
				{data: 'stt'},
				{data: 'fullname', name: 'fullname'},
				{data: 'username', name: 'username'},
				{data: 'email', name: 'email'},
				{data: 'role', name: 'role'},
				{data: 'action', name: 'action'}
			]
		});
	
		$('.searchForm').on('submit', function(e) {
			oTable.draw();
			e.preventDefault();
		});
		$('#role').select2({
			placeholder: 'Loại tài khoản',
			allowClear: true
		});
		$(document).on('click', '.approveBtn', function(e) {
			e.preventDefault();
		});
		function deleteUser(id) {
			swal({
				title: "Bạn có chắc chắn muốn xóa người dùng này?",
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
						url : url+'rm-admin/user/delete/'+id,
						processData: false,
						contentType: false,
						success : function(data) {
							if(data.success) {
								window.location.replace("{{ route('User') }}");
							}
						}
					});
				}
			})
		}
	</script>
@endsection