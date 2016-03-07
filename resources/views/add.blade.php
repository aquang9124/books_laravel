@extends('layouts.app')
@section('externals')
<link rel="stylesheet" href="/css/app2.css">
@endsection
@section('content')
<div class="wrapper">
	<div class="grid-row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-info panel-overrides">
				<div class="panel-heading">
					<h3 class="text-center">Add a new Book Title and a Review:</h3>
				</div>
				<div class="panel-body">
					<form action="{{ url('/books/store') }}" method="post" role="form" class="form-horizontal">
						{!! csrf_field() !!}
						<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
							<label class="control-label col-md-4">Book Title:</label>
							<div class="col-md-6">
								<input class="form-control" type="text" name="title" value="{{ old('title') }}">

								@if ($errors->has('title'))
								<span class="help-block">
									<strong>{{ $errors->first('title') }}</strong>
								</span>
								@endif
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-4">Choose Author From List:</label>
							<div class="col-md-6">
								<select name="author_alt" class="form-control">
									@foreach ($authors as $author)
									<option value="{{ $author->id }}">{{ $author->author }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group{{ $errors->has('author') ? ' has-error' : '' }}">
							<label class="control-label col-md-4">Add a new Author:</label>
							<div class="col-md-6">
								<input class="form-control" type="text" name="author">

								@if ($errors->has('author'))
								<span class="help-block">
									<strong>{{ $errors->first('author') }}</strong>
								</span>
								@endif
							</div>
						</div>
						<div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
							<label class="control-label col-md-4">Review:</label>
							<div class="col-md-6">
								<textarea name="body" class="form-control" rows="10"></textarea>

								@if ($errors->has('body'))
								<span class="help-block">
									<strong>{{ $errors->first('body') }}</strong>
								</span>
								@endif
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-4">Rating:</label>
							<div class="col-md-6">
								<select name="rating" class="form-control">
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button class="btn btn-primary">Add Book and Review</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection