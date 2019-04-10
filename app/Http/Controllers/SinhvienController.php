<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NienKhoa;
use App\SinhVien;
use App\BoMon;

use App\Imports\SinhVienImport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class SinhvienController extends Controller
{
    
    public function index($bomonid)
    {
        $lastNK = NienKhoa::max('id');
        $dsBoMon = BoMon::all()->toJson();
        $bomon = BoMon::find($bomonid);
        $dsSinhVien = $bomon->sinhvien()->where('nienkhoa_id',$lastNK)->get(['id','ten','gioitinh','khoa','email','SDT','bangdiem'])->toJson();

        return response([
            'error' => 'false', 'message' => compact('dsBoMon','dsSinhVien')
        ],200);

    }

    public function postImport()
    {
        Excel::import(new SinhVienImport,request()->file('file'));
        Excel::import(new UsersImport,request()->file('file'));
        return back()->with('message','Đã thêm sinh viên');
    }

    public function diemTrungBinh($bomon_id)
    {
        $lastNK = NienKhoa::max('id');
        $dsBoMon = BoMon::all()->toJson();

        $dsDiemSV = DB::table('sinhvien')
            ->join('hoidongluanvan','sinhvien.id','hoidongluanvan.luanvan_id')
            ->join('luanvan','sinhvien.id','luanvan.id')
            ->join('detai','detai.id','luanvan.detai_id')
            ->whereNotNull('luanvan_id')
            ->where('sinhvien.nienkhoa_id',$lastNK)
            ->where('sinhvien.bomon_id',$bomon_id)
            ->select(
                'hoidongluanvan.luanvan_id','hoidongluanvan.diem',
                'sinhvien.ten as sv_ten','sinhvien.bomon_id','sinhvien.nienkhoa_id','sinhvien.khoa',
                'detai.ten as detai_ten',
                DB::raw('count(diem) as slChamDiem'),
                DB::raw('avg(diem) as DTB')
                )
            ->groupBy('luanvan_id','diem','sv_ten','bomon_id','nienkhoa_id','khoa','detai_ten')
            ->having('slChamDiem','=','3')
            ->get()
            ->toJson();
        return response([
            'error' => 'false', 'message' => compact('dsBoMon','dsDiemSV')
        ],200);
    }

    public function viewDTB()
    {
        return view('admin.luanvan.dsdiem');
    }


}
