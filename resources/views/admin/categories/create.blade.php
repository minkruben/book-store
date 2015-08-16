@extends('layouts.admin')

@section('title', 'Categories')

@section('content')
    <div class="row">
        <h1 class="page-header">
            <div class="btn-group pull-right">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-default">Cancel</a>
            </div>
            New Category
        </h1>
    </div>
    @include('errors.list')
    <div class="row">
        <div class="col-md-6">
            {!! Form::open(['route' => 'admin.categories.store']) !!}
                @include('admin.categories.form')
                <div class="form-group">
                    {!! Form::submit('Add', ['class' => 'btn btn-success'])!!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop
