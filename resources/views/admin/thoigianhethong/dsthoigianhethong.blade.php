@extends('admin-layout.index')

@section('content')
<div id="content-wrapper">
	<div class="container-fluid" ng-controller="ThoiGianHeThongController">
		<div class="card mb-3">
			<div class="card-header">
				<h6 class="fas fa-table">Danh sách @{{dataTitle}}</h6> <!-- Select lich join luanvan -->
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>Mã</th>
								<th>Mô tả</th>
								<th>Thời gian</th>
								<th>
								</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="tght in arr">
								<td>@{{ tght.id }}</td>
								<td>@{{ tght.ten }}</td>
								<td>@{{ tght.thoigianmo +' - '+ tght.thoigiandong }}</td>
								<td>
									<button class="btn btn-warning" ng-click="modal('edit', tght.id)"><i class="far fa-edit"></i></button>
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
						<form name="frmTGHT" class="form-horizontal">
							<div class="form-group">
								<label for="tgmo" class="col-form-label">Thời gian mở:</label>
								<input type="date" class="form-control" id="tgmo" ng-model="thoigianhethong.thoigianmo" name="tgmo" ng-required="true"/>
							</div>
							<div class="form-group">
								<label for="tgdong" class="col-form-label">Thời gian đóng:</label>
								<input type="date" class="form-control" id="tgdong" ng-model="thoigianhethong.thoigiandong" name="tgdong" ng-required="true"/>					
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" ng-disabled="frmTGHT.$invalid" ng-click="save(state,thoigianhethong.id)">Gửi</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	
@endsection

@section('custom-js')
<script src="{{asset('app/ThoiGianHeThongController.js')}}"></script>
@endsection