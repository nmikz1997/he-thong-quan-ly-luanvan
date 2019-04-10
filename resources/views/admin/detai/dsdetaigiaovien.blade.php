@extends('admin-layout.index')

@section('content')

<style>
	.content {
		width: 340px;
		overflow: hidden;
		word-wrap: break-word;
		text-overflow: ellipsis;
		line-height: 18px;
	}
	.less {
		max-height: 54px;
	}
</style>

<div id="content-wrapper">
	<div class="container-fluid" ng-controller="DeTaiGiaoVienController">
		<div class="card mb-3">
			<div class="card-header">
				<h5 class="fas fa-table" style="display: inline-block;"> danh sách đề tài  @{{canbo.chucdanh+' '+canbo.ten}}</h5>
			</div>
			<div class="card-body">
			<div class="table-responsive">
					<table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>Mã</th>
								<th>Tên</th>
								<th style="width: 340px;">Mô tả</th>
								<th>Số lượng sinh viên</th>
								@if($allow == 1)
								<th><button data-toggle="modal" class="btn btn-primary" ng-click="modal('add')">Thêm</button></th>
								@endif
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="dt in arrDeTai">
								<td>@{{ dt.id }}</td>
								<td>@{{ dt.ten }}</td>
								<td><div class="content" ng-class="{ less:hidden }">@{{ dt.mota }}</div><button ng-click="hidden = !hidden" class="btn btn-link">@{{hidden ? 'Xem thêm' : 'Ẩn bớt'}}</button></td>
								<td>@{{ dt.soluongsv }}</td>
								@if($allow == 1)
								<td>
									<button class="btn btn-warning" ng-click="modal('edit',dt.id)"><i class="far fa-edit"></i></button>
									<button class="btn btn-danger" ng-click="confirmDelete(dt.id)"><i class="far fa-trash-alt"></i></button>
								</td>
								@endif
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
						<form name="frmDetai" class="form-horizontal">
							<div class="form-group">
								<label for="ten" class="col-form-label">Tên đề tài:</label>
								<input type="text" class="form-control" id="ten" name="ten" ng-model="detai.ten" ng-required="true"/>
								<span id="helpBlock2" class="help-block" ng-show="frmDetai.ten.$error.required">Vui lòng nhập tên đề tài</span>
							</div>
							<div class="form-group">
								<label for="mota" class="col-form-label">Mô tả:</label>
								<textarea class="form-control" id="mota" name="mota" ng-model="detai.mota" ng-required="true"></textarea>
								<span id="helpBlock2" class="help-block" ng-show="frmDetai.mota.$error.required">Vui lòng mô tả đề tài</span>
							</div>
							<div class="form-group">
								<label for="soluongsv" class="col-form-label">Số lượng sinh viên thực hiện:</label>
								<input type="number" class="form-control" id="soluongsv" name="soluongsv" ng-model="detai.soluongsv" ng-required="true" min="1"/>
								<span id="helpBlock2" class="help-block" ng-show="frmDetai.soluongsv.$error.required">Vui lòng nhập số lượng sinh viên</span>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" ng-disabled="frmDetai.$invalid" ng-click="save(state,detai.id)">Gửi</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('custom-js')
<script src="{{asset('app/DeTaiGiaoVienController.js')}}"></script>
@endsection