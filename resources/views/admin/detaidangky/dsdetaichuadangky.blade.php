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
	<div class="container-fluid" ng-controller="DeTaiChuaDangKyController">
		<div class="card mb-3">
			<div class="card-header">
				<h5 class="fas fa-table" style="display: inline-block;"> Đăng ký đề tài </h5>
				<div class="dropdown" style="display: inline-block;">
					<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
						@{{dataTitle}}
					</button>
					<div class="dropdown-menu">
						<a class="dropdown-item" ng-repeat="bomon in arrBoMon" data-ng-click="tuychon(bomon.id)">@{{bomon.ten}}</a>
					</div>
				</div>

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
								<th>GVHD</th>
								@if($allow)
								<th>Chọn đề tài</th>
								@endif
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="dt in arrDeTai">
								<td>@{{ dt.id }}</td>
								<td>@{{ dt.ten }}</td>
								<td><div class="content" ng-class="{ less:hidden }">@{{ dt.mota }}</div><button ng-click="hidden = !hidden" class="btn btn-link">@{{hidden ? 'Xem thêm' : 'Ẩn bớt'}}</button></td>
								<td>@{{ dt.soluongsv }}</td>
								<td>@{{ dt.canbo.chucdanh +" "+ dt.canbo.ten }}</td>
								@if($allow)
								<td>
									<button class="btn btn-primary" ng-click="dangky(dt.id)">Đăng ký</button>
								</td>
								@endif
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
<script src="{{asset('app/DangKyDeTaiController.js')}}"></script>
@endsection