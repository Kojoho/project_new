<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class User
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();

            // ไม่ให้ librarian เข้าถึงหน้า Dashboard ของผู้ใช้ทั่วไป
            if ($user->usertype == "librarian" && $request->is('dashboard')) {
                return redirect('librarian/dashboard');
            }
        }

        return $next($request);
    }
}