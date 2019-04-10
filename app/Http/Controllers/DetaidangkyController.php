<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Sinhvien;
use App\detai;
use App\canbo;
use App\BoMon;
use App\NienKhoa;
use App\Thoigianhethong;
use App\Luanvan;
use Carbon\Carbon;
use DB;

//Dành cho sinh viên

class DetaidangkyController extends Controller
{
    public function DeTaiDaDangKy() //lay de tai da dang ky
    {
    	$idSV 	= Auth::user()->username;
    	$SV		= Sinhvien::find($idSV);
    	$DeTaiDaDangKy	= $SV->detai()->get(['detaidangky.id','detai_id','ten','xacnhan','created_at','updated_at']);
    	
        return response([
            'error' => 'false', 'message' => compact('DeTaiDaDangKy')
        ],200); 

    }

    public function DeTaiChuaDangKy($bomonid)
    {
        $lastNK = NienKhoa::max('id');
        $bomon = BoMon::find($bomonid);
        $dsBoMon = BoMon::all();
        //$luanvan = luanvan::find(Auth::user()->username);

        $idSV 	= Auth::user()->username;
    	$idDeTaiDaDangKy = Sinhvien::find($idSV)->detai->pluck('id')->toArray(); //id de tai sinh vien da dang ky
        $dsGVHD = DB::table('detai')->whereIn('id',$idDeTaiDaDangKy)->pluck('canbo_id');
    	$dsDetai = $bomon->detai()
                    ->whereNotIn('detai.id', $idDeTaiDaDangKy)
                    ->where('detai.nienkhoa_id',NienKhoa::max('id'))
                    ->with('canbo:id,ten,chucdanh')
                    //->whereNotIn('canbo_id',$dsGVHD)
                    ->get();
    	
        return response([
            'error' => 'false', 'message' => compact('dsBoMon','dsDetai')
        ],200);
    }

    public function DangKyDetaiView()
    {
        $luanvan = luanvan::find(Auth::user()->username);
        $thoigianDK = ThoiGianHeThong::find('svdangky');
        $bangdiem = Sinhvien::find(Auth::user()->username)->bangdiem;
        $allow = $luanvan === null && $bangdiem !== null;

        return view('admin.detaidangky.dsdetaichuadangky',compact('allow'));
    }


    public function store(Request $request) //sinh viên đăng ký một đề tài
    {
        $luanvan = luanvan::find(Auth::user()->username);
        
        $allow = $luanvan === null ;

        if($allow) //dc phep dang ky
        {
            $idSV   = Auth::user()->username;
            $SV     = Sinhvien::find($idSV);

            $detai = Detai::find($request->id);
            $detai->sinhvien()->attach($idSV);
            return "Đăng ký thành công";

        }
        else
        {
            return "Không được phép đăng ký";
        }
    }

    public function HuyDangKy($id) //Sinh vien huy dang ky
    {
        DB::table('detaidangky')->where('id',$id)->delete();
        return "Đã hủy đăng ký";
    }

    public function DeTaiSinhVienDangKy()//danh sach don dang ky
    {
        $idGV = Auth::user()->username;
        $GV = canbo::find($idGV);
        $dsDetai = DB::table('detai')
                    ->where('canbo_id',$idGV)
                    ->where('nienkhoa_id',NienKhoa::max('id'))
                    ->pluck('id');

        $dsDetaiDuocDangKy = DB::table('detaidangky')->whereIn('detai_id',$dsDetai)
                                ->join('detai','detai.id','detaidangky.detai_id')
                                ->join('sinhvien','sinhvien.id','detaidangky.sinhvien_id')
                                ->orderby('created_at')
                                ->get(['detaidangky.id','sinhvien.id as sv_id','sinhvien.ten as sv_ten','detai.id as detai_id','detai.ten','created_at','bangdiem','xacnhan']);

        return response([
            'error' => 'false', 'message' => compact('dsDetaiDuocDangKy')
        ],200);
    }

    public function Duyet(Request $request)
    {
        // Điều kiện
        //     Tổng số record xacnhan = '1' trong bảng detaidangky <= soluongsv trong bảng detai
        
        $svToiDa = detai::find($request->detai_id)->soluongsv;

        $countXacNhan = DB::table('detaidangky')
                        ->where('detai_id',$request->detai_id)
                        ->where('xacnhan','1')
                        ->count();

        //return $countXacNhan;
        
        // $SV = DB::table('detaidangky')
        //         ->where('sinhvien_id',$request->sinhvien_id)
        //         ->where('xacnhan','1')
        //         ->count();
                
        $detaidangky = DB::table('detaidangky')->where('id',$request->id);

        $check = $countXacNhan < $svToiDa+1;
        if($check){
            DB::table('detaidangky')
                ->where('id',$request->id)
                ->update(['xacnhan' => '1']);
            return "Đã duyệt đề tài";
        }else{
            return "Không thể duyệt";
        }
    }

    public function HoanTacDuyet($id)
    {
        DB::table('detaidangky')
                ->where('id',$id)
                ->update(['xacnhan' => '0']);
        return "Đã hoàn tác";
    }


}
