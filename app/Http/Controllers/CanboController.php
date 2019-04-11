<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Canbo;

class CanboController extends Controller
{


    public function index($bomonid)
    {

        $dsCanBo = Canbo::where('bomon_id','=',$bomonid)->get();
        $jsonCanBo = json_encode($dsCanBo);
        
        return response([
            'error' => 'false', 'message' => compact('jsonCanBo')
        ],200);
    }


    public function store(Request $request)
    {
        $canbo = new CanBo();
        $user = new User();
        
        $canbo->id = $request->id;
        $canbo->ten = $request->ten;
        $canbo->chucdanh = $request->chucdanh;
        $canbo->chucvu = $request->chucvu;
        $canbo->email = $request->email;
        $canbo->sdt = $request->sdt;
        //$request->chucvu == 'TK' ? $canbo->quyen = '2' : $canbo->quyen = '3';
        
        $canbo->bomon_id = $request->bomon_id;

        $user->username = $request->id;
        $user->password = bcrypt($request->password);
        $request->chucvu == 'TK' ? $user->level = 2 : $user->level = 1;

        $canbo->save();
        $user->save();

        return "Thêm thành công";
    }

    public function show($id)
    {
        return Canbo::findOrFail($id);
    }


    public function update(Request $request, $id)
    {
        $canbo = Canbo::findOrFail($id);
        $canbo->id = $request->id;
        $canbo->ten = $request->ten;
        $canbo->chucdanh = $request->chucdanh;
        $canbo->chucvu = $request->chucvu;
        $canbo->email = $request->email;
        $canbo->sdt = $request->sdt;
        $request->chucvu == 'TK' ? $canbo->quyen = '2' : $canbo->quyen = '3';
        $canbo->bomon_id = $request->bomon_id;
        $canbo->save();
        return "Sửa thành công";
    }


    public function destroy($id)
    {
        $canbo = Canbo::findOrFail($id);
        $canbo->delete();
        return "Đã xóa cán bộ";
    }
}
