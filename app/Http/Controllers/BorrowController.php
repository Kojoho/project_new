<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BorrowHistory;

class BorrowController extends Controller
{
    // ฟังก์ชันเพิ่มประวัติการยืมหนังสือใหม่
    public function store(Request $request)
    {
        $borrow = new BorrowHistory();
        $borrow->book_id = $request->book_id;
        $borrow->borrow_date = now();
        $borrow->save();
        
        return redirect()->route('borrow.history');
    }
    
    // ฟังก์ชันคืนหนังสือ
    public function returnBook($id)
    {
        $borrowHistory = BorrowHistory::find($id);

        if (!$borrowHistory) {
            return back()->with('error', 'ไม่พบประวัติการยืมนี้');
        }

        if ($borrowHistory->return_date) {
            return back()->with('error', 'หนังสือนี้ได้ถูกคืนแล้ว');
        }

        // อัปเดตฐานข้อมูล
        $borrowHistory->return_date = now();
        $borrowHistory->status = 'returned';
        $borrowHistory->save();

        return redirect()->route('borrow.history')->with('success', 'คืนหนังสือเรียบร้อยแล้ว');
    }
    
    // ฟังก์ชันแสดงประวัติการยืมหนังสือทั้งหมด
    public function history()
    {
        $borrowHistory = BorrowHistory::with('book')->get();
        return view('borrow.history', ['borrowHistory' => $borrowHistory]);
    }
}
