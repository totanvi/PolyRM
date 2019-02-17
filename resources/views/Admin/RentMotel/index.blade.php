@extends('Layouts.Admin') 
@section('title', 'Tin cho thuê phòng trọ') 
@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Tin cho thuê phòng trọ</h2>
		<ol class="breadcrumb">
			<li>
				<a href="#">Trang quản trị</a>
			</li>
			<li>
				<a href="#">Quản lý tin đăng</a>
			</li>
			<li class="active">
				<strong>Tin cho thuê phòng trọ</strong>
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
					<h5>Danh sách tin đăng cho thuê phòng trọ</h5>
				</div>
				<div class="ibox-content">
					<form class="form-inline searchForm text-center">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Tiêu đề" name="title">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Địa chỉ" name="location">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Giá" name="price">
						</div>
						<div class="form-group">
							<select id="statusRentmotel" class="form-control" style="width: 175px;">
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
						<table class="table table-striped table-bordered table-hover" id="DataTablesRentMotel">
							<thead>
								<tr role="row">
									<th style="width: 50px;">STT</th>
									<th style="width: 250px;">Tiêu đề</th>
									<th style="width: 250px;">Địa chỉ</th>
									<th style="width: 150px;">Giá</th>
									<th style="width: 100px;">Trạng thái</th>
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
	<script src="{{ asset('js/autonumeric.js') }}"></script>
	<script src="{{ asset('js/select2.min.js') }}"></script>
	<script>
		new AutoNumeric('input[name=price]', { 
			currencySymbolPlacement: 's',
			suffixText: ' VNĐ',
			digitGroupSeparator        : '.',
			decimalCharacter           : ',',
			decimalCharacterAlternative: '.',
			decimalPlaces: 0,
			modifyValueOnWheel: false,
			minimumValue: '1',
			emptyInputBehavior: 'null',
		});
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': "{{ csrf_token() }}"
			}
		});
		var oTable = $('#DataTablesRentMotel').DataTable({
			processing: true,
			serverSide: true,
			searching: false,
			ajax: {
				url: "{{ route('Datatable') }}",
				method: 'POST',
				data: function (data) {
					data.title = $('input[name=title]').val();
					data.location = $('input[name=location]').val(); 
					data.price = AutoNumeric.getAutoNumericElement('input[name=price]').rawValue;
					data.status = $('#statusRentmotel :selected').val();
				}
			},
			columns: [
				{data: 'stt'},
				{data: 'property_title', name: 'property_title'},
				{data: 'property_location', name: 'property_location'},
				{data: 'price', name: 'price', className: 'price'},
				{data: 'status', name: 'status'},
				{data: 'action', name: 'action'}
			],
			drawCallback: function( settings ) {
				$.each($('td.price'), function() {
					new AutoNumeric($(this).get(0), { 
						currencySymbolPlacement: 's',
						suffixText: ' VNĐ',
						digitGroupSeparator        : '.',
						decimalCharacter           : ',',
						decimalCharacterAlternative: '.',
						decimalPlaces: 0,
						modifyValueOnWheel: false,
						minimumValue: '1',
						emptyInputBehavior: 'null',
					});
				});
			}
		});
	
		$('.searchForm').on('submit', function(e) {
			oTable.draw();
			e.preventDefault();
		});
		$('#statusRentmotel').select2({
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
				url : url+'rm-admin/rentmotel/view/'+id,
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
							window.location.replace("{{ route('ListRentMotel') }}");
						})
					}else if(data.errors) {
						
					}
				}
			});
		}
		function deleteProperty(id) {
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
						url : url+'rm-admin/rentmotel/delete/'+id,
						processData: false,
						contentType: false,
						success : function(data) {
							if(data.success) {
								window.location.replace("{{ route('ListRentMotel') }}");
							}
						}
					});
				}
			})
		}
	</script>
@endsection