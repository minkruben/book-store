@extends('layouts.admin')

@section('title', 'Categories')

@section('content')
    <div class="row">
        <h1 class="page-header">
            <div class="btn-group pull-right">
                @if (!isset($query))
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Add New</a>
                @else
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-default">Cancel</a>
                @endif
            </div>
            Categories
            @if (isset($query))
                <small>Search results for “{{ $query }}”</small>
            @endif
        </h1>
    </div>
    @include('admin.alert')
    @if ($categories->count())
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4 input-group form-group pull-right" id="search">
                    <input type="text" class="form-control" placeholder="Search ..." data-url="{{ route('admin.categories.search', '/') }}">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
                <div class="form-delete">
                    {!! Form::open(['method' => 'delete', 'route' => 'admin.categories.destroy', 'id' => 'form-delete']) !!}
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
                            @foreach ($categories as $category)
                            <tr>
                                <td class="text-center"><input type="checkbox" id="checkthis" data-id="{{ $category->id }}"></td>
                                <td>
                                    <a href="{{ route('admin.categories.edit', $category->id) }}">{{ $category->name }}</a>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('category', $category->id) }}" target="_blank"><i class="fa fa-external-link"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center">
                    {!! $categories->render() !!}
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-12 text-center">
                <h3><small>No Categories found.</small></h3>
            </div>
        </div>
    @endif
@stop
