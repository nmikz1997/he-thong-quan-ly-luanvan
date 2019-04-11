<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Hệ thống quản lý luận văn - Login</title>

	<!-- Custom fonts for this template-->
	<link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

	<!-- Custom styles for this template-->
	<link href="{{asset('css/sb-admin.css')}}" rel="stylesheet">

</head>

<body class="bg-dark">

	<div class="container">
		<div class="card card-login mx-auto mt-5">
			<div class="card-header">Đăng nhập</div>
			<div class="card-body">
				@if(count($errors) > 0 )
					<div class="alert alert-danger">
						@foreach($errors->all() as $err)
							{{$err}}</br>
						@endforeach
					</div>
				@endif

				@if(session('message'))
					<div class="alert alert-danger">
						{{session('message')}}
					</div>
				@endif
				
			<form role="form" method="POST" action="{{ url('/login') }}">
				{{ csrf_field() }}
				<div class="form-group">
					<div class="form-label-group">
						<input type="text" id="username" class="form-control" name="username" required="required" autofocus="autofocus">
						<label for="username">User Id</label>
					</div>
				</div>
				<div class="form-group">
					<div class="form-label-group">
						<input type="password" id="inputPassword" class="form-control" name="password" required="required">
						<label for="inputPassword">Password</label>
					</div>
				</div>
				<button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
			</form>
		</div>
	</div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

</body>

</html>
