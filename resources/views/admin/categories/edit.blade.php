@extends('layouts.admin')

@section('title', 'Categories')

@section('content')
    <div class="row">
        <h1 class="page-header">
            <div class="btn-group pull-right">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-default">Cancel</a>
            </div>
            Edit Category
        </h1>
    </div>
    @include('admin.alert')
    @include('errors.list')
    <div class="row">
        <div class="col-md-6">
            {!! Form::model($category, ['method' => 'patch', 'route' => ['admin.categories.update' , $category->id]]) !!}
                @include('admin.categories.form')
                <div class="form-group">
                    {!! Form::submit('Update', ['class' => 'btn btn-info'])!!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop
