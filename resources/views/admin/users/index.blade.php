@extends('layouts.admin')

@section('title', 'Users')

@section('content')
    <div class="row">
        <h1 class="page-header">
            <div class="btn-group pull-right">
                @if (!isset($query))
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Add New</a>
                @else
                    <a href="{{ route('admin.users.index') }}" class="btn btn-default">Cancel</a>
                @endif
            </div>
            Users
            @if (isset($query))
                <small>Search results for “{{ $query }}”</small>
            @endif
        </h1>
    </div>
    @include('admin.alert')
    @if ($users->count())
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4 input-group form-group pull-right" id="search">
                    <input type="text" class="form-control" placeholder="Search ..." data-url="{{ route('admin.users.search', '/') }}">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
                <div class="form-delete">
                    {!! Form::open(['method' => 'delete', 'route' => 'admin.users.destroy', 'id' => 'form-delete']) !!}
                        {!! Form::hidden('checked') !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger'])!!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th class="th-center"><input type="checkbox" id="checkall"></th>
                                <th>Email</th>
                                <th>Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td class="text-center"><input type="checkbox" id="checkthis" data-id="{{ $user->id }}"></td>
                                <td>
                                    <a href="{{ route('admin.users.edit', $user->id) }}">{{ $user->email }}</a>
                                </td>
                                <td>{{ $user->name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center">
                    {!! $users->render() !!}
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-12 text-center">
                <h3><small>No Users found.</small></h3>
            </div>
        </div>
    @endif
@stop
