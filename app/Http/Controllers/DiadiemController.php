<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use App\DiaDiem;
use DB;

class DiadiemController extends Controller
{
    public function index()
    {
        $dsDiaDiem = diadiem::all();
        return Response::json(array('jsonDiaDiem'=>$dsDiaDiem));
    }

    public function store(Request $request)
    {

        $diadiem = new DiaDiem();
        $diadiem->id = $request->id;
        $diadiem->ten = $request->ten;
        $diadiem->save();

        $dsLichRaw = DB::table('diadiem')->where('diadiem.id','=',$diadiem->id)->crossJoin('ngay')->crossJoin('gio')->select('ngay.ngay as ngay_id', 'diadiem.id as diadiem_id','gio.id as gio_id')->get()->toArray();

        $data = array();
        foreach ($dsLichRaw as $lich) {
            $data[] = (array)$lich;
        }
        DB::table('lichbaove')->insert($data);

        return "Thêm thành công";
    }

    public function show($id)
    {
        return DiaDiem::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $diadiem = DiaDiem::findOrFail($id);
        $diadiem->ten = $request->ten;
        $diadiem->save();
        return "Sửa thành công";
    }


    public function destroy($id)
    {
        $diadiem = DiaDiem::findOrFail($id);
        $diadiem->delete();
        return "Xóa thành công";
    }
}
