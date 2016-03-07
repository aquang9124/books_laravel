@extends('layouts.app')
@section('externals')
<link rel="stylesheet" href="/css/app.css">
@endsection
@section('content')
<div class="wrapper">
    <div class="grid-row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-info panel-overrides">
                <div class="panel-heading text-center">
                    <p>Welcome {{ Auth::user()->username }}!</p>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <h2>Recent Book Reviews:</h2>
                            @foreach ($reviews as $review)
                            <a href="{{ url('books/show', [$review->book->id]) }}" class="book-title">{{ $review->book->title }}</a>
                            <p>Rating: {{ $review->rating }} star(s)</p>
                            <p><a href="">{{ $review->user->name }}</a> says: {{ $review->body }}</p>
                            <p><small>Posted on {{ $review->created_at }}</small></p>
                            @endforeach
                        </div>
                        <div class="col-md-6">
                            <h2 class="text-center">Other Books with Reviews:</h2>
                            <section id="books-wrapper">
                                @foreach ($books as $book)
                                <a href="{{ url('books/show', [$book->id]) }}" class="book-title">{{ $book->title }}</a>
                                @endforeach
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
