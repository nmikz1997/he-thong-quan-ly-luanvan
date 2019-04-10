<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\LuanVan;
use App\Sinhvien;
use App\detai;
use App\bomon;
use App\NienKhoa;
use DB;

class LuanvanController extends Controller
{
    public function GVview()
    {
        return view('admin.luanvan.dsluanvan');
    }

    public function index() //danh sách luận văn trong học kì theo giáo viên
    {
        $lastNK = NienKhoa::max('id');
        $dsdetai = detai::where('canbo_id',Auth::user()->username)->where('nienkhoa_id',$lastNK)->pluck('id');
        $dsluanvan = luanvan::whereIn('detai_id',$dsdetai)
                            ->join('detai','detai.id','luanvan.detai_id')
                            ->join('sinhvien','sinhvien.id','luanvan.id')
                            ->get(['luanvan.id as sinhvien_id','sinhvien.ten as sinhvien_ten','detai.ten as detai_ten']);
        return response([
            'error' => 'false', 'message' => compact('dsluanvan')
        ],200);
    }

    public function DangKyLuanVan(Request $request)
    {
        $idSV   = Auth::user()->username;
        $SV     = Sinhvien::find($idSV);      

        $luanvan = new Luanvan();
        $luanvan->id = $SV->id;
        $luanvan->detai_id = $request->id;

        $detai = Detai::find($luanvan->detai_id);
        $canbo = $detai->canbo()->first();

        DB::table('detaidangky')->where('sinhvien_id',$idSV)
                                ->update(['xacnhan' => '-1']);

        DB::table('detaidangky')->where('sinhvien_id',$idSV)
                                ->where('detai_id',$request->id)
                                ->update(['xacnhan' => '2']);

        $luanvan->save();

        DB::table('hoidongluanvan')->insert(
            [
                'canbo_id'  => $canbo->id,
                'luanvan_id'=> $luanvan->id,
                'vaitro'    => 3
            ]
        );

        return "Đăng ký thành công";
    }

}
