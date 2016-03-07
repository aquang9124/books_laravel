@extends('layouts.app')

@section('externals')
<link rel="stylesheet" href="/css/app2.css">
@endsection

@section('content')
<div class="wrapper">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-info panel-overrides">
				<div class="panel-heading">
					<h3 class="text-center">{{ $book->title }}</h3>
					<p class="text-center"><small>By {{ $author->author }}</small></p>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-6 text-center">
							<h3>Reviews:</h3>
							@foreach ($reviews as $review)
							<hr>
							<p>Rating: {{$review->rating}} star(s)</p>
							<p><a href="{{ url('/pages/profile', [$review->user->id]) }}">{{ $review->user->name }}</a> says: {{ $review->body }}</p>
							<p><small>{{ $review->created_at }}</small></p>
							@if (Auth::id() == $review->user->id)
							<form action="{{ url('/reviews/delete', [$review->id]) }}" method="post" role="form">
								{!! csrf_field() !!}
								{!! method_field('DELETE') !!}
								<button class="btn btn-danger">Delete</button>
							</form>
							@endif
							@endforeach
						</div>
						<div class="col-md-6 text-center">
							<h3>Add a Review:</h3>
							<form action="{{ url('/reviews/store', [$book->id]) }}" method="post" role="form">
								{!! csrf_field() !!}
								<div class="form-group">
									<textarea class="form-control" name="body" rows="10"></textarea>
								</div>
								<div class="form-group">
									<label>Rating: </label>
									<select name="rating" class="form-control">
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
									</select>
								</div>
								<div class="form-group">
									<button class="btn btn-success">Add Review</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection