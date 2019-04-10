<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\ThoiGianHeThong;

class giaovienpost
{

    public function handle($request, Closure $next)
    {
        $thoigianPOST = ThoiGianHeThong::find('gvpost');
        $teacherAllow = now() >= $thoigianPOST->thoigianmo && now() <= $thoigianPOST->thoigiandong;
        if ($teacherAllow) {
            return $next($request);
        }
        return back()->with('message', "Chưa đến thời gian đăng đề tài");
    }
}
