@extends('admin-layout.index')

@section('content')


<div id="content-wrapper">
	<div class="container-fluid" ng-controller="SinhVienController">
		<div class="card mb-3">
			<div class="card-header">
				<h5 class="fas fa-table" style="display: inline-block;"> Danh sách sinh viên bộ môn </h5>
				<div class="dropdown" style="display: inline-block;">
					<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
						@{{dataTitle}}
					</button>
					<div class="dropdown-menu">
						<a class="dropdown-item" ng-repeat="bomon in arrBoMon" data-ng-click="tuychon(bomon.id)">@{{bomon.ten}}</a>
					</div>
				</div>
				@if(Auth::user()->level == 3)
					<div><button class="btn btn-success" ng-click="modalExcel()">Cập nhật danh sách sinh viên</button></div>
				@endif
				{{-- <select ng-model="boMon" ng ng-options="bomon.ten for bomon in arrBoMon"></select> --}}
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0" id="data-table" dt-option="dtOptions" dt-column="dtColumns" datatable="ng">
						<thead>
							<tr>
								<th>MSSV</th>
								<th>Tên</th>
								<th>Khóa</th>
								<th>Email</th>
								<th>SĐT</th>
								<th>Bảng điểm</th>
								{{-- <th>Cập nhật</th> --}}
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="sv in arrSinhVien">
								<td>@{{ sv.id }}</td>
								<td>@{{ sv.ten }}</td>
								<td>@{{ sv.khoa }}</td>
								<td>@{{ sv.email }}</td>
								<td>@{{ sv.SDT }}</td>
								<td>@{{ sv.bangdiem === null ? 'Chưa cập nhật' : 'Đã cập nhật' }}</td>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			@if(Auth::user()->level == 3)
			<div class="modal fade" id="myModalExcel" tabindex="-1" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Cập nhật danh sách sinh viên</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form action="{{ route('sinhvien.import') }}" method="POST" enctype="multipart/form-data">
								@csrf
								<label>Import file</label>
								<input type="file" name="file"></br>
								<button type="submit" class="btn btn-primary">Import</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			@endif
		</div>
	</div>
	@endsection

	@section('custom-js')
	<script src="{{asset('app/SinhVienController.js')}}"></script>
	@endsection