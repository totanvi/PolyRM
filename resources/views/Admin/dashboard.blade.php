@extends('Layouts.Admin')
@section('title', 'Thống kê') 
@section('content')
<div class="wrapper wrapper-content">
		<div class="row">
			<div class="col-lg-3">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<span class="label label-success pull-right">Thống kê</span>
						<h5>Thành viên</h5>
					</div>
					<div class="ibox-content">
						<h1 class="no-margins">{{ $user }}</h1>
						<div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
						<small>Tổng thành viên</small>
					</div>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<span class="label label-info pull-right">Thống kê</span>
						<h5>Cho thuê phòng trọ</h5>
					</div>
					<div class="ibox-content">
						<h1 class="no-margins">{{ $rentmotel }}</h1>
						<div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>
						<small>Tổng tin cho thuê phòng trọ</small>
					</div>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<span class="label label-primary pull-right">Thống kê</span>
						<h5>Tìm người ở ghép</h5>
					</div>
					<div class="ibox-content">
						<h1 class="no-margins">{{ $findPeople }}</h1>
						<div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>
						<small>Tổng tin tìm người ở ghép</small>
					</div>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<span class="label label-danger pull-right">Thống kê</span>
						<h5>Bình luận</h5>
					</div>
					<div class="ibox-content">
						<h1 class="no-margins">{{ $comment }}</h1>
						<div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i></div>
						<small>Tổng bình luận</small>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
