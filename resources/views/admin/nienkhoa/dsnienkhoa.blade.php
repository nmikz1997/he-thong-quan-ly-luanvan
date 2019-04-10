@extends('admin-layout.index')

@section('content')
<div id="content-wrapper">
	<div class="container-fluid" ng-controller="NienKhoaController">
		<div class="card mb-3">
			<div class="card-header">
				<h6 class="fas fa-table">Danh sách @{{dataTitle}}</h6>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>Mã</th>
								<th>Học kì</th>
								<th>Niên khóa</th>
								<th>
									<button data-toggle="modal" class="btn btn-primary" ng-click="modal('add')">Thêm</button>
								</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="nk in arrNienKhoa">
								<td>@{{ nk.id }}</td>
								<td>@{{ nk.hocki }}</td>
								<td>@{{ nk.nambatdau +' - '+ (nk.nambatdau+1) }}</td>
								<td>
									<button class="btn btn-warning" ng-click="modal('edit',nk.id)"><i class="far fa-edit"></i></button>
									<button class="btn btn-danger" ng-click="confirmDelete(nk.id)"><i class="far fa-trash-alt"></i></button>
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
						<form name="frmNienKhoa" class="form-horizontal">
							<div class="form-group">
								<label for="ma" class="col-form-label">Năm bắt đầu:</label>
								<input type="number" class="form-control" min="2000" id="ma" name="ma" ng-model="nienkhoa.nambatdau" ng-required="true"/>
								<span id="helpBlock2" class="help-block" ng-show="frmNienKhoa.nambatdau.$error.required">Vui lòng nhập năm bắt đầu</span>
							</div>
							<div class="form-group">
								<label class="col-form-label">Học kì: </label>
								<div class="custom-control custom-radio custom-control-inline">
									<input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input" ng-value="1" ng-model="nienkhoa.hocki"/>
									<label class="custom-control-label" for="customRadioInline1">Học kì I</label>
								</div>
								<div class="custom-control custom-radio custom-control-inline">
									<input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input" ng-value="2" ng-model="nienkhoa.hocki"/>
									<label class="custom-control-label" for="customRadioInline2">Học kì II</label>
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" ng-disabled="frmNienKhoa.$invalid" ng-click="save(state,nienkhoa.id)">Gửi</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('custom-js')
<script src="{{asset('app/NienKhoaController.js')}}"></script>
@endsection