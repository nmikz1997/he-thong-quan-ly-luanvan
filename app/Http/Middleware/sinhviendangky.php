<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;
use App\ThoiGianHeThong;


class sinhviendangky
{
    public function handle($request, Closure $next)
    {
        $thoigianDK = ThoiGianHeThong::find('svdangky');
        $studentAllow = now() >= $thoigianDK->thoigianmo && now() <= $thoigianDK->thoigiandong;
        if ($studentAllow) {
            return $next($request);
        }
        return back()->with('message', "Chưa đến thời gian đăng ký");
    }
}
