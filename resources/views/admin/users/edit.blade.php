@extends('layouts.admin')

@section('title', 'Users')

@section('content')
    <div class="row">
        <h1 class="page-header">
            <div class="btn-group pull-right">
                <a href="{{ route('admin.users.index') }}" class="btn btn-default">Cancel</a>
            </div>
            Edit User
        </h1>
    </div>
    @include('admin.alert')
    @include('errors.list')
    <div class="row">
        <div class="col-md-6">
            {!! Form::model($user, ['method' => 'patch', 'route' => ['admin.users.update' , $user->id]]) !!}
                @include('admin.users.form')
                <div class="form-group">
                    {!! Form::submit('Update', ['class' => 'btn btn-info'])!!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop
