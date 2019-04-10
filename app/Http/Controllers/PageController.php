<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thoigianhethong;

class PageController extends Controller
{
    public function trangChu()
    {
    	$TGSV = Thoigianhethong::find('svdangky');
    	$TGGV = Thoigianhethong::find('gvpost');

    	$studentAllow = now() >= $TGSV->thoigianmo && now() <= $TGSV->thoigiandong;
    	$teacherAllow = now() >= $TGGV->thoigianmo && now() <= $TGGV->thoigiandong;
    	return view('admin-layout.part.sidebar')->with('studentAllow','ádasd');
    }
}
