<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class giaovien
{
    public function handle($request, Closure $next)
    {
        if(Auth::user()->level > 0){
            return $next($request);
        }else{
            return redirect('/login');
        }
    }
}
