@extends('admin-layout.index')

@section('content')
<div id="content-wrapper">
	<div class="container-fluid" ng-controller="LichController">
		<div class="card mb-3">
			<div class="card-header">
				<h6 class="fas fa-table" style="display: inline-block;"> Lịch Bảo vệ</h6>
				<div class="dropdown" style="display: inline-block;">
					<select ng-model="obj.id" ng-options="diadiem.id as diadiem.ten for diadiem in arrDiadiem" ng-change="timdd(diadiem)">
					</select>
				</div>
				<div class="dropdown" style="display: inline-block;">
					<select ng-model="obj.ngay" ng-options="ngay.ngay as ngay.ngay for ngay in arrNgay" ng-change="timNgay(ngay)">
					</select>

				</div>
				<div style="display: inline-block; float:right">
					<button data-toggle="modal" class="btn btn-warning" ng-click="modal('add')">Quản lý ngày</button>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>STT</th>
								{{-- <th>Mã lịch</th> --}}
								<th>Tiết</th>
								<th>Ngày</th>
								<th>Địa điểm</th>
								{{-- <th>Luận văn</th> --}}
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="lich in arrLich">
								<td>@{{ $index+1 }}</td>
								{{-- <td>@{{ lich.id }}</td> --}}
								<td>@{{ lich.gio_id}}</td>
								<td>@{{ lich.ngay_id }}</td>
								<td>@{{ lich.diadiem_id }}</td>
								{{-- <td>@{{ lich.luanvan_id == null ? "Chưa có": lich.luanvan_id }}</td> --}}
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">@{{frmTitle}}</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form name="frmNgay" class="form-horizontal">
							<div class="form-group">
								<input type="date" class="form-control" id="ngay" ng-model="ngay.ngay" name="ngay" ng-required="true"/>
							</div>
							<button type="button" class="btn btn-primary" ng-disabled="frmNgay.$invalid" ng-click="save(state,ngay)">Thêm ngày</button>
						</form>
					</div>
					<div class="container">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Mã</th>
									<th>Ngày</th>
									<th>Xóa ngày</th>
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat="ngay in arrNgay">
									<td>@{{ngay.id}}</td>
									<td>@{{ngay.ngay}}</td>
									<td>
										<button ng-click="confirmDelete(ngay.ngay)">Xóa</button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('custom-js')
<script src="{{asset('app/LichController.js')}}"></script>
@endsection