@extends('layouts.admin')

@section('title', 'Books')

@section('content')
    <div class="row">
        <h1 class="page-header">
            <div class="btn-group pull-right">
                @if (!isset($query))
                    <a href="{{ route('admin.books.create') }}" class="btn btn-primary">Add New</a>
                @else
                    <a href="{{ route('admin.books.index') }}" class="btn btn-default">Cancel</a>
                @endif
            </div>
            Books
            @if (isset($query))
                <small>Search results for “{{ $query }}”</small>
            @endif
        </h1>
    </div>
    @include('admin.alert')
    @if ($books->count())
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4 input-group form-group pull-right" id="search">
                    <input type="text" class="form-control" placeholder="Search ..." data-url="{{ route('admin.books.search', '/') }}">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
                <div class="form-delete">
                    {!! Form::open(['method' => 'delete', 'route' => 'admin.books.destroy', 'id' => 'form-delete']) !!}
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
                                <th>Title</th>
                                <th>Author(s)</th>
                                <th>Category</th>
                                <th class="th-center">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $book)
                            <tr>
                                <td class="text-center"><input type="checkbox" id="checkthis" data-id="{{ $book->id }}"></td>
                                <td>
                                    <a href="{{ route('admin.books.edit', $book->id) }}">{{ $book->title }}</a>
                                </td>
                                <td class="authors">
                                    @foreach ($book->authors()->get() as $key => $author)
                                        <span><a href="{{ route('author', $author->id) }}" target="_blank">{{ $author->name }}</a></span>
                                    @endforeach
                                </td>
                                <td>{{ $book->category()->pluck('name') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('book', $book->id) }}" target="_blank"><i class="fa fa-external-link"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center">
                    {!! $books->render() !!}
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-12 text-center">
                <h3><small>No Books found.</small></h3>
            </div>
        </div>
    @endif
@stop
