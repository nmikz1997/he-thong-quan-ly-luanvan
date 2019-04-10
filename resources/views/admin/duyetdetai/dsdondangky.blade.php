@extends('admin-layout.index')

@section('content')

<div id="content-wrapper">
	<div class="container-fluid" ng-controller="DuyetController">
		<div class="card mb-3">
			<div class="card-header">
				<h5 class="fas fa-table" style="display: inline-block;"> Danh sách đơn đăng ký</h5>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>Mã đơn đăng ký</th>
								<th>MSSV</th>
								<th>Tên sinh viên</th>
								<th>Tên đề tài</th>
								<th>Thời gian đăng ký</th>
								<th>Bảng điểm</th>
								<th>Duyệt đơn</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="dt in arr">
								<td>@{{ dt.id }}</td>
								<td>@{{ dt.sv_id }}</td>
								<td>@{{ dt.sv_ten }}</td>
								<td>@{{ dt.ten }}</td>
								<td>@{{ dt.created_at }}</td>
								<td><button class="btn btn-warning" ng-click="xemBangDiem(dt.sv_id)"><i class="far fa-eye"></i></button></td>
								<td>
									<button class="btn btn-primary" ng-if="dt.xacnhan == 0" ng-click="duyet(dt.id,dt.detai_id,dt.sv_id)">Duyệt</button>
									<button class="btn btn-danger" ng-if="dt.xacnhan == 1" ng-click="huyDuyet(dt.id)">Bỏ Duyệt</button>
								</td>

							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Bảng điểm</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<embed src="@{{bangdiem}}" type="application/pdf" width="750" height="500">
						</embed>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('custom-js')
<script src="{{asset('app/DuyetDeTaiController.js')}}"></script>
@endsection