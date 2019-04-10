<!DOCTYPE html>
<html ng-app="quanlyluanvan">
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
	<meta name="description" content=""/>
	<meta name="author" content=""/>
	<title>Hệ thống quản lý luận văn</title>
	<!-- Custom fonts for this template-->
	<link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css"/>
	<!-- Page level plugin CSS-->
	<link href="{{asset('vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet"/>
	<!-- Custom styles for this template-->
	<link href="{{asset('css/sb-admin.css')}}" rel="stylesheet"/>
	<link type="text/css" rel="stylesheet" href="{{asset('css/angular-datatables.min.css')}}" />
	@yield('custom-css')

</head>

<body id="page-top">

	@include('admin-layout.part.header')
	<div id="wrapper">
		@include('admin-layout.part.sidebar')
			@if(session('message'))
				<script>
					var message = '{{session('message')}}';
					alert(message);
				</script>
			@endif
		@yield('content')
		@include('admin-layout.part.footer')
	</div>
	<!-- /.content-wrapper -->
	<!-- /#wrapper -->

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>

	<!-- Logout Modal-->
	<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
					<a class="btn btn-primary" href="login.html">Logout</a>
				</div>
			</div>
		</div>
	</div>

	<!-- Bootstrap core JavaScript-->
	<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
	<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
	<!-- Core plugin JavaScript-->
	<script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
	<!-- Page level plugin JavaScript-->
	{{-- <script src="{{asset('vendor/datatables/jquery.dataTables.js')}}"></script>
	<script src="{{asset('vendor/datatables/dataTables.bootstrap4.js')}}"></script> --}}
	<!-- Custom scripts for all pages-->
	<script src="{{asset('js/sb-admin.min.js')}}"></script>
	<!-- Demo scripts for this page-->
	{{-- <script src="{{asset('js/demo/datatables-demo.js')}}"></script> --}}
	<script src="{{asset('app/libs/angular.min.js')}}"></script>
	<script src="{{asset('app/app.js')}}"></script>
	<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('js/angular-datatables.min.js') }}"> </script>
	@yield('custom-js')

</body>

</html>
