<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NienKhoa;

class NienkhoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $dsNienKhoa = nienkhoa::orderBy('id', 'DESC')->get();
        $jsonNienKhoa = json_encode($dsNienKhoa);
        return response([
            'error' => 'false', 'message' => compact('jsonNienKhoa')
        ],200);
    }

    public function store(Request $request)
    {
        $nienkhoa = new nienkhoa();
        $nienkhoa->nambatdau = $request->nambatdau;
        $nienkhoa->hocki = $request->hocki;
        $nienkhoa->save();
        return "thêm thành công";
    }

    public function show($id)
    {
        return nienkhoa::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $nienkhoa = nienkhoa::findOrFail($id);
        $nienkhoa->nambatdau = $request->nambatdau;
        $nienkhoa->hocki = $request->hocki;
        $nienkhoa->save();
        return "Sửa thành công";
    }

    public function destroy($id)
    {
        $nienkhoa = nienkhoa::findOrFail($id);
        $nienkhoa->delete();
        return "Xóa thành công";
    }
}
