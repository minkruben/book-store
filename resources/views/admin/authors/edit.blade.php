@extends('layouts.admin')

@section('title', 'Authors')

@section('content')
    <div class="row">
        <h1 class="page-header">
            <div class="btn-group pull-right">
                <a href="{{ route('admin.authors.index') }}" class="btn btn-default">Cancel</a>
            </div>
            Edit Author
        </h1>
    </div>
    @include('admin.alert')
    @include('errors.list')
    <div class="row">
        <div class="col-md-6">
            {!! Form::model($author, ['method' => 'patch', 'route' => ['admin.authors.update' , $author->id]]) !!}
                @include('admin.authors.form')
                <div class="form-group">
                    {!! Form::submit('Update', ['class' => 'btn btn-info'])!!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop
