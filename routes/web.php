<?php

// Route::get('/', function (){
// 	return view ('welcome');
// });

Route::get('/', 'UserController@login');
Route::post('login', 'UserController@check');
Route::get('logout', 'UserController@logout');


Route::group(['middleware'=>'checkLogin'], function(){
	Route::get('detai/bomon/{bomonid}', 'DetaiController@index')->name('detai.index');
	Route::get('dsdetai', function() { return view('admin.detai.dsdetai'); })->name('detai.danhsach');	
	//danh sach hoi dong kem lich bao cao...

	Route::group(['middleware'=>'giaovien'], function(){
		Route::get('xemdsDTB/{bomon_id}', 'SinhvienController@diemTrungBinh');
		Route::get('danhsachDiemTB', 'SinhvienController@viewDTB');

		//Cán bộ profile
		//Route::get('cbprofile','profileController@canbo');

		Route::get('sinhvien/bomon/{bomonid}', 'SinhvienController@index')->name('sinhvien.index');
		Route::get('dssinhvien', function() { return view('admin.sinhvien.dssinhvien'); })->name('sinhvien.danhsach');
		
		Route::apiResource('detaigiaovien', 'DetaiController')->except(['index']); // them sua xoa de tai
		Route::get('detaigiaovien', 'DetaiController@DetaiGiaovien')->name('detai.DetaiGiaovien');
		Route::get('dsdetaigiaovien','DetaiController@DetaiView');

		Route::get('dondangky','DetaidangkyController@DeTaiSinhVienDangKy');
		Route::get('dsdondangky',function(){ return view('admin.duyetdetai.dsdondangky'); });
		Route::post('duyetdon','DetaidangkyController@Duyet');
		Route::put('huyduyet/{id}','DetaidangkyController@HoanTacDuyet');

		// danh sách luận văn sinh viên thực hiện với giáo viên trong học kì
		Route::get('luanvan','LuanvanController@index');
		Route::get('dsluanvan','LuanvanController@GVview');
		// danh sách tham dự hội đồng
		Route::get('hoidongthamgia','HoidongController@dsLuanVanHoiDong');
		Route::get('dshoidongthamgia','HoidongController@viewLuanVanHoiDong');
		// Chấm điểm
		Route::get('findluanvan/{id}','HoidongController@showLuanVan');
		Route::put('chamdiemluanvan/{id}','HoidongController@chamDiem');
	});

	Route::group(['middleware'=>'sinhvien'], function(){
		Route::group(['middleware'=>'sinhviendangky'], function(){
			Route::apiResource('detaidangky', 'DetaidangkyController')->except(['index']);
			Route::get('detaichuadangky/{bomonid}','DetaidangkyController@DeTaiChuaDangKy');
			Route::get('dsdetaichuadangky','DetaidangkyController@DangKyDetaiView');
			Route::delete('huydondangky/{id}','DetaidangkyController@HuyDangKy');

			Route::get('detaidadangky','DetaidangkyController@DeTaiDaDangKy');
			Route::get('dsdetaidangky', function() { return view('admin.detaidangky.dsdetaidangky'); });
			Route::post('dangkyluanvan','LuanvanController@DangKyLuanVan')->name('luanvan.dangkyluanvan');
		});
		//Sinh viên profile
		//Route::get('svprofile','profileController@sinhvien');
		Route::get('bangdiem','BangdiemController@viewUpload');
		Route::post('uploadbangdiem','BangdiemController@uploadBangdiem');
		Route::get('diem','HoidongController@hienthiDiem');
		Route::get('xemdiem','HoidongController@viewDiem');
	});

	Route::group(['middleware'=>'thukybomon'], function(){
		// danh sach luan van
		Route::get('hoidong/bomon/{bomon_id}','HoidongController@index');
		Route::get('dshoidong','HoidongController@view');
		Route::post('themhoidong','HoidongController@store');//cap nhat hoi dong
		//Cập nhật lịch
		Route::get('dslich', function () { return view('admin.lich.dslich'); })->name('lich.danhsach');
		Route::post('lich', 'LichController@store');
		Route::get('lich/{diadiem_id}/{ngay_id}','LichController@index');
		Route::delete('xoangay/{id}','NgayController@destroy')->name('ngay.xoangay');
		// Hiển thị lịch và địa điểm phù hợp
		Route::get('chonlich/{buoi}/{luanvan_id}','LichController@ChonLich');
		Route::get('chondiadiem/{buoi}/{ngay_id}','LichController@ChonDiaDiem');
		// Sắp lịch tự động
		Route::post('testDB','LichController@SelectHoiDong');
		Route::get('testCBB/{ngay_id}/{buoi}', 'LichController@CanBoBan');
	});

	Route::group(['middleware'=>'admin'],function(){

		Route::apiResource('diadiem','DiadiemController');
		Route::get('dsdiadiem', function () { return view('admin.diadiem.dsdiadiem'); })->name('diadiem.danhsach');

		Route::apiResource('thoigianhethong', 'ThoigianhethongController')->except(['store','destroy']);
		Route::get('dsthoigianhethong', function () { return view('admin.thoigianhethong.dsthoigianhethong'); })->name('thoigianhethong.danhsach');

		Route::apiResource('nienkhoa', 'NienkhoaController');
		Route::get('dsnienkhoa', function () { return view('admin.nienkhoa.dsnienkhoa'); })->name('nienkhoa.danhsach');
		//
		Route::apiResource('bomon', 'BomonController')->only(['index','show']);
		//
		Route::apiResource('canbo', 'CanboController')->except(['index']);
		Route::get('canbo/bomon/{bomonid}', 'CanboController@index')->name('canbo.index');
		Route::get('dscanbo', function() { return view('admin.canbo.dscanbo'); })->name('canbo.danhsach');

		Route::apiResource('detai', 'DetaiController')->except(['index']);
		Route::get('detai/canbo/{canboid}', 'DetaiController@DetaiCanbo')->name('detai.DetaiCanbo');

		Route::apiResource('sinhvien', 'SinhvienController')->except(['index']); //tim hieu ve excel
		Route::post('sinhvien/import','SinhvienController@postImport')->name('sinhvien.import');
	});
});



// use App\Luanvan;
// Route::get('testDB2', function() {
//     return Luanvan::with('hoidong:id')->where('tinhtrang',0)->orderBy('detai_id')->get();
// });

// Route::get('testDB', function() {
// 	//danh sách các luận văn chưa có lịch	
// 	$luanvanId = Luanvan::pluck('id')->toArray();
// 	$dataRaw = array();
// 	foreach ($luanvanId as $stt=> $value) {
// 		$dataRaw[$value] = DB::table('hoidongluanvan')
// 		->where('luanvan_id',$value)
// 		->pluck('canbo_id')
// 		->toArray();
// 	}
// 	asort($dataRaw);
// 	$luanvanId = array_keys($dataRaw);
// 	$len = count($dataRaw)-3;
// 	return $dataRaw;
// 	$g= implode(",",$dataRaw[$luanvanId[0]]);
// 	$group[$g] = array($luanvanId[0]);
	
// 	for($i = 0; $i< $len; $i++)
// 	{
// 		$val = $dataRaw[$luanvanId[$i]];
// 		$valNext = $dataRaw[$luanvanId[$i+1]];

// 		$saiKhac = count(array_diff($val,$valNext));

// 		if($saiKhac == 0){
// 			array_push($group[$g], $luanvanId[$i+1]);
// 		}else{
// 			//nếu sai khác là 1
// 			//thêm key group tiếp theo vào nút phải của group trên group[$g]
// 			$g = implode(",",$dataRaw[$luanvanId[$i+1]]);
// 			//thêm key group trước vào nút trái của group[$g] vừa mới tạo 
// 			$group[$g] = array($luanvanId[$i+1]);
// 		}
// 	}
// 	return $group;
// });