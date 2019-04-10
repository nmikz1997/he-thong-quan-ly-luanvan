@extends('admin-layout.index')

@section('custom-css')

@endsection

@section('content')

<div id="content-wrapper">
	<div class="container-fluid" ng-controller="HoiDongController">
		<div class="card mb-3">
			<div class="card-header">
				<h5 class="fas fa-table" style="display: inline-block;"> Danh sách hội đồng </h5>
				@if(Auth::user()->level == 3)
				<div class="dropdown" style="display: inline-block;">
					<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
						@{{ dataTitle }}
					</button>
					<div class="dropdown-menu">
						<a class="dropdown-item" ng-repeat="bomon in arrBoMon" data-ng-click="tuychon(bomon.id)">@{{ bomon.ten }}</a>
					</div>
				</div>
				@endif
			</div>
			<div class="card-body">
				<div class="table-responsive">
					{{-- id="data-table" dt-option="dtOptions" dt-column="dtColumns" datatable="ng" --}}

					<table id="data-table" class="table table-bordered table-hover" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>MSSV</th>
								<th>Tên đề tài</th>
								<th>Ngày</th>
								<th>Tiết</th>
								<th>Địa điểm</th>
								<th>Hội đồng</th>
								<th>Cập nhật hội đồng</th>
								<th>Sắp lịch</th>
							</tr>
						</thead>
						<tbody>
							{{--  --}}
							<tr ng-repeat="lv in arrHoidong | orderBy: ['hoidong[0].pivot.ngay_id', 'hoidong[0].pivot.gio_id','hoidong[0].pivot.diadiem_id']">
								<td>@{{ lv.id }}</td>
								<td>@{{ lv.detai.ten }}</td>
								<td>@{{ lv.hoidong[0].pivot.ngay_id }}</td>
								<td>@{{ lv.hoidong[0].pivot.gio_id }}</td>
								<td>@{{ lv.hoidong[0].pivot.diadiem_id }}</td>
								<td>
									<ol>
										<li ng-repeat="hd in lv.hoidong | orderBy: 'hd.pivot.vaitro':'desc' ">
											@{{ hd.chucdanh+'. '+hd.ten }}
										</li>
									</ol>
								</td>
								<td>
									<div ng-if="lv.tinhtrang == 0 && lv.hoidong[0].pivot.ngay_id == null">
										<button class="btn btn-primary" ng-click="modal('add',lv.id,lv.hoidong[0].id)" ng-hide="myBtn">Cập nhật</button>
									</div>
								</td>
								<td>
									<div ng-if="lv.tinhtrang == 0 && lv.hoidong[0].pivot.ngay_id == null">
										<button ng-click="lichModal('S',lv.id)">Sáng</button>
										<button ng-click="lichModal('C',lv.id)">Chiều</button>
									</div>
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
						<form name="frmHoidong" class="form-horizontal">
							<div class="form-group">
								<label for="repeatSelect" class="col-form-label">Chủ tịch: </label>
								<select name="repeatSelect" id="repeatSelect" ng-model="canbo.chutich" class="form-control" ng-options="canbo.id as canbo.chucdanh+'. '+canbo.ten for canbo in arrChutich" ng-change="hienthiUV(canbo)">
								</select>
							</div>
						</form>
						<form name="frmHoidong" class="form-horizontal">
							<div class="form-group">
								<label for="repeatSelect" class="col-form-label">Ủy viên: </label>
								<select name="repeatSelect" id="repeatSelect" ng-model="canbo.uyvien" class="form-control" ng-options="canbo.id as  canbo.chucdanh+'. '+canbo.ten for canbo in arrUyvien">
								</select>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" ng-disabled="frmHoidong.$invalid" ng-click="save(state,lvID)">Gửi</button>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="lichModal" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">@{{frmTitle}}</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form name="frmSapLich" class="form-horizontal">
							<div class="form-group">
								<label for="repeatSelect" class="col-form-label">Ngày: </label>
								<select name="repeatSelect" id="repeatSelect" ng-model="lich.ngay_id" class="form-control" ng-options="lich.ngay_id as lich.ngay_id for lich in arrLich" ng-change="timDiaDiem(lich.ngay_id)">
								</select>
							</div>
						</form>
						<form name="frmSapLich" class="form-horizontal">
							<div class="form-group">
								<label for="repeatSelect" class="col-form-label">Địa điểm: </label>
								<select name="repeatSelect" id="repeatSelect" ng-model="lich.diadiem_id" class="form-control" ng-options="diadiem.diadiem_id as diadiem.diadiem_id for diadiem in arrDiaDiem">
								</select>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" ng-disabled="frmSapLich.$invalid" ng-click="saveLich()">Sắp lịch</button>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
@endsection

@section('custom-js')
<script src="{{asset('app/HoiDongController.js')}}"></script>
@endsection