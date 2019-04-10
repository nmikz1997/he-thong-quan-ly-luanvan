@extends('admin-layout.index')

@section('content')
<div id="content-wrapper">
	<div class="container-fluid" ng-controller="CanBoController">
		<div class="card mb-3">
			<div class="card-header">
				<h5 class="fas fa-table" style="display: inline-block;"> Danh sách cán bộ </h5>
				<div class="dropdown" style="display: inline-block;">
					<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
						@{{dataTitle}}
					</button>
					<div class="dropdown-menu">
						<a class="dropdown-item" ng-repeat="bomon in arrBoMon" data-ng-click="tuychon(bomon.id)">@{{bomon.ten}}</a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>Mã</th>
								<th>Tên</th>
								<th>Chức vụ</th>
								<th>Email</th>
								<th>SĐT</th>
								<th>
									<button data-toggle="modal" class="btn btn-primary" ng-click="modal('add')">Thêm</button>
								</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="cb in arrCanBo">
								<td>@{{ cb.id }}</td>
								<td>@{{ cb.chucdanh +" "+ cb.ten }}</td>
								<td>@{{ cb.chucvu == 'TK' ? 'Thư ký bộ môn': 'Giảng viên'}}</td>
								<td>@{{ cb.email }}</td>
								<td>@{{ cb.sdt }}</td>
								<td>
									<button class="btn btn-warning" ng-click="modal('edit',cb.id)"><i class="fa fa-edit"></i></button>
									<button class="btn btn-danger" ng-click="confirmDelete(cb.id)"><i class="fa fa-times"></i></button>
								</td>
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
						<form name="frmCanbo" class="form-horizontal">
							<div class="form-group">
								<label for="ma" class="col-form-label">Mã cán bộ:</label>
								<input type="text" class="form-control" id="ma" name="ma" ng-model="canbo.id" ng-readonly="makeReadOnly" ng-required="true"/>
								<span id="helpBlock2" class="help-block" ng-show="frmCanbo.id.$error.required">Vui lòng nhập mã cán bộ</span>
							</div>
							<div class="form-group">
								<label for="ten" class="col-form-label">Họ tên:</label>
								<input type="text" class="form-control" id="ten" name="ten" ng-model="canbo.ten" ng-required="true"/>
								<span id="helpBlock2" class="help-block" ng-show="frmCanbo.ten.$error.required">Vui lòng nhập tên cán bộ</span>
							</div>
							<div class="form-group">
								<label for="repeatSelect" class="col-form-label">Bộ môn: </label>
								<select name="repeatSelect" id="repeatSelect" ng-model="canbo.bomon_id" class="form-control" ng-options="bomon.id as bomon.ten for bomon in arrBoMon">
								</select>
							</div>
							<div class="form-group">
								<label for="repeatSelect1" class="col-form-label">Chức danh: </label>
								<select name="repeatSelect1" id="repeatSelect1" ng-model="canbo.chucdanh" class="form-control" ng-options="chucdanh.id as chucdanh.ten for chucdanh in arrChucDanh">
								</select>
								<span id="helpBlock2" class="help-block" ng-show="frmCanbo.ten.$error.required">Vui lòng chọn chức danh</span>
							</div>
							<div class="form-group">
								<label for="repeatSelect2" class="col-form-label">Chức vụ: </label>
								<select name="repeatSelect2" id="repeatSelect2" ng-model="canbo.chucvu" class="form-control" ng-options="chucvu.id as chucvu.ten for chucvu in arrChucVu">
								</select>
								<span id="helpBlock2" class="help-block" ng-show="frmCanbo.chucvu.$error.required">Vui lòng chọn chức vụ</span>
							</div>
							<div class="form-group">
								<label for="email" class="col-form-label">Email:</label>
								<input type="email" class="form-control" id="email" name="email" placeholder="Vui lòng nhập Email" ng-model="canbo.email" ng-required="true" />
								<span id="helpBlock2" class="help-block" ng-show="frmCanBo.email.$error.required">Vui lòng nhập email</span>
								<span id="helpBlock2" class="help-block" ng-show="frmCanbo.email.$error.email">Đây không phải là định dạng Email</span>
							</div>
							<div class="form-group">
								<label for="password" class="col-form-label">Password:</label>
								<input type="password" class="form-control" id="password" name="password" ng-model="canbo.password" ng-required="true"/>
								<span id="helpBlock2" class="help-block" ng-show="frmCanbo.password.$error.required">Vui lòng nhập mật khẩu</span>
							</div>
							<div class="form-group">
								<label for="sdt" class="col-form-label">SĐT:</label>
								<input type="text" class="form-control" id="sdt" name="sdt" ng-model="canbo.sdt" ng-required="true"/>
								<span id="helpBlock2" class="help-block" ng-show="frmCanbo.sdt.$error.required">Vui lòng nhập số điện thoại</span>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" ng-disabled="frmCanbo.$invalid" ng-click="save(state,canbo.id)">Gửi</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('custom-js')
<script src="{{asset('app/CanBoController.js')}}"></script>
@endsection