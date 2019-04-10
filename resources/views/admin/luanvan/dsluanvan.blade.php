@extends('admin-layout.index')

@section('content')

<div id="content-wrapper">
	<div class="container-fluid" ng-controller="LuanVanController">
		<div class="card mb-3">
			<div class="card-header">
				<h5 class="fas fa-table" style="display: inline-block;"> Danh sách luận văn đang hướng dẫn </h5>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0" id="data-table" dt-option="dtOptions" dt-column="dtColumns" datatable="ng">
						<thead>
							<tr>
								<th>MSSV</th>
								<th>Tên sinh viên</th>
								<th>Tên đề tài</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="lv in arrLuanVan">
								<td>@{{ lv.sinhvien_id }}</td>
								<td>@{{ lv.sinhvien_ten }}</td>
								<td>@{{ lv.detai_ten }}</td>
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
<script src="{{asset('app/LuanVanController.js')}}"></script>
@endsection