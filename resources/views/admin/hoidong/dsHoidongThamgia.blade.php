@extends('admin-layout.index')

@section('content')

<div id="content-wrapper">
	<div class="container-fluid" ng-controller="HDTGController">
		<div class="card mb-3">
			<div class="card-header">
				<h6 class="fas fa-table"> Danh sách Hội đồng tham dự</h6>
				<!-- Select lich join luanvan -->
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>MSSV</th>
								<th>Tên sinh viên</th>
								<th>Tên đề tài</th>
								<th>Tiết</th>
								<th>Ngày</th>
								<th>Địa điểm</th>
								<th>Vai trò</th>
								<th>Điểm</th>
								<th>Cập nhật điểm số</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="lv in arr">
								<td>@{{ lv.luanvan_id }}</td> 
								<td>@{{ lv.sinhvien_ten }}</td>
								<td>@{{ lv.detai_ten }}</td>
								<td>@{{ lv.gio_id == null ? 'Trống': lv.gio_id }}</td>
								<td>@{{ lv.ngay_id == null ? 'Trống': lv.ngay_id }}</td>
								<td>@{{ lv.diadiem_id == null ? 'Trống': lv.diadiem_id }}</td>
								<td>
									@{{
										lv.vaitro == 1 ? 'Chủ tịch':
										lv.vaitro == 2 ? 'Ủy viên':
										'Thư ký (GVHD)'
									}}
								</td>
								<td>@{{lv.diem}}</td>
								<td>
									<button class="btn btn-primary" ng-if="checkDate(lv.ngay_id)" ng-click="modal(lv.luanvan_id)">Chấm điểm</button>
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
						<form name="frmNhapDiem" class="form-horizontal">
							<div class="form-group">
								<label for="ma" class="col-form-label">Mã số sinh viên:</label>
								<input type="text" class="form-control" id="ma" name="ma" ng-model="luanvan.id" ng-readonly="true"/>
							</div>
							<div class="form-group">
								<label for="ten" class="col-form-label">Tên sinh viên:</label>
								<input type="text" class="form-control" id="ten" name="ten" ng-model="luanvan.sinhvien_ten" ng-readonly="true"/>
							</div>
							<div class="form-group">
								<label for="tendt" class="col-form-label">Tên đề tài:</label>
								<input type="text" class="form-control" id="tendt" name="tendt" ng-model="luanvan.detai_ten" ng-readonly="true"/>
							</div>
							<div class="form-group">
								<label for="diem" class="col-form-label">Điểm số:</label>
								<input type="number" class="form-control" id="diem" name="diem" ng-model="luanvan.diem" min="0" max="10" ng-required="true"/>
								<span id="helpBlock2" class="help-block" ng-show="frmNhapDiem.diem.$error.required">Vui lòng nhập điểm số</span>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" ng-disabled="frmNhapDiem.$invalid" ng-click="save(luanvan.id)">Gửi</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('custom-js')
<script src="{{asset('app/HoiDongThamGiaController.js')}}"></script>
@endsection