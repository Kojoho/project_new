<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Gate;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('is-librarian')) {
            // ทำงานเมื่อผู้ใช้เป็นบรรณารักษ์
            $books = Book::all();
            return view('librarian.dashboard', compact('books'));
        } else {
            // ทำงานเมื่อผู้ใช้ไม่ใช่บรรณารักษ์
            $books = Book::all();
            return view('dashboard', compact('books'));
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('librarian.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'category' => 'required',
            'coverImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $book = new Book();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->category = $request->category;

        if ($request->hasFile('coverImage')) {
            $image = $request->file('coverImage');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/books'), $imageName);
            $book->cover_image = 'images/books/' . $imageName;
        }



        $book->save();

        return response()->json(['message' => 'Book added successfully'], 200);
    }
    // BookController.php

    public function show($id)
    {
        $book = Book::findOrFail($id); // หาหนังสือที่มี ID ตามที่ระบุ

        return view('books.show', ['book' => $book]);
    }
    public function borrow(Request $request)
    {
        // Logic to handle borrowing the book
        // Example:
        $bookId = $request->input('book_id');
        $borrowDate = $request->input('borrow_date');
        $returnDate = $request->input('return_date');

        // Additional logic as needed

        // Redirect to the book list or wherever after borrowing
        return redirect()->route('book.list'); // Replace 'book.list' with your actual route name
    }
    
}
