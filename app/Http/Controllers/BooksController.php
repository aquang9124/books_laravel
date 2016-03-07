<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Author;
use App\Book;
use App\Review;
use App\Http\Requests;

class BooksController extends Controller
{	
	// This function loads the view for the add books/reviews/authors page
    public function add()
    {
    	// A collection of author records is sent to the view
    	$authors = Author::all();
    	return view('add', compact('authors'));
    }

    // This function is used to load the view for the book details page
    public function show(Book $book)
    {
    	// Three instances are sent to the view, one each containing data
    	// for the reviews, book, and author.
    	$author = Author::where('id', '=', $book->author_id)->first();
    	$reviews = Review::with('user')->where('book_id', '=', $book->id)->get();
    	return view('details', compact('book', 'author', 'reviews'));
    }

    // This function adds the new book and author
    public function store(Request $request)
    {
    	// Validation Check
    	$this->validate($request, [
    		'title' => 'required|max:255',
    		'author' => 'unique:authors',
    		'body' => 'required',
    	]);

    	// An instance of the authenticated user is created
    	$user = Auth::user();
    	// If the author_alt input field is blank, then this block of code runs
    	if (empty($request->author)):
    		if (is_null(Book::where('title', '=', $request->title)->first())):
    		$book = $user->books()->create([
		    			'title' => $request->title,
		    			'author_id' => $request->author_alt,
		    		]);
    		// We will retrieve the book instance right after it is put into the database
    		$user->reviews()->create([
    			'body' => $request->body,
    			'rating' => $request->rating,
    			'book_id' => $book->id,
    		]);
    		else:
    		$book = Book::where('title', '=', $request->title)->first();
    		$book->reviews()->create([
    			'body' => $request->body,
    			'rating' => $request->rating,
    			'user_id' => $user->id,
    		]);
    		// A new review is created
    		endif;
    	/*Else we run this block of code, first we create a new author with the author_alt
    	 set to the value of the author_alt input field. Next, we will retrieve the
    	 first record in the database where the author_alt is equal to author_alt. */
    	else:
    		Author::create([
    			'author' => $request->author,
    		]);
    		$author = Author::where('author', '=', $request->author)->first();
    		// Once we have the correct author instance, we will add the new book
    		if (is_null(Book::where('title', '=', $request->title)->first())):
    		$book = $user->books()->create([
		    			'title' => $request->title,
		    			'author_id' => $request->author_alt,
		    		]);
    		// We will retrieve the book instance right after it is put into the database
    		$user->reviews()->create([
    			'body' => $request->body,
    			'rating' => $request->rating,
    			'book_id' => $book->id,
    		]);
    		else:
    		$book = Book::where('title', '=', $request->title)->first();
    		$book->reviews()->create([
    			'body' => $request->body,
    			'rating' => $request->rating,
    			'user_id' => $user->id,
    		]);
    		// A new review is created
    		endif;
    	endif;
    	// Lastly we will return back to the previous page
    	return redirect()->route('book', [$book->id]);
    }
}
