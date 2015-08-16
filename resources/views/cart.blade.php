@extends('layouts.main')

@section('title', 'Cart')

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
	<div class="clearfix">
		<div class="col-xs-6 col-md-9">
			<strong>Book</strong>
		</div>
		<div class="col-xs-2 col-md-1">
			<strong>Qty</strong>
		</div>
		<div class="col-xs-2 col-md-1">
			<strong>Price</strong>
		</div>
		<div class="col-xs-2 col-md-1">
			<strong>Subtotal</strong>
		</div>
	</div>
	<hr>
	@foreach (Cart::content() as $book)
		<div class="clearfix">
			<div class="col-xs-12 col-md-1">
				<img src="{{ is_null($book->options->image) ? 'http://placehold.it/180x240?text='.$book->name : asset('images/books/thumbnails/'.$book->options->image) }}" class="img-responsive center-block">
			</div>
			<div class="col-xs-12 col-md-8">
				<h4>{{ $book->name }}</h4>
			</div>
			<div class="col-xs-4 col-md-1">
				<input type="text" class="form-control" value="{{ $book->qty }}">
			</div>
			<div class="col-xs-4 col-md-1">
				${{ $book->price }}
			</div>
			<div class="col-xs-4 col-md-1">
				${{ $book->subtotal }}
			</div>
		</div>
		<hr>
	@endforeach
	<div class="clearfix">
		<div class="col-xs-8 col-md-11"></div>
		<div class="col-xs-4 col-md-1">
			<strong>${{ Cart::total() }}</strong>
		</div>
	</div>
	<div class="clearfix checkout">
		<a href="#" class="btn btn-success pull-right">Checkout</a>
	</div>
@stop
