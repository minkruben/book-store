@extends('layouts.main')

@if (isset($query))
	@section('title', 'Search')
@elseif (isset($name))
	@section('title', 'Category')
@else
	@section('title', 'Home')
@endif

@section('navbar')
	<li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            Categories <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            @foreach ($categories as $category)
                <li>
                    <a href="{{ route('category', $category->id) }}">{{ $category->name }}</a>
                </li>
            @endforeach
        </ul>
    </li>
@stop

@section('content')
	@if (isset($query))
		<div class="clearfix">
			<div class="col-md-12">
				<h1 class="page-header">
	            	<small>Search results for “{{ $query }}”</small>
	        	</h1>
			</div>
	    </div>
	@elseif (isset($name))
		<div class="clearfix">
			<div class="col-md-12">
				<h1 class="page-header">
	            	<small>{{ $name }} Category</small>
	        	</h1>
			</div>
	    </div>
	@endif
	@if ($books->count())
		<div class="clearfix bookshelf">
			@for ($i = $books->count(); $i > 0; $i -= 6)
				@foreach ($books->splice(0, 2)->all() as $book)
			        <div class="col-xs-6 col-md-2">
			        	<div class="book">
			        		<img src="{{ isset($book->image) ? asset('images/books/thumbnails/'.$book->image) : 'http://placehold.it/180x240?text='.$book->title }}" class="img-responsive">
			        		<div class="description">
			        			<h4>${{ $book->price }}</h4>
				            	<p>{{ $book->title }}</p>
				            	<div class="link">
				            		<a href="{{ route('book', $book->id) }}" class="btn btn-default"><i class="fa fa-eye"></i></a>
						            {!! Form::open(['route' => ['cart.add', $book->id]]) !!}
						            	<button type="submit" class="btn btn-default"><i class="fa fa-shopping-cart"></i></button>
	            					{!! Form::close() !!}
	            				</div>
			        		</div>
			        	</div>
			        </div>
		        @endforeach
		        <div class="col-xs-12 shelf hidden-md hidden-lg"></div>
		        @if ($i-2 > 0)
				    @foreach ($books->splice(0, 2)->all() as $book)
				        <div class="col-xs-6 col-md-2">
				        	<div class="book">
				        		<img src="{{ isset($book->image) ? asset('images/books/thumbnails/'.$book->image) : 'http://placehold.it/180x240?text='.$book->title }}" class="img-responsive">
				        		<div class="description">
				        			<h4>${{ $book->price }}</h4>
					            	<p>{{ $book->title }}</p>
					            	<div class="link">
					            		<a href="{{ route('book', $book->id) }}" class="btn btn-default"><i class="fa fa-eye"></i></a>
						            	{!! Form::open(['route' => ['cart.add', $book->id]]) !!}
						            		<button type="submit" class="btn btn-default"><i class="fa fa-shopping-cart"></i></button>
	            						{!! Form::close() !!}
	            					</div>
	            				</div>
				        	</div>
				        </div>
			        @endforeach
			        <div class="col-xs-12 shelf hidden-md hidden-lg"></div>
				    @foreach ($books->splice(0, 2)->all() as $book)
				        <div class="col-xs-6 col-md-2">
				        	<div class="book">
				        		<img src="{{ isset($book->image) ? asset('images/books/thumbnails/'.$book->image) : 'http://placehold.it/180x240?text='.$book->title }}" class="img-responsive">
				        		<div class="description">
				        			<h4>${{ $book->price }}</h4>
					            	<p>{{ $book->title }}</p>
					            	<div class="link">
					            		<a href="{{ route('book', $book->id) }}" class="btn btn-default"><i class="fa fa-eye"></i></a>
							            {!! Form::open(['route' => ['cart.add', $book->id]]) !!}
							            	<button type="submit" class="btn btn-default"><i class="fa fa-shopping-cart"></i></button>
		            					{!! Form::close() !!}
		            				</div>
				        		</div>
				        	</div>
				        </div>
			        @endforeach
		        @endif
			    <div class="col-xs-12 shelf{{ ($i-4 <= 0) ? ' empty' : '' }}"></div>
	        @endfor
	    </div>
	    <div class="clearfix text-center">
	    	{!! $books->render() !!}
	    </div>
    @else
        <div class="clearfix">
            <div class="col-md-12 text-center">
                <h3><small>No Books found.</small></h3>
            </div>
        </div>
    @endif
@stop
