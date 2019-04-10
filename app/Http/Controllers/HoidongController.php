<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Nienkhoa;
use App\Luanvan;
use App\Bomon;
use App\Canbo;
use App\Detai;
use App\Sinhvien;
use DB;

class HoidongController extends Controller
{
    public function view()
    {
    	return view('admin.hoidong.dsHoidong');
    }

    public function index($bomon_id)
    {
    	$dsBoMon = BoMon::all();
        if(Auth::user()->level == 3){
            $dsCanBo = Canbo::where('bomon_id',$bomon_id)->get();
            $bomon = Bomon::find($bomon_id);
        }else{
            $canbo = Canbo::find(Auth::user()->username);
            $bomon = BoMon::find($canbo->bomon_id);
            $dsCanBo = Canbo::where('bomon_id',$canbo->bomon_id)->get();
        }

        $sinhvienIDs = Sinhvien::where('nienkhoa_id', NienKhoa::max('id') )->pluck('id');

        $detaiID = $bomon->detai()->pluck('detai.id');
        
        $dsHoidong = luanvan::whereIn('id',$sinhvienIDs)
                        ->whereIn('detai_id',$detaiID)
                        ->with('hoidong:id,ten,chucdanh,chucvu')
                        ->with('detai:id,ten,canbo_id')->get();

        return response([
            'error' => 'false', 'message' => compact('dsCanBo','dsBoMon','dsHoidong')
        ], 200);

    }

    public function store(Request $request)
    {
        $uyvien = $request->uyvien;
        $chutich = $request->chutich;
        $thuky = DB::table('hoidongluanvan')
                    ->where('luanvan_id',$request->idLuanvan)
                    ->where('vaitro',3)
                    ->first();
        
        $luanvan = luanvan::find($request->idLuanvan);

        $luanvan->hoidong()->sync([
            $thuky->canbo_id  => ['vaitro' => 3],
            $uyvien => ['vaitro' => 2],
            $chutich=> ['vaitro' => 1]
        ]);

        return "Cập nhật thành công";
    }

    public function viewLuanVanHoiDong()
    {
        return view('admin.hoidong.dsHoidongThamgia');
    }

    public function dsLuanVanHoiDong()
    {
        $luanvan = DB::table('hoidongluanvan')
                    ->orderBy('ngay_id')
                    ->orderBy('diadiem_id')
                    ->orderBy('gio_id')
                    ->where('hoidongluanvan.canbo_id',Auth::user()->username)
                    ->join('luanvan','luanvan.id','hoidongluanvan.luanvan_id')
                    ->join('sinhvien','sinhvien.id','luanvan.id')
                    ->join('detai','detai.id','luanvan.detai_id')
                    ->where('sinhvien.nienkhoa_id',Nienkhoa::max('id'))
                    ->get(['luanvan_id','sinhvien.ten as sinhvien_ten','detai.ten as detai_ten','vaitro','diem','gio_id','ngay_id','diadiem_id']);
        return response([
            'error' => 'false', 'message' => compact('luanvan')
        ], 200);
    }

    public function showLuanVan($id)
    {
        $LVCanTim = DB::table('hoidongluanvan')
                    ->where('hoidongluanvan.canbo_id',Auth::user()->username)
                    ->where('hoidongluanvan.luanvan_id',$id)
                    ->join('luanvan','luanvan.id','hoidongluanvan.luanvan_id')
                    ->join('sinhvien','sinhvien.id','luanvan.id')
                    ->join('detai','detai.id','luanvan.detai_id')
                    ->where('sinhvien.nienkhoa_id',Nienkhoa::max('id'))
                    ->get(['luanvan_id','sinhvien.ten as sinhvien_ten','detai.ten as detai_ten','vaitro','diem']);
        return $LVCanTim;
    }

    public function chamDiem(Request $request, $id)
    {
        $diem = (float)$request->diem;

        DB::table('hoidongluanvan')
            ->where('canbo_id', Auth::user()->username)
            ->where('luanvan_id',$id)
            ->update(['diem'=>$diem]);

        return "Đã cập nhật điểm số";
    }

    public function viewDiem()
    {
        return view('admin.luanvan.diemluanvan');
    }

    public function hienthiDiem()
    {
        $luanvan = luanvan::find(Auth::user()->username);
        $danhgiaLuanvan = $luanvan->hoidong()
                            ->get(['ten','chucdanh','vaitro','diem','ngay_id','gio_id','diadiem_id']);
        return $danhgiaLuanvan;
    }

    

}
