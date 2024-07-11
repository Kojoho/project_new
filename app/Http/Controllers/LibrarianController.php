<?php

namespace App\Http\Controllers;

use App\Models\Librarian;
use Illuminate\Http\Request;
use App\Models\BorrowHistory;

class LibrarianController extends Controller
{
    public function index()
    {
        return view('librarian.dashboard');
    }
    public function borrowHistory()
{
    $borrowHistories = BorrowHistory::with('book')->get(); // ดึงข้อมูล BorrowHistory พร้อมข้อมูลของหนังสือ

    return view('librarian.borrow_history', [
        'borrowHistories' => $borrowHistories
    ]);
}
}
