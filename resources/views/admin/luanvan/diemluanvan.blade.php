@extends('admin-layout.index')

@section('content')

<div id="content-wrapper">
	<div class="container-fluid" ng-controller="DiemLuanVanController">
		<div class="card mb-3">
			<div class="card-header">
				<h5 class="fas fa-table" style="display: inline-block;"> Kết quả bảo vệ luận văn </h5>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>MSSV</th>
								<th>Tiết</th>
								<th>Ngày</th>
								<th>Địa điểm</th>
								<th>Hội đồng</th>
								<th>Điểm số</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="danhgia in arr">
								<td><div ng-if="$index == 0">@{{ danhgia.pivot.luanvan_id}}</div></td>
								<td><div ng-if="$index == 0">@{{ danhgia.pivot.gio_id }}</div></td>
								<td><div ng-if="$index == 0">@{{ danhgia.pivot.ngay_id }}</div></td>
								<td><div ng-if="$index == 0">@{{ danhgia.pivot.diadiem_id }}</div></td>
								<td>@{{ danhgia.chucdanh+'. '+danhgia.ten }}</td>
								<td align="center">@{{ danhgia.diem }}</td>
							</tr>
							<tr>
								<td colspan="5" align="right">Điểm trung bình</td>
								<td align="center">@{{diem}}</td>
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
<script src="{{asset('app/DiemLuanVanController.js')}}"></script>
@endsection