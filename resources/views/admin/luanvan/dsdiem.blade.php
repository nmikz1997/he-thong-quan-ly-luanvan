@extends('admin-layout.index')

@section('content')


<div id="content-wrapper">
	<div class="container-fluid" ng-controller="DanhSachDiemController">
		<div class="card mb-3">
			<div class="card-header">
				<h5 class="fas fa-table" style="display: inline-block;"> Danh sách điểm luận văn sinh viên ngành </h5>
				<div class="dropdown" style="display: inline-block;">
					<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
						@{{dataTitle}}
					</button>
					<div class="dropdown-menu">
						<a class="dropdown-item" ng-repeat="bomon in arrBoMon" data-ng-click="tuychon(bomon.id)">@{{bomon.ten}}</a>
					</div>
				</div>
				{{-- <select ng-model="boMon" ng ng-options="bomon.ten for bomon in arrBoMon"></select> --}}
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0" id="data-table" dt-option="dtOptions" dt-column="dtColumns" datatable="ng">
						<thead>
							<tr>
								<th>MSSV</th>
								<th>Tên sinh viên</th>
								<th>Tên đề tài</th>
								<th>Khóa</th>
								<th>Điểm trung bình</th>
								{{-- <th>Cập nhật</th> --}}
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="diem in arr">
								<td>@{{ diem.luanvan_id }}</td>
								<td>@{{ diem.sv_ten }}</td>
								<td>@{{ diem.detai_ten }}</td>
								<td>@{{ diem.khoa }}</td>
								<td>@{{ diem.DTB }}</td>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('custom-js')
<script src="{{asset('app/DanhSachDiemController.js')}}"></script>
@endsection