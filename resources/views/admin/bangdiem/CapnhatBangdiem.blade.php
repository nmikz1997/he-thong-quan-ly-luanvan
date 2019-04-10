@extends('admin-layout.index')

@section('content')


<div id="content-wrapper">
	<div class="container-fluid">
		<div class="card mb-3">
			<div class="card-header">
				<h5> Cập nhật bảng điểm </h5>
			</div>
			<div class="card-body">
				<form action="{{ url('uploadbangdiem') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<label>Bảng điểm</label>
					<input type="file" name="bangdiem" accept=".pdf" required="true"></br>
					<button type="submit" class="btn btn-primary">Upload</button>
				</form>
			</div>
			@if($bangdiem)
			<div>
				<embed src="{{ asset('bangdiem').'/'.$bangdiem }}" type="application/pdf" width="600" height="500">
				</embed>
			</div>
			@endif
		</div>
	</div>
</div>
@endsection

@section('custom-js')
@endsection