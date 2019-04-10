<ul class="sidebar navbar-nav">
	<li class="nav-item">
		<a class="nav-link" href="{{ url('dsdetai') }}">
			<i class="fa fa-fw fa-folder"></i>
			<span>Danh sách đề tài</span>
		</a>
	</li>

	@if(Auth::user()->level === 0)

	<li class="nav-item">
		<a class="nav-link" href="{{ url('bangdiem') }}">
			<i class="fa fa-fas fa-paste fa-fw"></i>
			<span>Cập nhật Bảng điểm</span>
		</a>
	</li>
	
	<li class="nav-item">
		<a class="nav-link" href="{{ url('dsdetaidangky') }}">
			<i class="fa fa-hands-helping fa-fw"></i>
			<span>Đề tài đã đăng ký</span>
		</a>
	</li>

	<li class="nav-item">
		<a class="nav-link" href="{{ url('dsdetaichuadangky') }}">
			<i class="fa fa-pencil-ruler fa-fw"></i>
			<span>Đăng ký đề tài</span>
		</a>
	</li>

	<li class="nav-item">
		<a class="nav-link" href="{{ url('xemdiem') }}">
			<i class="fa fa-calendar-check fa-fw"></i>
			<span>Lịch và Kết quả</span>
		</a>
	</li>
	

	@endif

	@if(Auth::user()->level === 3)
	<li class="nav-item">
		<a class="nav-link" href="{{ url('dssinhvien') }}">
			<i class="fa fa-fw fa-user-graduate"></i>
			<span>Danh sách Sinh Viên</span>
		</a>
	</li>
	<li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<i class="fas fa-fw fa-clock"></i>
			<span>Quản lý Thời gian</span>
		</a>
		<div class="dropdown-menu" aria-labelledby="pagesDropdown">
			<a class="dropdown-item" href="{{ url('dsthoigianhethong') }}">Thời gian hệ thống</a>
			<a class="dropdown-item" href="{{ url('dsnienkhoa') }}">Niên khóa</a>
		</div>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="{{ url('dscanbo') }}">
			<i class="fa fa-fw fa-users"></i>
			<span>Danh sách Cán bộ</span>
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="{{ url('dsdiadiem') }}">
			<i class="fa fa-fw fa-building"></i>
			<span>Danh sách Địa điểm</span>
		</a>
	</li>
	@endif

	@if(Auth::user()->level === 2)

	<li class="nav-item">
		<a class="nav-link" href="{{ url('dshoidong') }}">
			<i class="fa fa-book-reader fa-fw"></i>
			<span>Quản lý Hội đồng</span>
		</a>
	</li>

	<li class="nav-item">
		<a class="nav-link" href="{{ url('dslich') }}">
			<i class="fa fa-fw fa-clock"></i>
			<span>Ngày bảo vệ</span>
		</a>
	</li>
	

	@endif

	<!-- Chức năng của giáo viên -->
	@if(Auth::user()->level > 0)

	<li class="nav-item">
		<a class="nav-link" href="{{ url('dssinhvien') }}">
			<i class="fa fa-fw fa-user-graduate"></i>
			<span>Danh sách Sinh Viên</span>
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="{{ url('dsdetaigiaovien') }}">
			<i class="fa fa-file-alt fa-fw"></i>
			<span>Quản lý Đề tài</span>
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="{{ url('dsdondangky') }}">
			<i class="fa fa-hands-helping fa-fw"></i>
			<span>Quản lý đơn đăng ký</span>
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="{{ url('dsluanvan') }}">
			<i class="fa fa-book fa-fw"></i>
			<span>Luận văn hướng dẫn</span>
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="{{ url('dshoidongthamgia') }}">
			<i class="fa fa-calendar-check fa-fw"></i>
			<span>Lịch Tham dự Hội đồng</span>
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="{{ url('danhsachDiemTB') }}">
			<i class="fa fa-fas fa-paste fa-fw"></i>
			<span>Điểm luận văn</span>
		</a>
	</li>
	@endif
</ul>
