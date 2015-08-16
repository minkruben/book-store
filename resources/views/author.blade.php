@extends('layouts.main')

@section('title', 'Author')

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
			<h3>{{ $author->name }}</h3>
			<span>{!! nl2br(e($author->description)) !!}</span>
			<h1 class="page-header">
	            <small>Books</small>
	        </h1>
	        @if ($books->count())
		        @foreach ($books as $book)
		        	<div class="row">
			        	<div class="container-fluid">
				        	<div class="col-xs-4 col-md-2">
				        		<a href="{{ route('book', $book->id) }}">
				        			<img src="{{ isset($book->image) ? asset('images/books/thumbnails/'.$book->image) : 'http://placehold.it/180x240?text='.$book->title }}" class="img-responsive center-block">
				        		</a>
				        	</div>
				        	<div class="col-xs-8 col-md-8">
				        		<div class="col-md-12">
				        			<div class="row book-link">
				        				<h4><a href="{{ route('book', $book->id) }}">{{ $book->title }}</a></h4>
				        			</div>
				        			<div class="book-detail">
				        				Published {{ Carbon\Carbon::parse($book->published_date)->format('Y') }}
				        			</div>
				        			<div class="book-detail">
				        				Publisher {{ $book->publisher }}
				        			</div>
				        		</div>
				        	</div>
				        	<div class="col-xs-8 col-md-2">
				        		<h4>${{ $book->price }}</h4>
								{!! Form::open(['route' => ['cart.add', $book->id]]) !!}
					    			<button type="submit" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Add to cart</button>
            					{!! Form::close() !!}
				        	</div>
				        </div>
				    </div>
				    <hr>
			    @endforeach
			    <div class="row text-center">
	    			{!! $books->render() !!}
	    		</div>
			@else
				<div class="row">
					<div class="col-md-12 text-center">
                		<h3><small>No Books found.</small></h3>
            		</div>
				</div>
			@endif
		</div>
	</div>
@stop
