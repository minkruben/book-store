@extends('layouts.main')

@section('title', 'Book')

@section('content')
	<div class="row">
		<div class="col-md-3">
			<div class="well sidebar-nav">
				<ul class="nav nav-list">
					<li class="nav-header">Categories</li>
					@foreach ($categories as $category)
						<li><a href="{{ route('category', $category->id) }}">{{ $category->name }}</a></li>
					@endforeach
				</ul>
			</div>
		</div>
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-3 text-center">
						<img src="{{ isset($book->image) ? asset('images/books/thumbnails/'.$book->image) : 'http://placehold.it/180x240?text='.$book->title }}" class="img-responsive center-block" data-toggle="modal" data-target=".enlarge">
					@if (isset($book->image))
						<div class="modal fade enlarge" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
						    		<div class="modal-body">
						        		<img src="{{ asset('images/books/'.$book->image) }}" class="img-responsive">
						    		</div>
								</div>
							</div>
						</div>
					@endif
					<h4>${{ $book->price }}</h4>
					{!! Form::open(['route' => ['cart.add', $book->id]]) !!}
					    <button type="submit" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Add to cart</button>
            		{!! Form::close() !!}
				</div>
				<div class="col-md-9">
					<div class="container-fluid">
						<h3>{{ $book->title }}</h3>
						<div class="authors">
							by
							@foreach ($book->authors()->get() as $key => $author)
								<span><a href="{{ route('author', $author->id) }}">{{ $author->name }}</a></span>
							@endforeach
						</div>
						<span>{!! nl2br(e($book->description)) !!}</span>
						<hr>
						<div class="row book-detail">
							<div class="col-xs-6 col-md-3">ISBN</div>
							<div class="col-xs-6 col-md-6">{{ $book->isbn }}</div>
						</div>
						<div class="row book-detail">
							<div class="col-xs-6 col-md-3">Publisher</div>
							<div class="col-xs-6 col-md-6">{{ $book->publisher }}</div>
						</div>
						<div class="row book-detail">
							<div class="col-xs-6 col-md-3">Published Date</div>
							<div class="col-xs-6 col-md-6">{{ Carbon\Carbon::parse($book->published_date)->format('d/m/Y') }}</div>
						</div>
						<div class="row book-detail">
							<div class="col-xs-6 col-md-3">Pages</div>
							<div class="col-xs-6 col-md-6">{{ $book->pages }}</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop
