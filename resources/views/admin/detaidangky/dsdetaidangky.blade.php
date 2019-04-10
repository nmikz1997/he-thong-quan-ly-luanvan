@extends('admin-layout.index')

@section('content')

<div id="content-wrapper">
	<div class="container-fluid" ng-controller="DeTaiDaDangKyController">
		<div class="card mb-3">
			<div class="card-header">
				<h5 class="fas fa-table" style="display: inline-block;"> Danh sách đề tài đã đăng ký</h5>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>Mã đề tài</th>
								<th>Tên đề tài</th>
								<th>Thời gian đăng ký</th>
								<th>Thời gian xác nhận</th>
								<th>Chọn luận văn</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="dt in arrDeTai">
								<td>@{{ dt.detai_id }}</td>
								<td>@{{ dt.ten }}</td>
								<td>@{{ dt.created_at }}</td>
								<td>@{{ dt.updated_at }}</td>
								<td ng-hide="true">
									@{{   dt.xacnhan == '0' ? myVar1 = true 
										: dt.xacnhan == '1' ? myVar2 = true
										: dt.xacnhan == '2' ? myVar0 = true
										: myVar3=true
									}}
								</td>
								<td ng-if="myVar0"><i class="fas fa-check-circle"></i></td>
								<td ng-if="myVar1"><button class="btn btn-warning" ng-click="huydangky(dt.id)">Hủy đăng ký</button></td>
								<td ng-if="myVar2"><button class="btn btn-primary" ng-click="dangkyluanvan(dt.detai_id)">Chọn làm luận văn</button></td>
								<td ng-if="myVar3">Không thể đăng ký</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('custom-js')
<script src="{{asset('app/DeTaiDangKyController.js')}}"></script>
@endsection