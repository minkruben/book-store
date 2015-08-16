@extends('layouts.admin')

@section('title', 'Authors')

@section('content')
    <div class="row">
        <h1 class="page-header">
            <div class="btn-group pull-right">
                @if (!isset($query))
                    <a href="{{ route('admin.authors.create') }}" class="btn btn-primary">Add New</a>
                @else
                    <a href="{{ route('admin.authors.index') }}" class="btn btn-default">Cancel</a>
                @endif
            </div>
            Authors
            @if (isset($query))
                <small>Search results for “{{ $query }}”</small>
            @endif
        </h1>
    </div>
    @include('admin.alert')
    @if ($authors->count())
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4 input-group form-group pull-right" id="search">
                    <input type="text" class="form-control" placeholder="Search ..." data-url="{{ route('admin.authors.search', '/') }}">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
                <div class="form-delete">
                    {!! Form::open(['method' => 'delete', 'route' => 'admin.authors.destroy', 'id' => 'form-delete']) !!}
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
                                <th>Name</th>
                                <th class="th-center">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($authors as $author)
                            <tr>
                                <td class="text-center"><input type="checkbox" id="checkthis" data-id="{{ $author->id }}"></td>
                                <td>
                                    <a href="{{ route('admin.authors.edit', $author->id) }}">{{ $author->name }}</a>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('author', $author->id) }}" target="_blank"><i class="fa fa-external-link"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center">
                    {!! $authors->render() !!}
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-12 text-center">
                <h3><small>No Authors found.</small></h3>
            </div>
        </div>
    @endif
@stop
