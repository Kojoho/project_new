<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;

class AdminDashboardController extends Controller
{
    public function index()
    {   
        $userLogs = Log::where('user_type', 'user')
                        ->orderBy('created_at', 'desc')
                        ->get();
        return view('admin.dashboard', compact('userLogs'));
    }
    public function userLogs()
    {
        $userLogs = Log::where('user_type', 'user')
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('admin.user_logs', compact('userLogs'));
    }
    
}
