<?php

namespace App\Http\Controllers;

use App\Book;
use App\Review;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Review::with('book', 'user')->limit(3)->get();
        $books = Book::all();
        return view('home', compact('reviews', 'books'));
    }
}
