<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sinhvien;
use Illuminate\Support\Facades\Auth;
use DB;

class BangdiemController extends Controller
{
    //giao diện upload bảng điểm
    public function viewUpload()
    {
    	$bangdiem = Sinhvien::find(Auth::user()->username)->bangdiem;
    	return view('admin.bangdiem.CapnhatBangdiem',compact('bangdiem'));
    }

    public function uploadBangdiem(Request $request)
    {
    	$idSV = Auth::user()->username;
    	if($request->hasFile('bangdiem'))
    	{
    		$file = $request->bangdiem;
    		$file->move('bangdiem',$idSV); //MSSV
    		DB::table('sinhvien')->where('id',$idSV)->update(['bangdiem' => $idSV]);
    		return redirect('bangdiem')->with('message', "Đã cập nhật bảng điểm");
    	}else{
    		return redirect('bangdiem')->with('message', "Cập nhật thất bại");
    	}
    }

    public function getBangdiem()
    {
    	return 0;
    }

}
