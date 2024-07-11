<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Librarian;
use App\Models\Member;
use App\Models\Book;
use App\Models\Borrowing;

class HomeController extends Controller
{
    public function index()
    {
        $librarians = Librarian::all();
        $members = Member::all();
        $books = Book::all();
        $borrowings = Borrowing::all();

        return view('admin/dashboard', compact('librarians', 'members', 'books', 'borrowings'));
    }
}