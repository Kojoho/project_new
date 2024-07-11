<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    public function handle(Request $request, Closure $next)
    {
        // ตรวจสอบว่ามีการเข้าสู่ระบบหรือไม่
        if (Auth::check()) {
            $user = Auth::user();

            // ถ้าเป็น librarian ให้ redirect ไปที่ librarian dashboard แทนการเข้าถึงหน้า admin
            if ($user->usertype == "librarian" && $request->is('admin*')) {
                return redirect()->route('librarian.dashboard');
            }

            // ถ้าเป็น user ให้ redirect ไปที่ user dashboard แทนการเข้าถึงหน้า admin
            if ($user->usertype == "user" && $request->is('admin*')) {
                return redirect()->route('dashboard');
            }

            // ถ้าเป็น admin ให้ผ่านไปต่อ
            if ($user->usertype == "admin") {
                return $next($request);
            }
        }

        // ถ้าไม่ใช่ admin, librarian หรือ user ให้ redirect ไปที่หน้า login
        return redirect()->route('login');
    }
}
