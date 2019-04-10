@extends('admin-layout.index')

@section('content')

<div id="content-wrapper">
	<div class="container-fluid" ng-controller="DiaDiemController">
		<div class="card mb-3">
			<div class="card-header">
				<h6 class="fas fa-table">Danh sách @{{dataTitle}}</h6>
				<!-- Select lich join luanvan -->
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>Mã</th>
								<th>Tên địa điểm</th>
								<th>
									<button data-toggle="modal" class="btn btn-primary" ng-click="modal('add')">Thêm</button>
								</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="dd in arrDiaDiem">
								<td>@{{ dd.id }}</td>
								<td>@{{ dd.ten }}</td>
								<td>
									<button class="btn btn-warning" ng-click="modal('edit',dd.id)"><i class="far fa-edit"></i></button>
									<button class="btn btn-danger" ng-click="confirmDelete(dd.id)"><i class="far fa-trash-alt"></i></button>
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
						<form name="frmDiaDiem" class="form-horizontal">
							<div class="form-group">
								<label for="ma" class="col-form-label">Mã địa điểm:</label>
								<input type="text" class="form-control" id="ma" name="ma" ng-model="diadiem.id" ng-readonly="makeReadOnly" ng-required="true"/>
								<span id="helpBlock2" class="help-block" ng-show="frmDiaDiem.id.$error.required">Vui lòng nhập mã địa điểm</span>
							</div>
							<div class="form-group">
								<label for="ten" class="col-form-label">Tên địa điểm:</label>
								<input type="text" class="form-control" id="ten" name="ten" ng-model="diadiem.ten" ng-required="true"/>
								<span id="helpBlock2" class="help-block" ng-show="frmDiaDiem.ten.$error.required">Vui lòng nhập tên địa điểm</span>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" ng-disabled="frmDiaDiem.$invalid" ng-click="save(state,diadiem.id)">Gửi</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('custom-js')
<script src="{{asset('app/DiaDiemController.js')}}"></script>
@endsection