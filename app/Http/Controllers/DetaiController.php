<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Detai;
use App\NienKhoa;
use App\BoMon;
use App\canbo;
use App\ThoiGianHeThong;
use Illuminate\Support\Facades\Auth;

class DetaiController extends Controller
{

    public function index($bomonid)
    {
        $lastNK = NienKhoa::max('id');
        $bomon = BoMon::find($bomonid);
        $dsBoMon = BoMon::all();
        $dsDeTai = $bomon->detai()->where('nienkhoa_id',$lastNK)->with('canbo:id,ten,chucdanh')->get();
        
        return response([
            'error' => 'false', 'message' => compact('dsBoMon','dsDeTai')
        ], 200);
    }


    public function DetaiView(){
        $thoigianPost = ThoiGianHeThong::find('gvpost');
        $allow= now() >= $thoigianPost->thoigianmo && now() <= $thoigianPost->thoigiandong;
        return view('admin.detai.dsdetaigiaovien',compact('allow'));
    }


    public function DetaiGiaovien()
    {
        //ds de tai cua giao vien
        $lastNK = NienKhoa::max('id');
        if (in_array(Auth::user()->level,[1,2]))
        {
            $canbo = canbo::find(Auth::user()->username);
            $dsDetai = $canbo->detai()->where('nienkhoa_id',$lastNK)->get(['id','ten','mota','soluongsv']);
            return response([
                'error' => 'false', 'message' => compact('canbo','dsDetai')
            ], 200);
        }
        else
        {
            return "không có quyền";
        }
        
    }


    public function store(Request $request)
    {
        if (in_array(Auth::user()->level,[1,2]))
        {
            $lastNK = NienKhoa::max('id');
            $detai = new Detai();
            $detai->ten = $request->ten;
            $detai->canbo_id = Auth::user()->username;
            $detai->mota = $request->mota;
            $detai->soluongsv = $request->soluongsv;
            $detai->nienkhoa_id = $lastNK;
            $detai->save();
            return "Thêm thành công";
        }
        else
        {
            return "bạn không có quyền";
        }
    }

    public function show($id)
    {
        $detai = Detai::findOrFail($id);
        if (Auth::user()->username === $detai->canbo_id)
        {
            return $detai;
        }
        else
        {
            return "không có quyền";
        }
    }

    public function update(Request $request, $id)
    {
        $detai = Detai::findOrFail($id);
        if (Auth::user()->username === $detai->canbo_id)
        {
            $detai->ten = $request->ten;
            $detai->mota = $request->mota;
            $detai->soluongsv = $request->soluongsv;
            $detai->save();
            return "Đã sửa thông tin đề tài";
        }
        else
        {
            return "không có quyền";
        }
    }


    public function destroy($id)
    {
        $detai = Detai::findOrFail($id);
        if (Auth::user()->username === $detai->canbo_id)
        {
            $detai = Detai::findOrFail($id);
            $detai->delete();
            return "Đã xóa đề tài";
        }
        else
        {
            return "không có quyền";
        }
    }
}
