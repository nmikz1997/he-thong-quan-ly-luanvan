<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ThoiGianHeThong;
use Carbon\Carbon;


class ThoigianhethongController extends Controller
{

    public function index()
    {
        $dsTGHT = thoigianhethong::all();
        $jsonTGHT = json_encode($dsTGHT);
        return response([
            'error' => 'false', 'message' => compact('jsonTGHT')
        ],200);
    }


    public function show($id)
    {
        return thoigianhethong::findOrFail($id);
    }


    public function update(Request $request, $id)
    {
        $carbon1 = new Carbon(substr($request->thoigianmo, 0, -9));
        $carbon2 = new Carbon(substr($request->thoigiandong, 0, -9));

        $tght = thoigianhethong::findOrFail($id);
        $tght->thoigianmo = $carbon1->format('Y-m-d');
        $tght->thoigiandong = $carbon2->format('Y-m-d');
        $tght->save();

        return "Sửa thành công";
    }

}
