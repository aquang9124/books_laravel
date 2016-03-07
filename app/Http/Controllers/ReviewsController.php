<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Review;
use App\Book;
use App\Http\Requests;

class ReviewsController extends Controller
{
    public function delete(Review $review)
    {
    	$review->delete();
    	return back();
    }

    public function store(Request $request, Book $book)
    {
    	$this->validate($request, [
    		'body' => 'required',
    	]);

    	$user = Auth::user();
    	$book->reviews()->create([
    		'body' => $request->body,
    		'rating' => $request->rating,
    		'user_id' => $user->id,
    	]);

    	return back();
    }
}
