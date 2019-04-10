<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ngay;
use App\NienKhoa;

class NgayController extends Controller
{
    public function index()
    {
        return Nienkhoa::orderBy('id', 'DESC')->first(['id'])->Ngay->toJson();
    }

    public function store(Request $request)
    {
        $lastNK = NienKhoa::orderBy('id', 'DESC')->first();
        $ngay   = new Ngay();
        return "Thêm thành công";
    }

    public function show($id)
    {
        return $ngay = Ngay::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        $ngay = Ngay::findOrFail($id);
        $ngay->delete();
    }
}
