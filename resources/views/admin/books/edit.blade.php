@extends('layouts.admin')

@section('title', 'Books')

@section('styles')
    <!-- Select2 CSS -->
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">

    <!-- File Input CSS -->
    <link href="{{ asset('css/fileinput.min.css') }}" rel="stylesheet">
@stop

@section('content')
    <div class="row">
        <h1 class="page-header">
            <div class="btn-group pull-right">
                <a href="{{ route('admin.books.index') }}" class="btn btn-default">Cancel</a>
            </div>
            Edit Book
        </h1>
    </div>
    @include('admin.alert')
    @include('errors.list')
    <div class="row">
        <div class="col-xs-12 col-md-6 text-center pull-right book-image">
            <img src="{{ isset($book->image) ? asset('images/books/thumbnails/'.$book->image) : 'http://placehold.it/180x240?text='.$book->title }}">
        </div>
        <div class="col-md-6 pull-left">
            {!! Form::model($book, ['method' => 'patch', 'route' => ['admin.books.update' , $book->id], 'files' => true]) !!}
                @include('admin.books.form')
                <div class="form-group">
                    {!! Form::submit('Update', ['class' => 'btn btn-info'])!!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('scripts')
    <!-- Select2 JavaScript -->
    <script src="{{ asset('js/select2.min.js') }}"></script>

    <!-- File Input JavaScript -->
    <script src="{{ asset('js/fileinput.min.js') }}"></script>

    <script>$('select[multiple]').select2();</script>
@stop
